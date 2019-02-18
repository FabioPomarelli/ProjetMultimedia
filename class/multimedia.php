<?php
include('../error_handling.php');
class Multimedia
{
    public $id_datas;
    public $chemin_relatif;
    public $name_origin;
    public $mime_type;
    public $description ;
    public $auteur_id;
    public $date;


    /*
    .ogg per Ogg contenente solo audio in formato Vorbis
    .spx per Ogg contenente solo audio in formato Speex
    .oga per Ogg contenente solo audio in FLAC o OggPCM
    .ogv per Ogg contenente almeno un flusso video
*/

    // types de fichiers demandés
    const mime_videos_allowed = ['webm','mp4','ogv'];
    const mime_audios_allowed = ['webm','weba','ogg','spx','oga'];
    const mime_images_allowed = ['jpg','svg','jpeg', 'png', 'tiff', 'gif', 'jpeg','jpe'];
    
    // répertoires de sauvegarde des fichiers
    const dir_audios='/multimedia/audios/';
    const dir_videos='/multimedia/videos/';
    const dir_images='/multimedia/images/';
    

    // renvoie le chemin depuis la racine du disque dur vers la racine du répertoire courant, en fonction
    // des versions de PHP
    public static function getRacine()
    {
        if (defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION <7) {
            if (defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION <5.3) {
                //For PHP < 5.3 use:
                return realpath(dirname(__FILE__) . '/..');
            } else {
                //In PHP 5.3 to 5.6 use:
                return realpath(__DIR__ . '/..');
            }
        } else {
            //In PHP >= 7.0 use:
            return  dirname(__DIR__, 1);
        }
    }

    public static function getMimeAllowed():string
    {
        $resultat = "";
        foreach (SELF::mime_images_allowed as $item) {
            $resultat .= 'image/'.$item.', ';
        }
        foreach (SELF::mime_audios_allowed as $item) {
            $resultat .= 'audio/'.$item.', ';
        }
        $compteur = 0;
        foreach (SELF::mime_videos_allowed as $item) {
            if ($compteur == (sizeof(SELF::mime_videos_allowed) - 1)) {
                $resultat .= 'video/'.$item;
            } else {
                $resultat .= 'video/'.$item.', ';
            }
            
            $compteur++;
        }
        // $resultat = implode(',',SELF::mime_audios_allowed);
        // $resultat .= ','.implode('image/',SELF::mime_images_allowed);
        // $resultat .= ','.implode(',',SELF::mime_videos_allowed);
        // echo $resultat;
        return $resultat;
    }

    public function __construct()
    {
        //récupère un tableau contenant les paramètres
        $a = func_get_args();
        //compte le nombre d'arguments passés en paramètre du construct
        $i = func_num_args();
        //passe un tableau contenant les arguments ($a) aux autres __construct()
        if (method_exists($this, $f='__construct'.$i)) {
            //appelle le construct correspondant (en fonction du nombre d'arguments passés en paramètre, en)
            //lui passant un tableau de paramètre ($a)
            call_user_func_array(array($this,$f), $a);
        }
    }

    public function __construct3($FILES, $commentaire_file, $auteur, $id=0)
    {
        $this->_FILES=$FILES;
        $this->description =$commentaire_file;
        $this->auteur_id=$auteur;//IMPORTANT INTEGER
        $this->id= $id;         //IMPORTANT INTEGER CLEF UPDATE
        $this->date=date("Y-m-d H:i:s");
        // $this->move_single_file();
    }
    //  function __construct3($FILES , $commentaire_file, $auteur, $id=0)
    //  {
    //     $this->_FILES=$FILES;
    //     // $this->move_single_file();
    //     $upload_info = $this->move_single_file();
    //     //salvo i parametri
    //     $this->chemin_relatif ='.'.$upload_info['sub_folder_to_move'].$upload_info['name'];
    //     $this->name_origin= $upload_info['name_origin'];
    //     $this->mime_type=$upload_info['extension'];
    //     $this->description =$commentaire_file;
    //     $this->auteur_id=$auteur;//IMPORTANT INTEGER
    //     $this->id= $id;         //IMPORTANT INTEGER CLEF UPDATE
    //     $this->date=date("Y-m-d H:i:s");                    //2014-04-17 13:55:12
    //     // $today = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (the MySQL DATETIME format)
    // }

