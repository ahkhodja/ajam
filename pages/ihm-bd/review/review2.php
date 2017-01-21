<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 30/04/2016
 * Time: 22:23
 */
if (isset($_GET['c1']) && isset($_GET['c2']) && isset($_GET['rsa'])) {

    include_once("../../../php/cnx.php");
    $cle = mysqli_real_escape_string($conn, $_GET['c1']);
    $cle2 = mysqli_real_escape_string($conn, $_GET['c2']);
    $id = mysqli_real_escape_string($conn, $_GET['rsa']);
    $et_ed = intval(mysqli_real_escape_string($conn, $_GET['et_ed']));
    $file = intval(mysqli_real_escape_string($conn, $_GET['f']));
    $editor = intval(mysqli_real_escape_string($conn, $_GET['b']));

    $select = $conn->query("SELECT article,file,date_accepte,DATE_ADD(date_accepte, INTERVAL 60 DAY) AS endDate,date_result,reviewer,date,state FROM state_review WHERE cle='" . $cle . "'AND cle2='" . $cle2 . "'AND id=" . $id);

    if ($select) {

        $row = $select->fetch_assoc();
        if ($row['state'] == "refused") {
            header('Location: log-in.php');
        }
        $select_reviwver = $conn->query("SELECT fname,lname,email from reviewer WHERE id=" . $row['reviewer']);
        $row_rev = $select_reviwver->fetch_assoc();
        $article = $conn->query("SELECT etiquette,title,abstract,keywords,author FROM article WHERE id=" . $row['article']);
        if ($article) {
            $row_article = $article->fetch_assoc();
        } else {
            die('Error : (' . $conn->error . ') ' . $conn->error);
        }
        if ($row["date_accepte"] == null) {
            $select_editor = $conn->query("SELECT fname,lname from editor WHERE id=" . $editor);
            $row_editor = $select_editor->fetch_assoc();


            $update = $conn->query("update state_review set date_accepte=now(),state='Accepted' WHERE id=" . $id);
            if ($update) {
                $body = "<p>Dear Dr. " . $row_rev['fname'] . " " . $row_rev['lname'] . ",</p>

<p>Thank you for agreeing to review manuscript" . $row_article['etiquette'] . $row['article'] . " for Algerian Journal od Advanced Materials. 

If possible, I would appreciate receiving your review by " . $row['endDate'] . ".</p> 

<p>You may submit your comments online at http://ajam.revsys.dz/. </p>

<p>There you will find spaces for confidential comments to the editor, comments for the author and a report form to be completed. </p>

<p>With kind regards </p>

<p>Pr " . $row_editor['fname'] . " " . $row_editor['lname'] . "</p>
<p>Associate Editor </p>
<p>Algerian Journal of Advanced Materials</p>
";
                $subject = "Thank you for agreeing to review a paper for AJAM";
                $FromName = "AJAM OFFICE";
                require "mail_function.php";
                $mail = new mail_function();
                $res = $mail->envoyer($row_rev["email"], $body, $subject, $FromName);

                $count = $conn->query("SELECT id from state_review WHERE article=" . $row['article'] . " AND state !='Null' AND type='Review 2'");
                if ($count) {

                    if (mysqli_num_rows($count) == 1) {
                        $insert_et_auth = $conn->query("INSERT INTO state_author(article,file,date,state)VALUE (" . $row['article'] . "," . $file . ",now(),'In Review')");
                        $update_state_article = $conn->query("UPDATE article SET state='In Review' WHERE id=" . $row['article']);
                        $insert_state_editor = $conn->query("INSERT INTO state_editor(article,file,etat,date,editor) VALUES (" . $row['article'] . "," . $file . ",'R1 in review',now()," . $editor . ")");
                        $update_state_editor = $conn->query("UPDATE state_editor SET etat='-R1 Submited-' WHERE id=" . $et_ed);
                    }
                }

            } else {
                die('Error : (' . $conn->error . ') ' . $conn->error);
            }
        }
        if ($row["date_result"] == null) {

        } else {
            header("Location: rev_res.php?c1=" . $cle . "&c2=" . $cle2 . "&rsa=" . $id . "&f=" . $file);

        }
    }

}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Review ID:<?php echo $row_article['etiquette'] . $row['article']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css"/>
    <link rel="stylesheet" href="css/review.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <!-- <script src=../../js/jquery-1.9.1.min.js></script> -->
    <script src="../../../js/jquery-1.11.3.min.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body style="padding-bottom: 70px">
<div class="container-fluid">
    <div class="col-lg-12">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header ">
                <a class="navbar-brand " href="#">REVIEWVER ACCOUNT </a>
            </div>

            <div class="navbar-form pull-right " id="rev_info">
                <?php echo $row_rev['fname'] . " " . $row_rev['lname']; ?>
            </div>
        </nav>
    </div>
