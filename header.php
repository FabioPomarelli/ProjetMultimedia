<!DOCTYPE html>
<html lang="fr" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav.png">
  <!-- Author Meta -->
  <meta name="author" content="CodePixar">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>Multimédia</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  <!--
			CSS
      ============================================= -->
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <link rel="stylesheet" href="css/linearicons.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/nice-select.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel='stylesheet' href='css/simplelightbox.min.css'>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/mon_css.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>
  <!-- Start Header Area -->
  <nav id='nav' class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="http://www.ldnr.fr"><img src="img/logo.png" alt=""></a>
<!--   -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item active" >
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active" >
          <a class="nav-link" href="index.php?action=search">SEARCH</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            CONNECTION
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php echo isset($_SESSION['nom'])? '':'<a class="dropdown-item" href="" data-toggle="modal" data-target="#darkModalFormLogin">Login</a>'; ?>
            
            <div class="dropdown-divider"></div>
            <?php echo isset($_SESSION['nom'])? '<a class="dropdown-item" href="" data-toggle="modal" data-target="#darkModalFormLogout">Logout</a>':''; ?>
            <?php echo isset($_SESSION['nom'])? '<a class="dropdown-item" href="index.php?action=formulaire">Ajouter Multimédia</a>':''; ?>
            
            
          </div>
          
          
        </li>
        
        <li>
        <a class="nav-link"> <?php echo isset($_SESSION['nom'])? $_SESSION['nom']:''; ?></a>
        </li>
      </ul>
      <form class="form-inline" id='myNavForm'>
        <input type="hidden" name="action" value="search_res" class="form-control mt-20">
        <select name="select_mime" id='selectnavbar'>
          <option value="all">Choix:</option>
          <option value="image">Image</option>
          <option value="video">Vidéo</option>
          <option value="audio">Audio</option>
        </select>
    
