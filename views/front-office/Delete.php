<?php

	include_once '../../model/perso.php';
	include_once '../../controller/persoCRUD.php';
	
	$persoCRUD=new persoCRUD();
	//recuperer id du produit puis supprimer le produit
	$persoCRUD->SupprimerPerso($_GET["id"]);

	header('Location:index.php');
	
?>