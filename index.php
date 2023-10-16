<?php
session_start();
if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['abonne']);

}
$erreurInscription="";
include "fonctions/connexion.php";
//connexion
if((isset($_POST['chmailConnexion']))&&(isset($_POST['chpwConnexion'])))
{
   $email=$_POST['chmailConnexion'];
   $pw=$_POST['chpwConnexion'];

   $sqlQuery = "SELECT * FROM `abonnee` WHERE `email`='$email' AND `mp`='$pw'";
                  $abonne = $dbconn->prepare($sqlQuery);
                  $abonne->execute();
                  $abonne = $abonne->fetch();
                if(!empty($abonne))
                {
                    $_SESSION['abonne']['id']=$abonne['id_abonnee'];
                  $_SESSION['abonne']['nom']=$abonne['nom'];
                  $_SESSION['abonne']['email']=$abonne['email'];
                  $_SESSION['abonne']['photo']=$abonne['photo'];
                }
                else
                {
                    echo "erreur connexion";
                }
                  

}


//inscription
if((isset($_POST['chnom']))&&(isset($_POST['chmail']))&&(isset($_POST['chpw'])))
{

   $nom=$_POST['chnom'];
   $email=$_POST['chmail'];
   $pw=$_POST['chpw'];
   $avatar=$_FILES['chavatar'];

   $nomAvatar=time().'_'.$avatar['name'];
   $tmpnomAvatar=$avatar['tmp_name'];
   $sizeAvatar=$avatar['size'];
   $typeAvatar=$avatar['type'];
   $errorAvatar=$avatar['error'];

    

   if($sizeAvatar>100000)
   {
    $erreurInscription="Fichier volumineux Max 190Ko";
   }
   elseif(($typeAvatar!=='image/jpeg')&&($typeAvatar!=='image/png'))
   {
    $erreurInscription="l'avatar doit etre une photo JPG";
   }
   elseif($errorAvatar!==0)
   {
    $erreurInscription="probleme upload";
   }
   else
   {
    $sqlQuery = "INSERT INTO `abonnee` (`id_abonnee`, `nom`, `email`, `mp`, `photo`) VALUES (NULL, '$nom', '$email', '$pw', '$nomAvatar');";
                  $abonne = $dbconn->prepare($sqlQuery);
                  $abonne->execute();
                  $idInscription=$dbconn->lastInsertId();
    move_uploaded_file($tmpnomAvatar,'assets/img/abonnees/'.$nomAvatar);


                $_SESSION['abonne']['id']=$idInscription;
                  $_SESSION['abonne']['nom']=$nom;
                  $_SESSION['abonne']['email']=$email;
                  $_SESSION['abonne']['photo']=$nomAvatar;

   }

   echo $erreurInscription;
/*
   $sqlQuery = "SELECT * FROM `abonnee` WHERE `email`='$email' AND `mp`='$pw'";
                  $abonne = $dbconn->prepare($sqlQuery);
                  $abonne->execute();
                  $abonne = $abonne->fetch();
                if(!empty($abonne))
                {
                    $_SESSION['abonne']['id']=$abonne['id_abonnee'];
                  $_SESSION['abonne']['nom']=$abonne['nom'];
                  $_SESSION['abonne']['email']=$abonne['email'];
                }
                else
                {
                    echo "erreur connexion";
                }
                  
*/
}







include 'front/head.html';
include 'front/Rheader.php';

if(isset($_GET['recipeLabel']))
{
  require_once 'front/recipeDetails.php';

}
else
{
  require_once 'front/searchReceip.php';
}
include 'front/footer.php';
include 'front/foot.php';




























?>
