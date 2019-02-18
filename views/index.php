<section class="banner-area relative" id="home">			
				<div class="slider"><div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				        <div class="carousel-inner" role="listbox">
				          <!-- Slide One - Set the background image for this slide in the line below -->
				          <div class="carousel-item active" style="background-image: url('img/slider1.jpg')">
				            <div class="carousel-caption d-md-block">
				              <h2 class="text-uppercase">Projet Multimédia</h2>
				              <H3 class="h3-titre">
								Le PHP et la programmation Objet, c'est la vie ! <br> -- Christine, Benoît, Fabio, Guilhem --
				              </H3>
				            </div>
				          </div>
				          <!-- Slide Two - Set the background image for this slide in the line below -->
				          <div class="carousel-item" style="background-image: url('img/slider2.jpg')">
				            <div class="carousel-caption d-md-block">
				              <h2 class="text-uppercase">Projet Multimédia</h2>
				              <H3 class="h3-titre">
                              Le PHP et la programmation Objet, c'est la vie ! <br> -- Christine, Benoît, Fabio, Guilhem --
				              </H3>
				            </div>
				          </div>
				          <!-- Slide Three - Set the background image for this slide in the line below -->
				          <div class="carousel-item" style="background-image: url('img/slider3.jpg')">
				            <div class="carousel-caption d-md-block">
				              <h2 class="text-uppercase">Projet Multimédia</h2>
				              <H3 class="h3-titre">
                              Le PHP et la programmation Objet, c'est la vie ! <br> -- Christine, Benoît, Fabio, Guilhem --	
				              </H3>
				            </div>
				          </div>
				        </div>
				        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				          <span class="sr-only">Previous</span>
				        </a>
				        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				          <span class="carousel-control-next-icon" aria-hidden="true"></span>
				          <span class="sr-only">Next</span>
				        </a>
				      </div>
				</div>
			</section>
			<!-- End banner Area -->	


			

			<!-- Start gallery Area -->
			<section class="gallery-area section-gap" id="gallery">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-8 pb-30 header-text">
							<h1 class="text-white">Media récemment ajoutés</h1>
							<p>Ci dessous, les 16 derniers média ajoutés à la base de données.</p>
							<p>Affiche aussi bien les images, les vidéos et les fichiers audios.</p>
							<p>Attention, les vidéos et les fichiers audios se lancent tous seuls. Enjoy !</p>
						</div>
					</div>
					<div class="gal">

					<?php
									if (isset($gallery))
									{
										foreach($gallery as $item ) {
											echo $item ;
										}
									}
									
					?>
					</div>
				</div>
			</section>
	
		<!--	<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
		<script type="text/javascript">
    var iframe = $('.audiovideo')[0];
		console.log(iframe);
		player = $f(iframe);

    player.addEvent('ready', function() {
        player.api('setVolume', 0);
    });
</script>-->

<!--width="250"	

	<a href="img/p15.jpg"><img src="img/p15.jpg" alt=""></a>
						<a href="img/p16.jpg"><img src="img/p16.jpg" alt=""></a>
			     $result = '<video controls>
                                    <source src="%s" type="video/%s">
                                    Désolé, votre navigateur est moisi !
                                    </video>';
                    return sprintf($result,htmlspecialchars($this->chemin_relatif),htmlspecialchars($this->mime_type));
                }
                if( in_array($this->mime_type, SELF::mime_audios_allowed, true))
                {
                    $result = '<audio controls src="%s">
                                Désolé, votre navigateur est moisi !
                                </audio>';
                    return sprintf($result,htmlspecialchars($this->chemin_relatif));
                }
                if( in_array($this->mime_type, SELF::mime_images_allowed, true))
                {
                    $result = '<img style="width:400px;" src="%s" alt="%s"/>';   
	3b87b0a651b24edd66c2b269c15aee63ed889d9f5b34f8327833a3f31dc3d9e8.mp4
										-->