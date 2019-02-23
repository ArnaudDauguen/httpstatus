<?php
	$_SESSION['come_from'] = HTTP_PWD;
	$logged = $_SESSION['logged'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8">
   		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
	</head>
	<body>
		<nav>
			<a href="./" class="navbar navbar-expand-lg navbar-light" >Home page</a>
			<?php
				if($logged){
			?>
					<a href="<?php echo HTTP_PWD . '/add_site'; ?>" class="btn navbar-btn"> Add </a>
			<?php
				}
			?>
			<?php if($_SESSION['logged'] === true){ ?>
				<a href="<?php echo HTTP_PWD . '/logout'; ?>" class="btn navbar-btn"> Loggout </a>
			<?php }else{ ?>
				<a href="<?php echo HTTP_PWD . '/login'; ?>" class="btn navbar-btn"> Login </a>
			<?php } ?>
		</nav>

		<div class="container" style="margin-bottom:50px;">
			<h1>Httpstatus</h1>
			<h2>Justin Sella, Arnaud Dauguen </h2>
		</div>
