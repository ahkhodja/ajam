<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 05/09/2016
 * Time: 15:51
 */
include_once ("../../../../php/cnx.php");
$conn->autocommit(false);
$conn->begin_transaction();
$Novelty=mysqli_real_escape_string($conn,$_POST['Novelty']);
$Technical=mysqli_real_escape_string($conn,$_POST['Technical']);
$Relevance=mysqli_real_escape_string($conn,$_POST['Relevance']);
$Quality=mysqli_real_escape_string($conn,$_POST['Quality']);
$comment=mysqli_real_escape_string($conn,$_POST['comment']);
$recommendation=mysqli_real_escape_string($conn,$_POST['recommendation']);
$Confidential=mysqli_real_escape_string($conn,$_POST['Confidential']);
$id=intval($_POST['id']);
$article=intval($_POST['id_ar']);
$etiquette=$_POST['etiquette'];
$title=$_POST['title'];
$editor=intval($_POST['editor']);
$et_e=intval($_POST['et_e']);
$file=intval($_POST['file']);

if(isset($Novelty)&&isset($Technical)&&isset($Relevance)&&isset($Quality)&&isset($comment)&&isset($recommendation)&&isset($Confidential)){
    $rev=$conn->query("INSERT INTO res_rev(Novelty,Technical,Relevance,Quality,Comments,recommendation,Confidential)VALUE ('".$Novelty."','".$Technical."','".$Relevance."','".$Quality."','".$comment."','".$recommendation."','".$Confidential."')");
    if($rev){
        $id_res=mysqli_insert_id($conn);
        $up=$conn->query("UPDATE state_review SET date_result=now(),state='Finished',resultat=".$id_res." where id= ".$id);
        $reviwver_id=$conn->query("SELECT reviewer from state_review WHERE id=".$id);
        $row_reviewer_id=$reviwver_id->fetch_assoc();
        $reviwver=$conn->query("SELECT fname,mname,lname,email from reviewer WHERE id=".$row_reviewer_id['reviewer']);
        $row_reviewer=$reviwver->fetch_assoc();
        $editor_select=$conn->query("SELECT fname,mname,lname,email from editor WHERE id=".$editor);
        $row_editor=$editor_select->fetch_assoc();
        $body="<p>Thank you for completing the review of the paper ".$etiquette.$article.", entitled \"".$title."\", submitted to AJAM.  We value the contribution you have made and hope that we may call upon you again to review future manuscripts. A copy of your review is included below for your reference.</p> </br><p>
        You can find all of your pending and completed reviews at https://ajam.revsys.dz</p> </br>
        <p>Your username is ".$row_reviewer["email"].".</p></br>
        <p>Best regards,</p></br>
         <p>".$row_editor['fname']." ".$row_editor['fname']."</p></br>
         <p>AJAM Associate Editor </p>";
        $subject="AJAM: review completed for paper ".$etiquette.$article;
        $FromName   = "AJAM OFFICE";
        require "mail_function.php";
        $mail=new mail_function();
        $res=$mail->envoyer($row_reviewer["email"],$body,$subject, $FromName);
        if(!$res) {
            $conn->rollback();
            // echo "Mailer Error: " . $mail->ErrorInfo;
            echo 0;
            exit();
        }else{
            $select_review_state=$conn->query("SELECT state FROM state_review WHERE article=".$article."  AND type='Review 3' AND date_result IS null");
            if($select_review_state){
                $termine=true;

                while ($row_etat=$select_review_state->fetch_assoc()){
                    if($row_etat['state']==NULL){
                        $termine=false;
                    }

                }

                if($termine){
                    $update_editor=$conn->query("UPDATE state_editor SET etat='-R2 in review-' WHERE article=".$article." and etat='R2 in review'");

                    $insert_state_editor=$conn->query("INSERT INTO state_editor(article,file,etat,date,editor) VALUES (".$article.",".$file.",'R2 in Decision',now(),".$editor.")");

                }

            }
            else
            {

            }


            $conn->commit();
            $conn->close();
            echo 1;

        }

    }else{
        $conn->close();
        echo "0";
        die('Error : ('. $conn->error .') '. $conn->error);}
}else{
    $conn->close();
    echo "0";
}