    public function __construct6($chemin_relatif, $name_origin, $mime_type, $description, $auteur_id, $date, $id=0)
    {
        $this->chemin_relatif =  $chemin_relatif; //$OBJ->chemin_relatif;
        $this->mime_type = $mime_type;
        $this->description = $description;
        $this->auteur_id = $auteur_id;         //IMPORTANT INTEGER
        $this->date = $date;
        $this->id= $id;   //IMPORTANT INTEGER CLEF UPDATE
        $this->name_origin = $name_origin;
    }
    public function __construct7($id_datas, $chemin_relatif, $name_origin, $mime_type, $description, $auteur_id, $date)
    {
        $this->chemin_relatif =  $chemin_relatif; //$OBJ->chemin_relatif;
        $this->mime_type = $mime_type;
        $this->description = $description;
        $this->auteur_id = $auteur_id;         //IMPORTANT INTEGER
        $this->auteur = ModelUser::getInstance()->getAuteur($this->auteur_id);
        $this->date = $date;
        $this->id_datas = $id_datas;   //IMPORTANT INTEGER CLEF UPDATE
        $this->name_origin = $name_origin;
    }



    public function move_single_file(bool $mime = true, bool $return_json = true):array
    {
        if (is_uploaded_file($this->_FILES['tmp_name'])) {
            $new_name_file = bin2hex(random_bytes(32)).'.'.pathinfo($this->_FILES['name'], PATHINFO_EXTENSION);
            $upload_info = array(
                'name_origin' => $this->_FILES['name'], //'.'.pathinfo($this->_FILES['name'], PATHINFO_EXTENSION);
                'name' => $new_name_file,
                'size' => $this->_FILES['size'],
                'mime' => finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->_FILES['tmp_name']),
                'extension' => strtolower(pathinfo($this->_FILES['name'], PATHINFO_EXTENSION)),
                'check_mime' => true,
                'folder_racine' => SELF::getRacine(),
                'sub_folder_to_move' => '/multimedia',
                'error_code' => $this->_FILES['error'],

            );

            if ($mime) {
                if ($mime && in_array($upload_info['extension'], SELF::mime_videos_allowed, true)) {
                    $upload_info['sub_folder_to_move']=SELF::dir_videos;
                    $upload_info['check_mime'] = true;
                }
                if ($mime && in_array($upload_info['extension'], SELF::mime_audios_allowed, true)) {
                    $upload_info['sub_folder_to_move']=SELF::dir_audios;
                    $upload_info['check_mime'] = true;
                }
                if ($mime && in_array($upload_info['extension'], SELF::mime_images_allowed, true)) {
                    $upload_info['sub_folder_to_move']=SELF::dir_images;
                    $upload_info['check_mime'] = true;
                }
            } else {
                $upload_info['check_mime'] = false;
            }
           
            if ($upload_info['error_code'] === 0 && $upload_info['check_mime'] === true) {
                move_uploaded_file($this->_FILES['tmp_name'], $upload_info['folder_racine'].$upload_info['sub_folder_to_move'].$upload_info['name']);
            }
            return $upload_info;
        }
    }

    public function toHTML()
    {
        if (in_array($this->mime_type, SELF::mime_videos_allowed, true)) {
            $result = "<div class='embed-responsive embed-responsive-4by3'><iframe class='embed-responsive-item audiovideo' src='%s'autoplay=1 loop muted></iframe></div>";
            return sprintf($result, htmlspecialchars($this->chemin_relatif));
        }
        if (in_array($this->mime_type, SELF::mime_audios_allowed, true)) {
            $result = "<div class='embed-responsive embed-responsive-4by3'><iframe class='embed-responsive-item audiovideo' src='%s'autoplay=1 loop muted></iframe></div>";
            return sprintf($result, htmlspecialchars($this->chemin_relatif));
        }
        if (in_array($this->mime_type, SELF::mime_images_allowed, true)) {
            $result = '<a href=%s><img src="%s" alt="%s"/></a>';
            return sprintf($result, htmlspecialchars($this->chemin_relatif), htmlspecialchars($this->chemin_relatif), htmlspecialchars($this->description));
        }
    }

    public function toHTMLforSearch()
    {
        //video fluid-width-video-wrappertype="video/mp4"
        $videoHtml=<<<EOF
>
<div class="view">
  <video controls class="video-fluid videocarousel" autoplay loop muted>
  <source src="%s" />
</video>

</div>
<div class="carousel-caption">
<h2 class="text-uppercase couleur-texte">%s</h2>
<H3 class="couleur-texte">
    %s	
</H3>
</div>
</div>
EOF;

        $audioHtml=<<<EOF
>
<div class="view carouselresponce">
  <audio controls class="video-fluid" autoplay loop muted src="%s">
</audio>

</div>
<div class="carousel-caption">
<h2 class="text-uppercase couleur-texte">%s</h2>
<H3 class="couleur-texte">
    %s	
</H3>
</div>
</div>
EOF;

        $imageHtml=<<<EOF
style="background-image: url('%s')">
	<div class="carousel-caption d-md-block">
		<h2 class="text-uppercase couleur-texte">%s</h2>
			<H3 class="couleur-texte">
                %s	
			</H3>
	</div>
</div>



EOF;

        if (in_array($this->mime_type, SELF::mime_videos_allowed, true)) {
            return sprintf($videoHtml, htmlspecialchars($this->chemin_relatif), htmlspecialchars($this->description), htmlspecialchars($this->auteur));
        }
        if (in_array($this->mime_type, SELF::mime_audios_allowed, true)) {
            return sprintf($audioHtml, htmlspecialchars($this->chemin_relatif), htmlspecialchars($this->description), htmlspecialchars($this->auteur));
        }
        if (in_array($this->mime_type, SELF::mime_images_allowed, true)) {
            return sprintf($imageHtml, htmlspecialchars($this->chemin_relatif), htmlspecialchars($this->description), htmlspecialchars($this->auteur));
        }
    }





    public function getJson()
    {
        return json_encode($this);
    }


    public function safeFile()
    {
        $risp=$this->ctrlFileUpload();
        if ($risp=='true') {
            $upload_info = $this->move_single_file();
            //salvo i parametri
            $this->chemin_relatif ='.'.$upload_info['sub_folder_to_move'].$upload_info['name'];
            $this->name_origin= $upload_info['name_origin'];
            $this->mime_type=$upload_info['extension'];
            //$this->description =$commentaire_file;
            //$this->auteur_id=$auteur;//IMPORTANT INTEGER
            //$this->id= $id;         //IMPORTANT INTEGER CLEF UPDATE
            //$this->date=date("Y-m-d H:i:s");                    //2014-04-17 13:55:12
            // $today = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (the MySQL DATETIME format)
            return 'true';
        } else {
            return $risp;
        }
    }


    public function ctrlFileUpload():string
    {
        $max_byte= 6000000;
        $folder_racine = SELF::getRacine();
        try {
            // se il form è stato inviato
            if (@isset($this->_FILES)) {
                // verifichiamo che l'utente abbia selezionato un file
                if (@trim($this->_FILES["name"]) == '') {
                    throw new Exception('La sélection n\'est pas un fichier!');
                }
          
                // verifichiamo che il file è stato caricato
                elseif (@!is_uploaded_file($this->_FILES["tmp_name"]) or $this->_FILES["error"]>0) {
                    throw new Exception('Un problème a été rencontré, le chargement n\'a pas été fait!');
                }
                // verifichiamo che la dimensione del file non eccede quella massima
                elseif (@$this->_FILES["size"] > $max_byte) {
                    throw new Exception('Taille de fichier maximal dépassée (4Mo). Le fichier n\'a pas été ajouté');
                }
              
                // verifichiamo che la cartella di destinazione settata esista
                elseif (@!is_dir($folder_racine.SELF::dir_videos) || @!is_dir($folder_racine.SELF::dir_audios)||@!is_dir($folder_racine.SELF::dir_images)) {
                    throw new Exception('Dossier inexistant : vous n\'avez pas les droits sur le dossier courant');
                }
              
                // verifichiamo che la cartella di destinazione abbia i permessi di scrittura
                elseif (@!is_writable($folder_racine.SELF::dir_videos)||@!is_writable($folder_racine.SELF::dir_audios)||@!is_writable($folder_racine.SELF::dir_images)) {
                    throw new Exception("Vous n'avez pas les droit suffisants pour écrire dans le dossier multimedia");
                }
                // altrimenti significa che è andato tutto ok
                else {
                    return 'true';
                }
            } else {
                return 'La sélection n\'est pas un fichier (array vide)';
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}