<?php

namespace MicroCMS\Domain;

class Competence
{
    /**
     * Experience id.
     *
     * @var integer
     */
    private $id;

    // Adresse
    private $nom;

    // Adresse
    private $valeur;

    // Adresse
    private $logo;

    // Adresse
    private $categorie;


    public function setId( $id ){
      $this->id = $id;
      return $this;
    }
    public function getId(){
      return $this->id;
    }
    public function setNom( $nom ){
      $this->nom = $nom;
      return $this;
    }
    public function getNom(){
      return $this->nom;
    }
    public function setValeur( $valeur ){
      $this->valeur = $valeur;
      return $this;
    }
    public function getValeur(){
      return $this->valeur;
    }
    public function getLogo(){
      return $this->logo;
    }
    public function setLogo( $logo ){
      $this->logo = $logo;
      return $this;
    }
    public function getCategorie(){
      return $this->categorie;
    }
    public function setCategorie( $categorie ){
      $this->categorie = $categorie;
      return $this;
    }
}
