<?php
  require 'class' . DIRECTORY_SEPARATOR . 'Gestionnaire.php';

  //recuperation de page dans l'URL :
  if(isset($_REQUEST['page'])){
    //Verifier si la la variable page n'est pas vide
    if($_REQUEST['page'] != ""){
        $page = $_REQUEST['page'];
        //Si la virable page est differant de ce qui est autoriser
        if($page != "connexion" && $page != "inscription" && $page != "motsDePasseOublier"){
            $page = "connexion";
        }
    } else {//si la virable page est vide
        $page = "connexion";
    }
  } else {//si la virable page n'existe pas
    $page = "connexion";
  }


  //Connexion au compte :
  if( isset($_POST['login']) && isset($_POST['mdp']) ){
    $gst = new Gestionnaire;
    $connexion = $gst->getConnexion($_POST['login'], $_POST['mdp']);//recuperation de la connexion
    // var_dump($connexion);


  if(!$connexion["connexion"]){//si l'utilisateur n'existe pas
    echo "<p>Identifient ou mots de passe incorrect</p>";
    } else  {//si l'utilisateur existe
      session_start();
      $_SESSION["compte"] = $connexion;
    }
  }
?>

<script>window.location.replace("index.php");</script>

<?php

  //inscription :
  if(isset($_POST["id"]) && isset($_POST["email"]) && isset($_POST["mdp1"]) && isset($_POST["mdp2"]) ){
    if($_POST["mdp1"] == $_POST["mdp2"]){
        
      $gst = new Gestionnaire;
      $connexion = $gst->getConnexion($_POST['id'], $_POST['mdp1']);

      if(!$connexion["connexion"]) {//Verifier si le compte n'existe pas deja
        
        if(strlen($_POST["mdp1"]) > 10){//S'assuerer que le mots de passe contien bien 10 caracteres au minimum
          
          $gst->inscriptionNewClient($_POST['id'], $_POST['mdp1'], $_POST["email"]);//Fonction d'inscription
          echo '<script>window.alert("Votre compte est créer, connectez vous");</script>';
          echo '<script>window.location.replace("?page=connexion");</script>';//Redirection sur connection
        } else {
          echo "Votre mots de passe doit contenir au minimum 10 caractères";
        }
      } else {
        echo "Vous etes déjà inscrit, veuillez vous connecter";
      }
    } else {
      echo "Mots de passe pas identique";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Healthy Eating - Hackathon</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/body.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
          document.querySelectorAll("input[type='submit']").forEach(function(button) {
            button.addEventListener("click", function(event) {
              event.preventDefault();
              if (this.value === "S'inscrire") {
                window.location.href = "page2.html";
              } else if (this.value === "Se connecter") {
                window.location.href = "page3.html";
              }
            });
          });
        });
      </script> -->

</head>
<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.html" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>Healthy Eating</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-lg-auto py-0">
                <h1 class="nav-item nav-link">Bienvenue chez Healthy Eating</h1>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    
      <p class="header-text">A new way to track and improve your eating habits</p>
    
      <!-- Add the form -->
      <!-- <form>
        <input type="text" placeholder="Enter your name" required>
        <input type="email" placeholder="Enter your email" required>
        <input type="password" placeholder="Enter your password" required>
        <input type="submit" value="Se connecter">
        <input type="submit" value="S'inscrire" >
      </form> -->


<?php
  if($page == "connexion"){//Partie connexion pour
?>

<div class="container page_acceuil">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <h4>Connectez vous, retrouvez votre suivi</h4><br>
        <form method="POST" action="">
          <div class="mb-3">
            <label class="form-label">Identifiant</label>
            <input name="login"  type="text" class="form-control" placeholder="Entrez votre identifiant" autocomplete="off" Required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mots de passe</label>
            <input name="mdp" type="password" class="form-control" placeholder="Entrez votre mots de passe" autocomplete="off" Required>
            <p class="text-"><small>Mots de passe oublié ? <a href="?page=motsDePasseOublier" style="color:#566573">Cliquez ici</a></small></p>
          </div>
          <div class="d-grid gap-2 bouton_connexion">
            <button type="submit" class="btn btn-outline-dark">Connexion</button>
          </div>
          <p class="text-center">Pas encore inscrit ? <a href="?page=inscription" style="color:#566573">Inscrivez vous</a></p>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  } else {

    if($page == "inscription"){//Partie Inscription
?>
  <div class="container page_acceuil">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
          <h4>Inscrivez vous</h4><br>
            <form method="POST" action="">
              <div class="mb-3">
                <label class="form-label">Identifiant de connexion</label>
                <input name="id" type="text" class="form-control" placeholder="Entrez votre identifiant" autocomplete="off" Required>
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email"  type="text" class="form-control" placeholder="Entrez votre mail" autocomplete="off" Required>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label class="form-label">Mots de passe</label>
                    <input name="mdp1" placeholder="Entrez votre mots de passe" type="password" class="form-control" autocomplete="off" Required>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label class="form-label">Confirmer votre Mots de passe</label>
                    <input name="mdp2" placeholder="Confirmer votre mots de passe" type="password" class="form-control" autocomplete="off" Required>
                  </div>
                </div>
              </div>
              <div class="d-grid gap-2 bouton_connexion">
                <button type="submit" class="btn btn-outline-dark">S'inscrire</button>
              </div>
              <p class="text-center">Vous avez deja un compte ? <a href="?page=connexion" style="color:#566573">Connectez vous</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>

            
            <?php
        }else{
            if($page == "motsDePasseOublier"){//Partie Mots de passe oublié
            ?>
            <div class="container page_acceuil">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="shadow-lg p-3 mb-5 bg-body rounded">
                            <h4>Mots de passe oublié</h4><br>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label class="form-label">Saisissez votre Email</label>
                                    <input name="email"  type="text" class="form-control" placeholder="Entrez votre mail" autocomplete="off" Required>
                                </div>
                                <div class="d-grid gap-2 bouton_connexion">
                                    <button type="submit" class="btn btn-outline-dark">Valider</button>
                                </div>
                                <p class="text-center">Vous avez deja un compte ? <a href="?page=connexion" style="color:#566573">Connectez vous</a></p>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>

            <?php
            }
        }
    }

    
    ?>



</body>

</html>