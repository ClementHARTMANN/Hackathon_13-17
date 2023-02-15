<?php
class User
{
    private $user_id;
    private $user_login;
    private $user_mdp;
    private $user_nom;
    private $user_objectif;
    private $user_mail;
    private $user_activite;
    private $user_sexe;
    private $user_age;
    private $user_taille;
    private $user_poidsactuelle;
    private $user_poidsouhaite;

    public function __construct(int $user_id, string $user_login){
        $this->user_id = $user_id;
        $this->user_login = $user_login;
    }

    public function getUser_id(){
        return $this->user_id;
    }
    public function setUser_id(int $user_id){
        $this->user_id = $user_id;
        return $this;
    }

    public function getUser_login(){
        return $this->user_login;
    }
    public function setUser_login(string $user_login){
        $this->user_login = $user_login;
        return $this;
    }

    public function getUser_mdp(){
        return $this->user_mdp;
    }
    public function setUser_mdp(string $user_mdp){
        $this->user_mdp = $user_mdp;
        return $this;
    }

    public function getUser_nom(){
        return $this->user_nom;
    }
    public function setUser_nom(string $user_nom){
        $this->user_nom = $user_nom;
        return $this;
    }

    public function getUser_objectif(){
        return $this->user_objectif;
    }
    public function setUser_objectif(string $user_objectif){
        $this->user_objectif = $user_objectif;
        return $this;
    }

    public function getUser_mail(){
        return $this->user_mail;
    }
    public function setUser_mail(string $user_mail){
        $this->user_mail = $user_mail;
        return $this;
    }

    public function getUser_activite(){
        return $this->user_activite;
    }
    public function setUser_activite(string $user_activite){
        $this->user_activite = $user_activite;
        return $this;
    }

    public function getUser_sexe(){
        return $this->user_sexe;
    }
    public function setUser_sexe(string $user_sexe){
        $this->user_sexe = $user_sexe;
        return $this;
    }

    public function getUser_age(){
        return $this->user_age;
    }
    public function setUser_age(string $user_age){
        $this->user_age = $user_age;
        return $this;
    }

    public function getUser_taille(){
        return $this->user_taille;
    }
    public function setUser_taille(string $user_taille){
        $this->user_taille = $user_taille;
        return $this;
    }

    public function getUser_poidsactuelle(){
        return $this->user_poidsactuelle;
    }
    public function setUser_poidsactuelle(string $user_poidsactuelle){
        $this->user_poidsactuelle = $user_poidsactuelle;
        return $this;
    }

    public function getUser_poidsouhaite(){
        return $this->user_poidsouhaite;
    }
    public function setUser_poidsouhaite(string $user_poidsouhaite){
        $this->user_poidsouhaite = $user_poidsouhaite;
        return $this;
    }
}


?>