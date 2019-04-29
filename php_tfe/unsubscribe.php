<?php
include("include/file.php");
$connexion = DatabaseConnexion::get();





$newmail = false;

if(!empty($_GET['email'])){
      
      $sql = "SELECT COUNT(*) AS total FROM newsletter WHERE newsletter_mail = :email";
      $prepared = $connexion->prepare($sql);
      $prepared->bindValue("email", strip_tags($_GET["email"]));
      $prepared->execute();
      $data = $prepared->fetch();

      if(!empty($data['total'])){
            $prepareStatement = $connexion -> prepare('DELETE FROM newsletter WHERE newsletter_mail = :email');
            $prepareStatement -> bindValue("email", strip_tags($_GET["email"]));
            $prepareStatement -> execute();
            redirectTo("left.php");
      }else{
            $errors['email'] = "Vous êtes déjà désinscrit à la newsletter";
      }
 
}else{
      $newmail = true;
}

if(!empty($_POST['email'])){

      $sql = "SELECT COUNT(*) AS total FROM newsletter WHERE newsletter_mail = :email";
      $prepared = $connexion->prepare($sql);
      $prepared->bindValue("email", strip_tags($_POST["email"]));
      $prepared->execute();
      $data = $prepared->fetch();

      if(!empty($data['total'])){
            $prepareStatement = $connexion -> prepare('DELETE FROM newsletter WHERE newsletter_mail = :email');
            $prepareStatement -> bindValue("email", strip_tags($_POST["email"]));
            $prepareStatement -> execute();
            redirectTo("left.php");
      }else{
            $errors['email'] = "Vous êtes déjà désinscrit à la newsletter";
      }
      
}


?>


<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>unsubscription</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" media="screen" href="main.css">
      <script src="main.js"></script>
</head>
<body>
      <p><?php echo $errors['email']; ?></p>
      <?php if($newmail):?> 
      <form action="" method="post">
                  <label>
                        Email: <input type="text" value="email" name="email" />
                        <?php if(!empty($errors['email'])): ?>
                        <span class="error"><?php echo $errors['email']; ?></span>
                        <?php endif; ?>
                  </label>
                  <input type="submit" />
      </form>
      <?php endif;?> 
      <a href="index.php">Retourner à l'index</a>
</body>
</html>


