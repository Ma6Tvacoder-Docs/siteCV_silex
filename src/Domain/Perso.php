<?php

namespace MicroCMS\Domain;

class Perso
{
    /**
     * Experience id.
     *
     * @var integer
     */
    private $id;

    // Adresse
    private $adresse;
    // Adresse
    private $nom;
    // Adresse
    private $content;

    // Adresse
    private $poste;

    // Facebook
    private $facebook;

    // Facebook
    private $codepen;

    // Github
    private $github;

    // Github
    private $linkedin;

    // Github
    private $twitter;

    // Prenom
    private $prenom;

    // Prenom
    private $img;

    // Telephone
    private $tel;

    public function setTel( $tel ){
      $this->tel = $tel;
      return $this;
    }
    public function getTel(){
      return $this->tel;
    }
    public function setFacebook( $facebook ){
      $this->facebook = $facebook;
      return $this;
    }
    public function getFacebook(){
      return $this->facebook;
    }
    public function setGithub( $github ){
      $this->github = $github;
      return $this;
    }
    public function getGithub(){
      return $this->github;
    }
    public function setCodepen( $codepen ){
      $this->codepen = $codepen;
      return $this;
    }
    public function getCodepen(){
      return $this->codepen;
    }
    public function setLinkedin( $linkedin ){
      $this->linkedin = $linkedin;
      return $this;
    }
    public function getLinkedin(){
      return $this->linkedin;
    }
    public function setTwitter( $twitter ){
      $this->twitter = $twitter;
      return $this;
    }
    public function getTwitter(){
      return $this->twitter;
    }
    public function setPoste( $poste ){
      $this->poste = $poste;
      return $this;
    }
    public function getPoste(){
      return $this->poste;
    }
    public function setImg( $img ){
      $this->img = $img;
      return $this;
    }
    public function getImg(){
      return $this->img;
    }
    public function getAdresse(){
      return $this->adresse;
    }
    public function setAdresse( $adresse ){
      $this->adresse = $adresse;
      return $this;
    }
    public function getPrenom(){
      return $this->prenom;
    }
    public function setPrenom( $prenom ){
      $this->prenom = $prenom;
      return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
}
