<?php
include("include/file.php");
$errors = array();
if(!empty($_POST['login']) 
&& !empty($_POST['password'])){

	if(connectUser($_POST['login'], $_POST['password'])){
		header("Location: admin.php");
		exit;
	}else{
		$errors['global'] = 'Une erreur est survenue.';
	}
}


?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Connexion</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>
<body>
      <?php if(!empty($errors['global'])) echo $errors['global']; ?>
	<form action="" method="post">
		<label>
			login: <input type="text" value="" name="login"/>
		</label>

		<label>
			password: <input type="password" value="" name="password"/>
		</label>
		<input type="submit" />
	</form>
	<script src="main.js"></script>
</body>
</html>