</div>
    <input class="form-control" name="recherche" type="text" placeholder="Search" aria-label="Search" onfocus="this.placeholder = ''"
      onblur="this.placeholder = 'nom du fichier'" required>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" href="javascript:{}" onclick="document.getElementById('myNavForm').submit();">Search</button>
    </form>
    </div>
  </nav>






  <!-- Modal -->
  <div class="modal fade" id="darkModalFormLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog form-dark" role="document">
      <!--Content-->
      <div class="modal-content card card-image" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/pricing-table%20(7).jpg');">
        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
          <!--Header-->
          <div class="modal-header text-center pb-4">
            <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>SIGN</strong> <a class="green-text font-weight-bold"><strong>
                  UP</strong></a></h3>
            <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->




          <div class="modal-body">
            <!--Body-->

            <form class="booking-form" id="login" action="#" method="POST">
              <input type="hidden" name="action" value="authentification_res" />
              <div class="md-form mb-5">
                <input name="nom" type="text" id="Form-email5" class="form-control validate white-text" placeholder="ex : User1234"
                  required>
                <label data-error="wrong" data-success="right" for="Form-email5">Votre nom</label>
              </div>

              <div class="md-form pb-3">
                <input name="password" type="password" id="Form-pass5" class="form-control validate white-text"
                  placeholder="ex : Mot2pass!" required>
                <label data-error="wrong" data-success="right" for="Form-pass5">Votre password</label>
              </div>

              <!--Grid row-->
              <div class="row d-flex align-items-center mb-4">

                <!--Grid column-->
                <div class="text-center mb-3 col-md-12">
                  <button type="button" class="btn btn-success btn-block btn-rounded z-depth-1" data-dismiss="modal"
                    href="javascript:{}" onclick="document.getElementById('login').submit();">Login</button>
                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-12">
                  <button type="button" class="btn btn-success btn-block btn-rounded z-depth-1" data-dismiss="modal"
                    href="javascript:{}" onclick="$(document).ready(function(){$('#darkModalFormNewCompte').modal('show');});" class="green-text ml-1 font-weight-bold">
                  Créer un compte </button>
                </div>
                <!--Grid column-->
            </form>
          </div>
          <!--Grid row-->

        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
  </div>
  <!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="darkModalFormNewCompte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog form-dark" role="document">
      <!--Content-->
      <div class="modal-content card card-image" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/pricing-table%20(7).jpg');">
        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
          <!--Header-->
          <div class="modal-header text-center pb-4">
            <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>S'ENREGISTRER</strong></h3>
            <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->




          <div class="modal-body">
            <!--Body-->

            <form class="booking-form" id="new_user" action="#" method="POST">
              <input type="hidden" name="action" value="nouveau_user" />
              <div class="md-form mb-5">
                <input name="nom" type="text" id="Form-email3" class="form-control validate white-text" placeholder="ex : User1234"
                  required>
                <label data-error="wrong" data-success="right" for="Form-email3">Votre nom</label>
              </div>

              <div class="md-form pb-3">
                <input name="password" type="password" id="Form-pass4" class="form-control validate white-text"
                  placeholder="ex : Mot2pass!" required>
                <label data-error="wrong" data-success="right" for="Form-pass4">Votre password</label>
              </div>

              <!--Grid row-->
              <div class="row d-flex align-items-center mb-4">

                <!--Grid column-->
                <div class="text-center mb-3 col-md-12">
                  <button type="button" class="btn btn-success btn-block btn-rounded z-depth-1" data-dismiss="modal"
                    href="javascript:{}" onclick="document.getElementById('new_user').submit();">S'ENREGISTRER</button>
                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <!--Grid column-->
            </form>
          </div>
          <!--Grid row-->

        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
  </div>
  <!-- Modal -->

  <!-- Modal -->
  <div class="modal fade" id="darkModalFormLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog form-dark" role="document">
      <!--Content-->
      <div class="modal-content card card-image" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/pricing-table%20(7).jpg');">
        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
          <!--Header-->
          <div class="modal-header text-center pb-4">
            <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>LOGOUT</strong></h3>
            <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">


            <!--Grid row-->
            <div class="row d-flex align-items-center mb-4">

              <!--Grid column-->
              <div class="text-center mb-3 col-md-12">
                <form class="booking-form" id="logout" action="#" method="POST">
                  <input type="hidden" name="action" value="logout" class="form-control mt-20">
                  <button type="button" class="btn btn-success btn-block btn-rounded z-depth-1" data-dismiss="modal"
                    href="javascript:{}" onclick="document.getElementById('logout').submit();">Logout</button>
                </form>
              </div>
              <!--Grid column-->
            </div>
            <!--Grid row-->
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="darkModalFormMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog form-dark" role="document">
      <!--Content-->
      <div class="modal-content card card-image" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/pricing-table%20(7).jpg');">
        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
          <!--Header-->
          <div class="modal-header text-center pb-4">
            <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong><?php if (isset($_SESSION['msgUpdate'])) {$array = explode('<12345/>',$_SESSION['msgUpdate']);foreach($array as $a) echo htmlspecialchars($a)."<br/><br/>";} ?></strong></h3>
            <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">

            <!--Grid row-->
            <div class="row d-flex align-items-center mb-4">
              
              <!--Grid column-->
              <div class="text-center mb-3 col-md-12">
                <form class="booking-form" id="message" action="#" method="POST">
                 
                  <button type="button" class="btn btn-success btn-block btn-rounded z-depth-1" data-dismiss="modal">Close</button>
                </form>
              </div>
              <!--Grid column-->
            </div>
            <!--Grid row-->
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Modal -->



  <?php
if(isset($_SESSION['flag_message']) && $_SESSION['flag_message'] == true){
	echo "<script type='text/javascript'>
						$(document).ready(function(){
						$('#darkModalFormMessage').modal('show');
					});
				</script>";
        unset($_SESSION['flag_message']);
        unset($_SESSION['msgUpdate']);
}
?>












  </header>