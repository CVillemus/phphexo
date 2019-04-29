<?php
include("include/file.php");
?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Congratulation</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>
<body>
      <p>Félicitation, tu es maintenant enregistré à la newsletter</p>
      <a href="unsubscribe.php<?php if (!empty($_GET['email'])) {echo "?email=" . $_GET['email'];} ?>">Je souhaite me désinscrire à la newsletter</a>
      <script src="main.js"></script>
</body>
</html>