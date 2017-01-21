<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 30/04/2016
 * Time: 22:23
 */
if(isset($_GET['c1'])&&isset($_GET['c2'])&&isset($_GET['rsa'])){

    include_once("../../../php/cnx.php");
    $cle=mysqli_real_escape_string($conn,$_GET['c1']);
    $cle2=mysqli_real_escape_string($conn,$_GET['c2']);
    $id=mysqli_real_escape_string($conn,$_GET['rsa']);
    $file=intval(mysqli_real_escape_string($conn,$_GET['f']));

    $select=$conn->query("SELECT article,file,date_result,reviewer,resultat FROM state_review WHERE cle='".$cle."'AND cle2='".$cle2."'AND id=".$id);

    if($select) {

        $row=$select->fetch_assoc();

        if ($row["date_result"] != null) {
            $article = $conn->query("SELECT etiquette,title,abstract,keywords,author FROM article WHERE id=".$row['article']);
            if ($article) {
                $row_article = $article->fetch_assoc();
                $decision=$conn->query("SELECT Novelty,Technical,Relevance,Quality,Comments,recommendation,Confidential from res_rev WHERE id=".$row["resultat"]);
                $rox_decision=$decision->fetch_assoc();



            } else {
                die('Error : (' . $conn->error . ') ' . $conn->error);
            }
        }else{


        }
    }

}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Review ID:<?php echo $row_article['etiquette'].$row['article']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
    <link rel="stylesheet" href="css/review.css" type="text/css" />
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
        <nav class ="navbar navbar-inverse">
            <div class ="navbar-header ">
                <a class ="navbar-brand " href ="#">REVIEWVER ACCOUNT  </a>
            </div>
            <ul class ="nav navbar-nav ">
                <li class="divider"></li>
                <li class =" active "> <a href ="usr_home.php"> Home </a> </li >
                <li> <a href ="#">Ethics </a> </li >
                <li> <a href ="#">Author Guidelines</a> </li >
                <li> <a href="../../../php/log_out.php" id="log-out">Log out</a> </li >
            </ul>
            <div class ="navbar-form pull-right " id="rev_info">
                KHODJA AHMED
            </div>
        </nav>
    </div>
