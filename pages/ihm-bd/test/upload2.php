
<?php
if(isset($_FILES['upload']))
{
    $dossier = 'upload/';
    $fichier = basename($_FILES['upload']['name']);
    if(move_uploaded_file($_FILES['upload']['tmp_name'], $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        echo 'Upload effectué avec succès !';
    }
    else //Sinon (la fonction renvoie FALSE).
    {
        echo 'Echec de l\'upload !';
    }
}
?>