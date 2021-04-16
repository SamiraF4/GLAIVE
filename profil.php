<!--styles jeu idem-->

<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id'])) {
 $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
 $requser->execute(array($_SESSION['id']));
 $user = $requser->fetch();
 if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
    $newpseudo = htmlspecialchars($_POST['newpseudo']);
    $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
    $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
 }
 if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
    $newmail = htmlspecialchars($_POST['newmail']);
    $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
    $insertmail->execute(array($newmail, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
 }
 if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
    $mdp1 = sha1($_POST['newmdp1']);
    $mdp2 = sha1($_POST['newmdp2']);
    if($mdp1 == $mdp2) {
       $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
       $insertmdp->execute(array($mdp1, $_SESSION['id']));
       header('Location: profil.php?id='.$_SESSION['id']);
    } else {
       $msg = "Vos deux mdp ne correspondent pas !";
    }
 }
?>

<!DOCTYPE html>

<html>

    <head>
      <meta charset="utf-8"/>
      <title>GLAIVE</title>
      <link rel="stylesheet" type="text/css" href="styles/profil.css">
  		<link rel="icon" href="images/epee.ico"/>
    </head>

    <body>
      <div id="container">

        <header>

            <div id="logo">
              <a href="index2.html"><img src="images/logo/glaive.png" width="120px"/></a>
            </div>

        </header>

        <section>


             <table>

               <tr>
                 <td id="bandes-sons" colspan="4">
                   <h1>P R O F I L</h1>
                 </td>
               </tr>

               <tr>
                 <td class="animation_avatar">
                   <div id="avatar_td_1">
                     <div id="avatar_1">
                     </div>
                   </div>
                 </td>
                 <td class="animation_avatar">
                   <div id="avatar_td_2">
                     <div id="avatar_2">
                     </div>
                   </div>
                 </td>
                 <td class="animation_avatar">
                   <div id="avatar_td_3">
                     <div id="avatar_3">
                     </div>
                   </div>
                 </td>
                 <td class="animation_avatar">
                   <div id="avatar_td_4">
                     <div id="avatar_4">
                     </div>
                   </div>
                 </td>
               </tr>

             </table>


             <form class="box" method="post" action="verification.php" >
               <p>
                 <label style="color:white;"for="pseudo"> Pseudo </label></br>
                 <input type="text" placeholder="Pseudo" name="newpseudo" required>
               </p>
               <p>
                 <label style="color:white;" for="email"> E-mail </label></br>
                 <input type="email" placeholder="abcdef@hotmail.fr" name="newemail" required>
               </p>
               <p>
                 <label style="color:white;" for="mdp"> Mot de passe </label></br>
                 <input type="password" placeholder="Choisir un mot de passe" name="newmdp" required>
               </p>
               <p>
                 <input type="submit" name="forminscription" value="Mettre à jour mon profil" />
               </p>
             </form>




      </div>

    </section>
      <footer>

        <!--pour remonter en haut de page si on es au footer-->
        <div id="fleche">
          <a href="jeu.html"><img id="fleche" src="images/logo/fleche.png" width="5%" align="right"/></a>
        </div>

        <!--Étudiant en L2 DANT... en gris-->
        <div id="compagnie" align="center">
        </br></br><h2>B O N J O U R  !</h2>
          <img src="images/barre.png" width="600px" height="25px"  align="center"/></br></br>
          <h4> Nous sommes étudiant en L2 à Sorbonne Université</h4>
          <p>Vous aimeriez nous contacter ? Nous serions ravis de vous répondre.<p></br>
        </div>

        <!--(nos mails) + linkedin-->
        <div id="contact">
          <ul>
            <li><img src="images/logo/linkedin.png" width="50px" class="center"/>
             <ul class="submenu">
               <li><a href ="https://fr.linkedin.com/in/mounir-lassal-6615181bb"><b>Mounir LASSAL</b></a></li>
               <li><a href ="https://fr.linkedin.com/in/shalom-agonglo-b43a9b18a"><b>Shalom AGONGLO</b></a></li>
               <li><a href ="https://fr.linkedin.com/in/samira-fawaz-a2b101194"><b>Samira FAWAZ</b></a></li>
               <li><a href ="https://fr.linkedin.com/in/arthur-guillaumot-614a011ab"><b>Arthur GUILLAUMOT</b></a></li>
             </ul>
           </li>
          </ul>
        </div>

        <!--Copyright pour faire semblant ou pas (©)-->

      </footer>
      </div>
    </body>

    <?php
}
else {
   header("Location: connexion.php");
}
?>
