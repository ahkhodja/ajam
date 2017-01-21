<?php 
include_once("cnx.php");
$select = $conn->query("SELECT fname,lname,mname,affiliation,adresse,city,state,contry,pcode,phone,fax FROM personne WHERE id=".$_POST['id']."");
$row = $select->fetch_assoc();
echo"<div id=\"table_contenu\">
<legend> &nbsp;Edit Informations :</legend>
<form class=\"form-horizontal \">


  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">First Name :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"fname\" placeholder =\"First Name\" value=\"". $row['fname']."\" disabled>

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">Middle Name :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"text\" value=\"".$row['mname']."\" disabled>

      </div>

    </div>

  </div>
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">last Name :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"text\" value=\"". $row['lname']."\"disabled>

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">Affiliation :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"affiliation\" value=\"".$row['affiliation']."\">

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">Address :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"adresse\" value=\"".$row['adresse']."\">

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">City :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"city\" value=\"". $row['city']."\">

      </div>

    </div>

  </div>

  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">State/Region :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"state\"value=\"". $row['state']."\">

      </div>

    </div>

  </div>
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">contry :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"contry\" value=\"". $row['contry']."\">

      </div>

    </div>

  </div>
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">Zip/Postcode :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"pcode\" value=\"". $row['pcode']."\">

      </div>

    </div>

  </div>
  
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">Phone :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"Phone\" value=\"". $row['phone']."\">

      </div>

    </div>

  </div>
<div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">Fax :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"fax\" value=\"". $row['fax']."\">

      </div>

    </div>

  </div>
 

  <div class=\"form-group\">

    <button class=\"pull-right btn btn-primary\" id=\"submit-edit\">Envoyer</button>

  </div>

</form>
</div>";
?>