</div>
<div class="container-fluid">
    <div class="col-xs-1">
    </div>
    <div class="col-xs-10">
        <div class="row">
            <div class="row">
                <legend>Article Information</legend>
            </div>
            <div class="form-group">
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Title : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte"
                                   id="titre"><?php echo $row_article['title']; ?> </label>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Abstract : </label>

                        <div class="col-lg-10">

                            <label for="text" class="  text-left texte"
                                   id="abstract_article"><?php echo $row_article['abstract']; ?> </label>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Keywords : </label>

                        <div class="col-lg-10">

                            <label for="text"
                                   class=" control-label text-left texte"><?php echo $row_article['keywords']; ?> </label>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">File : </label>

                        <div class="col-lg-10">

                            <?php

                            $file_select = $conn->query("SELECT name  FROM file WHERE  id=" . $row['file']);
                            $rowfile2 = $file_select->fetch_assoc();
                            $author = $conn->query("SELECT author  FROM article WHERE  id=" . $row['article']);
                            $row_author = $author->fetch_assoc();

                            echo " <a href=\"php/download.php?id=" . $row_author["author"] . "&ida=" . $row['article'] . "&a=" . $rowfile2['name'] . "\" style=\"color: #FFFFFF\">";
                            ?>
                            <button type="button" class="btn btn-primary active"><i class="fa fa-download"></i> Download
                            </button>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
            </br>

            <form class="form-horizontal col-lg-12" id="form" method="post">
                <?php echo "<input type='hidden' name='id' value='" . $id . "'>"; ?>
                <?php echo "<input type='hidden' name='id_ar' value='" . $row['article'] . "'>"; ?>
                <?php echo "<input type='hidden' name='etiquette' value='" . $row_article['etiquette'] . "'>"; ?>
                <?php echo "<input type='hidden' name='title' value='" . $row_article['title'] . "'>"; ?>
                <?php echo "<input type='hidden' name='editor' value='" . $editor . "'>"; ?>
                <?php echo "<input type='hidden' name='et_e' value='" . $et_ed . "'>"; ?>
                <?php echo "<input type='hidden' name='file' value=" . $file . ">"; ?>

                <label for="score"><i>- Novelty and originality </i><span style="color:#F00">*</span> : Rate the novelty
                    and originality of the work presented in the paper.</label>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="A pioneering piece of work.">A pioneering piece of
                        work.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="Novel results and original work">Novel results and
                        original work.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty"
                                  value="Some novel results on a subject well investigated.">Some novel results on a
                        subject well investigated.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="Minor variations on a well studied subject.">Minor
                        variations on a well studied subject.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="It has been said many times before.">It has been
                        said many times before.</label>
                </div>
                </br>
                <label for="title"><i>- Technical content and correctness </i><span style="color:#F00">*</span>: Rate
                    the technical contribution of the paper, its soundness and scientific rigour.</label>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Excellent technical quality.">Excellent technical
                        quality.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Technically solid.">Technically solid.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Minor flaws, but conclusions still believable.">Minor
                        flaws, but conclusions still believable.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical"
                                  value="Significant flaws that may call some results into question.">Significant flaws
                        that may call some results into question.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Questionable work with severe flaws.">Questionable
                        work with severe flaws.</label>
                </div>
                </br>
                <label for="title"> <i>- Relevance and Timeliness </i><span style="color:#F00">*</span>: Rate the
                    importance of the topic addressed in the paper and its timeliness within its area of
                    research.</label>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Excellent.">Excellent.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Above average.">Above average.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Average.">Average.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Below average.">Below average.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="None.">None.</label>
                </div>
                </br>
                <label for="title"><i>- Quality of presentation </i><span style="color:#F00">*</span>: Rate the paper
                    organization, the clearness of text and figures, the completeness and accuracy of
                    references.</label>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Excellent.">Excellent.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Well written.">Well written.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Readable; could benefit from revision.">Readable;
                        could benefit from revision.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Substantial revision work is needed.">Substantial
                        revision work is needed.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Unacceptable.">Unacceptable.</label>
                </div>
                </br>
                <label for="title"><i>- Comments and Recommended Changes </i><span style="color:#F00">*</span>: Comments
                    to the author: please give your general appraisal and indicate any changes that should be made to
                    the paper if it is accepted.</label>
                <textarea name="comment" class="form-control" id="Comment"
                          placeholder="Comments and Recommended Changes  ... " rows="8"></textarea>
                </br>
                <label for="title"><i>Overall recommendation </i><span style="color:#F00">*</span>: What is your overall
                    recommendation for this paper?</label>
                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Accept.">Accept.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Minor revision.">Minor revision.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Major revision.">Major revision.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Reject.">Reject.</label>
                </div>
                <br/>
                <label for="title"><i>Confidential Comments </i><span style="color:#F00">*</span>: Confidential Comments
                    for the Technical Programme Committee.</label>
                <textarea name="Confidential" class="form-control" id="Confidential"
                          placeholder="Confidential Comments ... " rows="8"></textarea>
                </br>
                <button class="pull-right btn btn-success" id="envoyer">&nbsp;Submit&nbsp;</button>
            </form>
        </div>

    </div>
    <div class="col-xs-1">
    </div>


</div>
<footer class="row col-sm-12 ">

    <p class="footer_perso text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

</footer>
<script src="../../../js/bootstrap.js" type="text/javascript"></script>
<script src="js/rev_validate2.js" type="application/javascript"></script>
</body>
</html>
