<?php

class Utilisateur{
    private $id=1;
    private $nom='';
    private $passwd='';
    private $hash=false;
    public function __construct($nom, $passwd, $id=0,$hash=false){
        $this->id=$id;
        $this->nom=$nom;
        $this->passwd=$passwd;
        $this->hash=$hash;
    }
    public function getJson(){
        return encode_json($this);
    }
    public function serialize() {
        return serialize($this);
    }
    public function unserialize() {
        return unserialize($this);
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPassword(){
        return $this->passwd;
    }
    public function getId(){
        return $this->id;
    }
    public function hashPassword(){
        if(!$this->hash){
            $this->passwd=password_hash($this->passwd, PASSWORD_DEFAULT);
            $this->hash=true;
        }
        
    }

}