<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Bdd.php';
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'User.php';

class Gestionnaire
{
    //Fonction utiliser pour se connecter 
    //Si l'utilisateur exist : renvoie l'utilisateur
    //Si l'utilisateur n'existe pas : renvoie false et un tableau vide 
    public function getConnexion($login, $mdp){
        $bdd = new Bdd();
        $accesConnexion = array(
            "connexion" => false,
            "user" => null,
        );

        $rqt = 'SELECT * FROM user WHERE user.login = ? AND user.mdp = ?;';
        $lesValeurs = array(strtolower($login),$mdp);//strtolower() permet de mettre tous le string en minuscule
        $resultat = $bdd->rqtProteger($rqt, $lesValeurs);
        if($resultat){
            // $leUser = new User($resultat[0]['user_id'], $resultat[0]['identifiant']);

            $accesConnexion["connexion"] = true;
            $accesConnexion["user"] = $resultat[0];
        }
        // var_dump($accesConnexion);
        return $accesConnexion;
    }

    //Fonction utiliser pour verifier si l'utilisateur est connecter
    //si l'utilisateur est connecter : verfie si le type d'utilisateur est le bon
    //la fonction doit recuperer la session entiere
    public function verifConnexionClient($laSession){
        $etreConnecter = false;
        if(isset($laSession['compte'])){//si la session existe
            if($laSession['compte']['connexion']){//si la varriable de session 'connexion' est true
                    $etreConnecter = true;
                
            }
        }
        return $etreConnecter;
    } 
    
    //Verifier un mots de passe :
    public function verifMdpByUserId($user_id, $mdp){
        $retour = false;
        $bdd = new Bdd();
        $rqt = 'SELECT user.id FROM user WHERE user.id = ? AND user.mdp = ?;';
        $lesValeurs = array($user_id,md5($mdp));
        $resultat = $bdd->rqtProteger($rqt, $lesValeurs);
        
        //Si le mots de passe est bon
        if($resultat){
            $retour = true;
        }
        return $retour;
    }

    //Changer le mots de passe d'un utilisateur :
    public function changerMdp($user_id, $new_mdp){
        $rqt = "UPDATE `user` SET `mdp` = ? WHERE `user`.`id` = ?;";
        $bdd = new Bdd();
        $lesValeurs = array(md5($new_mdp), $user_id);
        $resultat = $bdd->rqtProtegerSansReturn($rqt, $lesValeurs);
    }

    //Changer le login d'un utilisateur :
    public function changerlogin($user_id, $new_login){
        $rqt = "UPDATE `user` SET `login` = ? WHERE `user`.`id` = ?;";
        $bdd = new Bdd();
        $lesValeurs = array($new_login, $user_id);
        $resultat = $bdd->rqtProtegerSansReturn($rqt, $lesValeurs);
    }

    //Chnger l'identifiant d'un utilisateur :
    public function changerIdent($user_id, $new_id){
        $rqt = "UPDATE `user` SET `identifiant` = ? WHERE `user`.`id` = ?;";
        $bdd = new Bdd();
        $lesValeurs = array($new_id, $user_id);
        $resultat = $bdd->rqtProtegerSansReturn($rqt, $lesValeurs);
    }
    
    public function inscriptionNewClient($userId, $mdp, $login){
        $rqt = "INSERT INTO `user`(`id`, `identifiant`, `mdp`, `login`) VALUES (NULL,?,?,?);";
        $bdd = new Bdd();
        $lesValeurs = array($userId, md5($mdp), $login);
        $resultat = $bdd->rqtProtegerSansReturn($rqt, $lesValeurs);
    }


}



?>