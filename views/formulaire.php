<!-- Start INSERT Area -->
<section class="contact-area" id="contact">
				<div class="container-fluid">
					<div class="row d-flex justify-content-end align-items-center">
						<div class="col-lg-5 col-md-12 contact-left no-padding">
							<img class="img-fluid" src="img/contact-img.jpg" alt="">
						</div>
						<div class="col-lg-7 col-md-12 contact-right no-padding">
							<h1>Ajouter un fichier</h1>
							<p>
								Ajouter un fichier multimédia.
							</p>
							<form enctype="multipart/form-data" class="booking-form" id="myForm" action="#" method="POST">
								 	<div class="row">
								 		<div class="col-lg-12 d-flex flex-column">
                       <input type="hidden" name="action" value="formulaire_res" class="form-control mt-20">
                       <input type="hidden" name="MAX_FILE_SIZE" value="6000000" class="form-control mt-20">
                     </div>
                  
							 			<div class="col-lg-12 d-flex flex-column">
											<input type="file" name="fic" accept="<?php echo htmlspecialchars($mime_allowed)?>" class="common-input mt-10" required>
										</div>									
										<div class="col-lg-12 flex-column">
                    <input type="text" name="descr" placeholder="Description du fichier" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description du fichier'" class="common-input mt-10" required>
										</div>
										
										<div class="col-lg-12 d-flex justify-content-end send-btn">
											<button class="submit-btn primary-btn mt-20 text-uppercase" name="envoyer" href="javascript:{}" onclick="document.getElementById('myForm').submit();">Ajouter<span class="lnr lnr-arrow-right"></span></button>
										</div>

										<div class="alert-msg"></div>		
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
                        if(isset($_SESSION['flag_message']) && $_SESSION['flag_message'] == true){
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
					</div>
				</div>	
			</section>
			<!-- End contact Area -->



<!--
fic de type file permettant d'envoyer un fichier (upload HTTP),
descr de type text permettant d'indiquer la description du fichier.-->