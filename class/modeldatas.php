<?php
class ModelDatas extends Model {
 
    CONST tableData = 'datas';
    protected static $_instance = null;
 
  private function __construct() {
    $this->openBd();
  }

  //Base de données en SINGLETON
  public static function getInstance() {
    if (is_null(self::$_instance)){
      self::$_instance = new self();
    }
    return self::$_instance;
  }
  
  public function readData() {

   // SELECT * FROM datas ORDER BY date DESC LIMIT 3
    $res = $this->_db->query("SELECT * FROM ".SELF::tableData." ORDER BY date DESC LIMIT 16");
  // les exceptions n'étant pas activées il faut tester la valeur de retour
  $json = [];
  if ($res != false) {
        $rows = $res->fetchAll();
        foreach ($rows as $objet)
        {
          $json[] = new Multimedia($objet['id_datas'], $objet['chemin_relatif'], $objet['name_origin'], $objet['mime_type'], $objet['description'], $objet['auteur_id'],$objet['date']);
        }
        return $json;
    }
    return $json;
  }


  public function addData(string $json) {
    //decode json vers obj
    $obj=json_decode($json);
    //['id_datas', 'chemin_relatif', 'mime_type', 'description' ,'auteur_id', 'date']
    $stmt = $this->_db->prepare("INSERT INTO datas (chemin_relatif,  name_origin , mime_type, description, auteur_id, date ) VALUES (:chemin_relatif,:name_origin, :mime_type, :description, :auteur_id, :date )");

    $stmt->bindParam(':chemin_relatif', $chemin_relatif);
    $stmt->bindParam(':mime_type', $mime_type);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':auteur_id', $auteur_id);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':name_origin', $name_origin);
    // insertion d'une ligne
    $chemin_relatif = $obj->chemin_relatif;
    $mime_type = $obj->mime_type;
    $description = $obj->description;
    $auteur_id = $obj->auteur_id;
    $date =  $obj->date;
    $name_origin =  $obj->name_origin;
    $stmt->execute();
   }
  
  
   public function updateData(string $json) {
        $obj=json_decode($json);
        //['id_datas', 'chemin_relatif', 'mime_type', 'description' ,'auteur_id', 'date']
        $stmt = $this->_db->prepare("UPDATE datas SET chemin_relatif = ?, name_origin = ?, mime_type = ?, description = ?, auteur_id = ?, date = ? WHERE id_datas = ?");
        $stmt->execute([$obj->chemin_relatif, $obj->name_origin,$obj->mime_type, $obj->description, $obj->auteur_id, $obj->date, $obj->id]);
   }
  

   public function dropData(int $id ) {
        $stmt = $this->_db->prepare("DELETE FROM datas WHERE id_datas = ?");
        $stmt->execute([$id]);
   }

   public function dropTable() {
       $stmt = $this->_db->prepare("DELETE FROM datas");
       $stmt->execute();
   }

  public function searchDatas_OLD(string $champ, string $valeur):array
  {
    $json = [];
    if (!empty($champ) && !empty($valeur))
    {
      if ( $valeur !== 'all')
      {
        switch ($valeur)
        {
          case 'video' :
              $tableau = Multimedia::mime_videos_allowed;
              break;
          case 'audio' :
              $tableau = Multimedia::mime_audios_allowed;
              break;
          case 'image' :
              $tableau = Multimedia::mime_images_allowed;
              break;
        }

        foreach($tableau as &$val)     
        $val=$this->_db->quote($val); 
        $string = implode(',',$tableau);
 
        $preparedQuery = $this->_db->prepare("SELECT * FROM ".SELF::tableData." WHERE description LIKE ? AND mime_type IN (".$string.")");

        // var_dump($test);
        $query_parameters = ['%'.$champ.'%'];
        $preparedQuery->execute($query_parameters);
      } else
      {
        
        // echo "coucou la<br/>";
        $preparedQuery = $this->_db->prepare("SELECT * FROM ".SELF::tableData." WHERE description LIKE ?");
        $query_parameters = ['%'.$champ.'%'];
        $preparedQuery->execute($query_parameters);
      }
      $response_query = $preparedQuery->fetchAll();
      // var_dump($response_query);

      
      
      foreach ($response_query as $objet)
      {
        $json[] = new Multimedia($objet['id_datas'], $objet['chemin_relatif'], $objet['name_origin'], $objet['mime_type'], $objet['description'], $objet['auteur_id'],$objet['date']);
      }
      return $json;
    }
    return $json;
  }







public function searchDatas (string $champ, string $valeur):array
{
  $json = [];
  if (empty($champ) && empty($valeur)){return $json;   }

  if (!empty($champ) && ($valeur=='all')){
    $preparedQuery = $this->_db->prepare("SELECT * FROM ".SELF::tableData." WHERE description LIKE ?");
    $query_parameters = ['%'.$champ.'%'];
    $preparedQuery->execute($query_parameters);
    $response_query = $preparedQuery->fetchAll();
    foreach ($response_query as $objet)
    {
      $json[] = new Multimedia($objet['id_datas'], $objet['chemin_relatif'], $objet['name_origin'], $objet['mime_type'], $objet['description'], $objet['auteur_id'],$objet['date']);
    }
    return $json;
  }

      switch ($valeur)
      {
        case 'video' :
            $tableau = Multimedia::mime_videos_allowed;
            break;
        case 'audio' :
            $tableau = Multimedia::mime_audios_allowed;
            break;
        case 'image' :
            $tableau = Multimedia::mime_images_allowed;
            break;
        
      }
      if (isset($tableau)){
        foreach($tableau as &$val) { //bind parametre!
          $val=$this->_db->quote($val);
        }    
         
        $string = implode(',',$tableau);
      }
     

      if(($champ)!='' && ($valeur)!='all'){  //se il campo della ricerca non è immesso
        $preparedQuery = $this->_db->prepare("SELECT * FROM ".SELF::tableData." WHERE description LIKE ? AND mime_type IN (".$string.")");
        $query_parameters = ['%'.$champ.'%'];
        $preparedQuery->execute($query_parameters);

      }elseif(($champ=='') && ($valeur=='all')){   //tutti gli elementi
        $preparedQuery = $this->_db->prepare("SELECT * FROM ".SELF::tableData);
        $preparedQuery->execute();

      }elseif(($champ=='') && ($valeur!='all')){
        $preparedQuery = $this->_db->prepare("SELECT * FROM ".SELF::tableData." WHERE mime_type IN (".$string.")");
        $preparedQuery->execute();

      }else{
        return json;
      }

      $response_query = $preparedQuery->fetchAll();
      foreach ($response_query as $objet)
      {
        $json[] = new Multimedia($objet['id_datas'], $objet['chemin_relatif'], $objet['name_origin'], $objet['mime_type'], $objet['description'], $objet['auteur_id'],$objet['date']);
      }
      return $json;

}
}