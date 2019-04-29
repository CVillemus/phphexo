<?php
include("include/file.php");
// secure();
// $user = getConnectedUser();

$connexion = DatabaseConnexion::get();
$errors = array();


      $prepared = $connexion->prepare("SELECT * FROM newsletter");
      $prepared->execute();
      $subscribed = $prepared->fetchAll();



// $connexion->prepare("DELETE FROM newsletter WHERE id = :id LIMIT 1");
// $prepared->bindValue(":id", strip_tags($data["id"]));
// $prepareStatement -> execute();

?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Administrator</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>
<body>
      <div>
      <h1>Pannel admin</h1>
	</div>
      <div>
		<h2>Vos Abonnés</h2>
		<table>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Email</th>
			</tr>
			<?php foreach($subscribed as $subscribeds): ?>
			<tr>
				<td><?php echo $subscribeds['newsletter_firstname'];?></td>
				<td><?php echo $subscribeds['newsletter_lastname'];?> </td>
				<td><?php echo $subscribeds['newsletter_mail'];?></td>
				<td><?php echo $subscribeds['newsletter_date'];?></td>
                        <td>
                              <button data-id="<?php echo $subscribeds['id'];?>"><i class="fas fa-times"></i></button>
                        </td>
			</tr>
			<?php endforeach; ?>
                  <tr>
                        <?php if(!empty($errors['global'])) echo $errors['global']; ?>
                        <form action="" method="post">
                              <td>
                                    <label>
                                          <input type="text" value="" name="lastname" placeholder="prenom"/>
                                          <?php if(!empty($errors['lastname'])): ?>
                                          <span class="error"><?php echo $errors['lastname']; ?></span>
                                          <?php endif; ?>
                                    </label>
                              </td>

                              <td>
                                    <label>
                                          <input type="text" value="" name="firstname" placeholder="nom"/>
                                          <?php if(!empty($errors['firstname'])): ?>
                                          <span class="error"><?php echo $errors['firstname']; ?></span>
                                          <?php endif; ?>
                                    </label>
                              </td>

                              <td>
                                    <label>
                                          <input type="text" value="" name="email" placeholder="email"/>
                                          <?php if(!empty($errors['email'])): ?>
                                          <span class="error"><?php echo $errors['email']; ?></span>
                                          <?php endif; ?>
                                    </label>
                              </td>
                              <td>
                                    <!-- time -->
                              </td>
                              <td>
                                   <button type="submit"><i class="fas fa-check"></i></button>
                              </td>

                              
                        </form>
                  </tr>
                  <tr>
                        <td colspan="5">Ajouter un utilisateur</td> 
                  </tr>
		</table>
	</div>

	<div>
		<a href="logout.php">Déco</a>
	</div>
	<script src="main.js"></script>
</body>
</html>