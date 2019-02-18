<!-- Start SEARCH Area -->
<section class="contact-area" id="contact">
				<div class="container-fluid">
					<div class="row d-flex justify-content-end align-items-center">
						<div class="col-lg-5 col-md-12 contact-left no-padding">
							<img class="img-fluid" src="img/contact-img.jpg" alt="">
						</div>
						<div class="col-lg-7 col-md-12 contact-right no-padding">
							<h1>Chercher un fichier</h1>
							
              <p>
								Cherche un fichier multimédia (la sélection de type de fichier n'est pas obligatoire).
							</p>

							<form enctype="multipart/form-data" class="booking-form" id="myForm" action="#" method="POST">
                  <div class="row">
                    <div class="col-lg-12 d-flex flex-column">
                        <div class="form-group">
                          <input type="hidden" name="action" value="search_res" class="form-control mt-20">
                        </div>
        
                        <div class="form-group" id="search-select">
                          <select name="select_mime"  class="form-control" id="sel1">
                            <option value="all">Choix:</option>
                            <option value="image">Image</option>
                            <option value="video">Vidéo</option>
                            <option value="audio">Audio</option>
                          </select>
                        </div>
                                            
                        <div class="form-group">
                            <input type="text" name="recherche" placeholder="nom du fichier" onfocus="this.placeholder = ''" onblur="this.placeholder = 'nom du fichier'" class="mt-12 form-control" required>
                        </div>
        
                        <div class="form-group send-btn">
                          <button class="submit-btn primary-btn mt-20 text-uppercase" name="envoyer" href="javascript:{}" onclick="document.getElementById('myForm').submit();">Rechercher<span class="lnr lnr-arrow-right"></span></button>
                        </div>
                      </div>
                    </div>
              </form>


              <!-- pop up  -->

              <div class="modal fade" id="Modalmsg" tabindex="-1" role="dialog" aria-labelledby="ModalLabelmsg" aria-hidden="true">
                
                <div class="modal-dialog" role="document">
                  
                  <div class="modal-content">
                    
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabelmsg">Message:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                           
                    <div class="modal-body"><p class="large text-center text-muted my-5">
                      <p class="text-modal"><?php echo (isset($_SESSION['msgUpdate']) ? htmlspecialchars($_SESSION['msgUpdate']) : '');?> </p>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                  </div>

                </div>

              </div>
                  
              <?php
                if(isset($_SESSION['flag_message']) && $_SESSION['flag_message'] == true)
                {
                  echo "<script type='text/javascript'>
                        $(document).ready(function(){
                        $('#Modalmsg').modal('show');
                        });
                        </script>";
                }
              ?>
              <!-- pop up  -->

					</div>
				</div>						
			<!-- </div>
		</div>	 -->
</section>
			<!-- End contact Area -->


<!--
fic de type file permettant d'envoyer un fichier (upload HTTP),
descr de type text permettant d'indiquer la description du fichier.-->










<!-- <form action="#" method="POST"> 
 <fieldset>
   <legend>Recherche d'un fichier</legend>
   <h1>Recherche d'un fichier :</h1>
   <input type="hidden" name="action" value="search_res"/>
   <select name="select_mime" >
     <option value="all">choisir</option>
     <option value="image">Image</option>
     <option value="video">Vidéo</option>
     <option value="audio">Audio</option>
   </select>
   <input type="text" name="recherche" placeholder="Entrer votre recherche"/>
   <input type="submit" name="envoyer"/>
 </fieldset>
</form>
<p><a href="<?php //echo $this->getUrl('index') ?>">Retour à la case départ</a></p> -->
<!--
fic de type file permettant d'envoyer un fichier (upload HTTP),
descr de type text permettant d'indiquer la description du fichier.-->




<!--    <div class="row">
                     <div class="col-lg-12 d-flex flex-column">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="radio1">Tous</label>
                            <input name="select_mime" class="form-check-input position-static" id="radio1" type="radio" value="all">
                            
                        </div>
                        <div class="form-check form-check-inline">
                        <label class="form-check-label" for="radio2">Image</label>
                            <input name="select_mime" class="form-check-input position-static" id="radio2" type="radio" value="image">
                            
                        </div>
                        <div class="form-check form-check-inline">
                        <label class="form-check-label" for="radio3">Vidéo</label>
                            <input name="select_mime" class="form-check-input position-static" id="radio3" type="radio" value="video">
                            
                        </div>
                        <div class="form-check form-check-inline">
                        <label class="form-check-label" for="radio4">Audio</label>
                            <input name="select_mime" class="form-check-input position-static" id="radio4" type="radio" value="audio">
                            
                        </div>
                     </div>
                   </div>
-->