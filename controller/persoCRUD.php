<?php

	include_once '../../config.php';
	include_once '../../model/perso.php';
	
   //class crud
	class persoCRUD
{
	//affichage perso
		function AfficherPerso()
		{
			$sql="SELECT * FROM personnel";
			$db=config::getConnexion();
			try
			{
				$liste=$db->query($sql);
				return $liste;
			}
			catch(Exception $e)
			{
				die('Erreur:'. $e->getMessage());
			}
		}

	//ajout perso
		function AjouterPerso($perso)
		{
			$sql="INSERT INTO personnel (cin,nom,prenom,datee,adresse,email,tel,document_cin,titre_poste,salaire,type_contrat,rib,imagee) 
			VALUES (:cin, :nom, :prenom, :datee, :adresse, :email, :tel, :document_cin, :titre_poste, :salaire, :type_contrat, :rib, :imagee)";
			$db=config::getConnexion();
			try
			{
				$query=$db->prepare($sql);
				$query->execute([
					'cin'=>$perso->get_cin(),
					'nom'=>$perso->get_nom(),
					'prenom'=>$perso->get_prenom(),
					'datee'=>$perso->get_date(),
					'adresse'=>$perso->get_adresse(),
					'email'=>$perso->get_email(),
					'tel'=>$perso->get_tel(),
					'document_cin'=>$perso->get_document_cin(),
					'titre_poste'=>$perso->get_titre_poste(),
					'salaire'=>$perso->get_salaire(),
					'type_contrat'=>$perso->get_type_contrat(),
					'rib'=>$perso->get_rib(),
					'imagee'=>$perso->get_image()
				]);			
			}
			catch (Exception $e)
			{
				error_log('Erreur lors de l\'ajout : ' . $e->getMessage());
			}			
		}
		function SupprimerPerso($id)
		{
			$sql="DELETE FROM personnel WHERE id=:id";
			$db=config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id', $id);
			try
			{
				$req->execute();
			}
			catch(Exception $e)
			{
				die('Erreur:'. $e->getMessage());
			}
		}

		//recuperer les données des employées avec id 

		function RecupererPerso($id)
		{
			$sql="SELECT * from personnel where id=$id";
			$db=config::getConnexion();
			try
			{
				$query=$db->prepare($sql);
				$query->execute();

				$perso=$query->fetch();
				return $perso;
			}
			catch (Exception $e)
			{
				die('Erreur: '.$e->getMessage());
			}
		}

		//modifier perso

		function ModifierPerso($perso, $id)
		{
			try
			{
				$db=config::getConnexion();
				$query=$db->prepare(
					"UPDATE personnel SET 
					    cin= :cin,
						nom= :nom, 
						prenom= :prenom,
						datee= :datee,
						adresse= :adresse,
						email= :email,
						tel= :tel,
						document_cin= :document_cin,
						titre_poste= :titre_poste,
						salaire= :salaire,
						type_contrat= :type_contrat,
						rib= :rib,
						imagee= :imagee
					WHERE id= :id"  
				);
				$query->execute([
					'cin'=>$perso->get_cin(),
					'nom'=>$perso->get_nom(),
					'prenom'=>$perso->get_prenom(),
					'datee'=>$perso->get_date(),
					'adresse'=>$perso->get_adresse(),
					'email'=>$perso->get_email(),
					'tel'=>$perso->get_tel(),
					'document_cin'=>$perso->get_document_cin(),
					'titre_poste'=>$perso->get_titre_poste(),
					'salaire'=>$perso->get_salaire(),
					'type_contrat'=>$perso->get_type_contrat(),
					'rib'=>$perso->get_rib(),
					'imagee'=>$perso->get_image(),
					'id'=>$id
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			}
			catch (PDOException $e)
			{
				$e->getMessage();
			}
		}

		//chercher le poste
		function RechercherPoste($titre_poste)
		{
			$db=config::getConnexion();
			try {
				$query = $db->query("SELECT * FROM personnel WHERE titre_poste LIKE '%$titre_poste%' ");
				$query->execute(/*['nom_produit'=>$Nom_Prod]*/);
				$liste=$query->fetchALL();
				return $liste;
			   
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		// filtrer entre deux dates de naissance
        function RechercherDates($date1, $date2)
        {
           $db = config::getConnexion();
           try {
           $query = $db->prepare("SELECT * FROM personnel WHERE datee BETWEEN :date1 AND :date2");
           $query->bindParam(':date1', $date1);
           $query->bindParam(':date2', $date2);
           $query->execute();
           $liste = $query->fetchAll();
           return $liste;
           } catch (PDOException $e) {
           $e->getMessage();
           }
        }

function Rechercher($Nom)
		{
			$db=config::getConnexion();
			try {
				$query = $db->query("SELECT * FROM personnel WHERE nom LIKE '%$Nom%' ");
				$query->execute(/*['nom_produit'=>$Nom_Prod]*/);
				$liste=$query->fetchALL();
				return $liste;
			   
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
	}

?>