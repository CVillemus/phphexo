<?php
include("include/file.php");
$connexion = DatabaseConnexion::get();
$errors = array();
if(!empty($_POST)){

	if(empty($_POST['lastname'])){
		$errors['lastname'] = 'Le nom est obligatoire';
	}

	if(empty($_POST['firstname'])){
		$errors['firstname'] = 'Le prénom est obligatoire';
	}

	if(empty($_POST['email'])){
		$errors['email'] = 'Un email est obligatoire';
	}else{
		$sql = "SELECT COUNT(*) AS total FROM newsletter WHERE newsletter_mail = :email";
            $prepared = $connexion->prepare($sql);
		$prepared->bindValue("email", strip_tags($_POST["email"]));
            $prepared->execute();
            $data = $prepared->fetch();
            var_dump($data['total']);
		if(!empty($data['total'])){
			$errors['email'] = 'Vous êtes déjà inscrit à notre newsletter';
		}
	}

	if(empty($errors)){
		if(insertUserMail($_POST)){
                  redirectTo("congrats.php?email=".strip_tags($_POST["email"]));
                  echo("works");
		}else{
                  $errors['global'] = 'Une erreur est survenue.';
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>phptfe</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" media="screen" href="main.css">
      
</head>
<body>
      <header>
            <nav>
                  <ul>
                        <li><a href="index.php">News</a></li>
                        <li><a href="login.php">Admin</a></li>
                        <li><a href="unsubscribe.php">Unsubscribe</a></li>
                  </ul>
            </nav>
      <header>
      <main>
            <?php if(!empty($errors['global'])) echo $errors['global']; ?>
            <form action="" method="post">
                  <label>
                        Nom: <input type="text" value="" name="lastname" />
                        <?php if(!empty($errors['lastname'])): ?>
                        <span class="error"><?php echo $errors['lastname']; ?></span>
                        <?php endif; ?>
                  </label>

                  <label>
                        Prénom: <input type="text" value="" name="firstname"/>
                        <?php if(!empty($errors['firstname'])): ?>
                        <span class="error"><?php echo $errors['firstname']; ?></span>
                        <?php endif; ?>
                  </label>

                  <label>
                        email: <input type="email" value="" name="email"/>
                        <?php if(!empty($errors['email'])): ?>
                        <span class="error"><?php echo $errors['email']; ?></span>
                        <?php endif; ?>
                  </label>

                  <input type="submit" />
            </form>
      </main>
      <script src="main.js"></script>
</body>
</html>