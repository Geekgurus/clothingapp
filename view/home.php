<?php
	
	require_once('./inc/functions.php');
	require_once('./controller/clotheController.php');

	$functions = new Functions();
	$clotheController = new clotheController();

	$clothes = json_decode($clotheController->getAll());
	shuffle($clothes);

	if(isset($_GET['clothe_id'])){
		$id = $_GET['clothe_id'];

		$clotheController->buy($id);
	}

	if (isset($_GET['clean'])) {
		$clotheController->destroy();
	}

?>
<!DOCTYPE html>
<html lang="en">
	<style>
		.mack {
    background: #000;
    height: 40px;
    width: 100%;
    color: #fff;
}

footer {
    background: #000;
    height: 40px;
    width: 100%;
}
.mack p{
	margin: 40px;
	color: #fff;
	text-align: center;
	font-weight: bolder;
}
	</style>
	<head>
		<title>Mack Cloth Store - Home </title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="view/style.css">
	</head>
	<body>
		<h1 class="title">Mack Clothing Store</h1>
		<a href="?clean" class="clean">Clear Shopping Cart List</a>
		<div id="clothes" class="container">

			<?php
				for ($i=0; $i < count($clothes); $i++) { 
			?>

					<div class="clothe-card">
						<img src="<?= $clothes[$i]->image ?>" alt="<?= $clothes[$i]->name ?>" />
						<h5><?= $clothes[$i]->name ?></h5>

					<?php
						if($functions->alreadyPurchased($clothes[$i]->id)){
							echo "<p class='purchased'>Order</p>";
						}else{
							echo "<a href='?p=final&clothe_id=".$clothes[$i]->id."'>Order Now</a>";
						}
					?>

								
						<div class="info">
							<p>gender - <?= $clothes[$i]->gender ?></p>
							<p>Material - <?= $clothes[$i]->material ?></p>
							<p>Color - <?= $clothes[$i]->color ?></p>
							<p>Origin - <?= $clothes[$i]->origin ?></p>
							<p>Type - <?= $clothes[$i]->type ?></p>
						</div>
					</div>
					

			<?php
				}
			?>
		</div>

		<footer>
			<div class="mack">
				<p>&copy; All Rights Reserved | 2023</p>
			</div>
		</footer>
	</body>
</html>