</div>
<div class="container-fluid">
    <div class="col-xs-1">
    </div>
    <div class="col-xs-10">
        <div class="row">
            <div class="row"><legend>Article Information</legend> </div>
            <div class="form-group">
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Title : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte"id="titre" ><?php echo $row_article['title'];?> </label>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Abstract : </label>

                        <div class="col-lg-10">

                            <label for="text" class="  text-left texte"id="abstract_article" ><?php echo $row_article['abstract'];?> </label>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Keywords : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte"><?php echo $row_article['keywords'];?> </label>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">File : </label>

                        <div class="col-lg-10">

                            <?php

                            $file=$conn->query("SELECT name  FROM file WHERE  id=".$row['file']);
                            $rowfile2=$file->fetch_assoc();
                            $author=$conn->query("SELECT author  FROM article WHERE  id=".$row['article']);
                            $row_author=$author->fetch_assoc();

                            echo" <a href=\"php/download.php?id=".$row_author["author"]."&ida=".$row['article']."&a=".$rowfile2['name']."\" style=\"color: #FFFFFF\">";
                            ?><button type="button" class="btn btn-primary active"><i class="fa fa-download"></i> Download</button></a>
                        </div>

                    </div>

                </div>
            </div>
            </br>

            <form class="form-horizontal col-lg-12" id="form" method="post">
                <?php echo"<input type='hidden' name='id' value='".$id."'>";?>
                <label for="score" ><i>- Novelty and originality  </i><span style="color:#F00">*</span> : Rate the novelty and originality of the work presented in the paper.</label>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="A pioneering piece of work." <?php if($rox_decision['Novelty']=="A pioneering piece of work."){echo"checked=\"checked\"";}else{echo "disabled";} ?>>A pioneering piece of work.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="Novel results and original work" <?php if($rox_decision['Novelty']=="Novel results and original work"){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Novel results and original work.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="Some novel results on a subject well investigated." <?php if($rox_decision['Novelty']=="Some novel results on a subject well investigated."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Some novel results on a subject well investigated.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="Minor variations on a well studied subject." <?php if($rox_decision['Novelty']=="Minor variations on a well studied subject."){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Minor variations on a well studied subject.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Novelty" value="It has been said many times before." <?php if($rox_decision['Novelty']=="It has been said many times before."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>It has been said many times before.</label>
                </div>
                </br>
                <label for="title"><i>- Technical content and correctness  </i><span style="color:#F00">*</span>: Rate the technical contribution of the paper, its soundness and scientific rigour.</label>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Excellent technical quality." <?php if($rox_decision['Technical']=="Excellent technical quality."){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Excellent technical quality.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Technically solid." <?php if($rox_decision['Technical']=="Technically solid."){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Technically solid.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Minor flaws, but conclusions still believable." <?php if($rox_decision['Technical']=="Minor flaws, but conclusions still believable."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Minor flaws, but conclusions still believable.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Significant flaws that may call some results into question."  <?php if($rox_decision['Technical']=="Significant flaws that may call some results into question."){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Significant flaws that may call some results into question.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Technical" value="Questionable work with severe flaws."<?php if($rox_decision['Technical']=="Questionable work with severe flaws."){echo"checked=\"checked\"";} else{echo "disabled";} ?> >Questionable work with severe flaws.</label>
                </div>
                </br>
                <label for="title"> <i>- Relevance and Timeliness  </i><span style="color:#F00">*</span>: Rate the importance of the topic addressed in the paper and its timeliness within its area of research.</label>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Excellent." <?php if($rox_decision['Relevance']=="Excellent."){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Excellent.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Above average." <?php if($rox_decision['Relevance']=="Above average."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Above average.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Average." <?php if($rox_decision['Relevance']=="Average."){echo"checked=\"checked\"";} else{echo "disabled";}  ?>>Average.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="Below average." <?php if($rox_decision['Relevance']=="Below average."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Below average.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Relevance" value="None."  <?php if($rox_decision['Relevance']=="None."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>None.</label>
                </div>
                </br>
                <label for="title"><i>- Quality of presentation  </i><span style="color:#F00">*</span>: Rate the paper organization, the clearness of text and figures, the completeness and accuracy of references.</label>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Excellent." <?php if($rox_decision['Quality']=="Excellent."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Excellent.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Well written." <?php if($rox_decision['Quality']=="Well written."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Well written.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Readable; could benefit from revision." <?php if($rox_decision['Quality']=="Readable; could benefit from revision."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Readable; could benefit from revision.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Substantial revision work is needed." <?php if($rox_decision['Quality']=="Substantial revision work is needed."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Substantial revision work is needed.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="Quality" value="Unacceptable." <?php if($rox_decision['Quality']=="Unacceptable."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Unacceptable.</label>
                </div>
                </br>
                <label for="title"><i>- Comments and Recommended Changes  </i><span style="color:#F00">*</span>: Comments to the author: please give your general appraisal and indicate any changes that should be made to the paper if it is accepted.</label>
                <textarea name="comment"  class="form-control" id="Comment" placeholder ="Comments and Recommended Changes  ... " rows="8"><?php echo "".$rox_decision['Comments'].""; ?></textarea>
                </br>
                <label for="title"><i>Overall recommendation  </i><span style="color:#F00">*</span>: What is your overall recommendation for this paper?</label>

                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Accept." <?php if($rox_decision['recommendation']=="Accept."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Accept.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Minor revision." <?php if($rox_decision['recommendation']=="Minor revision."){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Minor revision.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Marginal reject." <?php if($rox_decision['recommendation']=="Major revision."){echo"checked=\"checked\"";}else{echo "disabled";}  ?>>Major revision.</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="recommendation" value="Reject." <?php if($rox_decision['recommendation']=="Reject."){echo"checked=\"checked\"";} else{echo "disabled";} ?>>Reject.</label>
                </div>
                <br />
                <label for="title"><i>Confidential Comments  </i><span style="color:#F00">*</span>: Confidential Comments for the Technical Programme Committee.</label>
                <textarea name="Confidential"  class="form-control" id="Confidential" placeholder ="Confidential Comments ... " rows="8"><?php echo "".$rox_decision['Confidential'].""; ?></textarea>
                </br>

            </form>
        </div>
        <div class="row">
            Date: <?php echo "".$row["date_result"].""; ?>
        </div>

    </div>
    <div class="col-xs-1">
    </div>


</div>
<script src="../../../js/bootstrap.js" type="text/javascript"></script>

</body>
</html>
