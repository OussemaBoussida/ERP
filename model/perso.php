<?php

	class personnel
	{
		private $id;
		private $cin;
		private $nom;
		private $prenom;
		private $datee;
		private $adresse;
		private $email;
        private $tel;
        private $document_cin;
        private $titre_poste;
        private $salaire;
        private $type_contrat;
        private $rib;
        private $imagee;
		
		//Constructor
		public function __construct($id,$cin, $nom, $prenom, $datee, $adresse, $email, $tel, $document_cin, $titre_poste, $salaire, $type_contrat, $rib, $imagee)
		{
			$this->id=$id;
			$this->cin=$cin;
			$this->nom=$nom;
			$this->prenom=$prenom;
			$this->datee=$datee;
			$this->adresse=$adresse;
			$this->email=$email;
			$this->tel=$tel;
            $this->document_cin=$document_cin;
			$this->titre_poste=$titre_poste;
			$this->salaire=$salaire;
			$this->type_contrat=$type_contrat;
            $this->rib=$rib;
			$this->imagee=$imagee;
		}

		//Getters
		public function get_id()
		{
			return $this->id;
		}
		public function get_cin()
		{
			return $this->cin;
		}

		public function get_nom()
		{
			return $this->nom;
		}

		public function get_prenom()
		{
			return $this->prenom;
		}

		public function get_date()
		{
			return $this->datee;
		}

		public function get_adresse()
		{
			return $this->adresse;
		}
		
		public function get_email()
		{
			return $this->email;
		}
		public function get_tel()
		{
			return $this->tel;
		}
        public function get_document_cin()
		{
			return $this->document_cin;
		}
		public function get_titre_poste()
		{
			return $this->titre_poste;
		}
		public function get_salaire()
		{
			return $this->salaire;
		}
		public function get_type_contrat()
		{
			return $this->type_contrat;
		}
        public function get_rib()
		{
			return $this->rib;
		}
        public function get_image()
		{
			return $this->imagee;
		}
		
	}

?>