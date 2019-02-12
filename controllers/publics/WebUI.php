<?php
namespace controllers\publics;

class WebUI extends \Controller{

    public function __construct (\PDO $pdo){
        parent::__construct($pdo);
    }

    public function home(){
        return $this->render("index/home");
    }

    public function show_value(){
        return $this->render("index/show-value");
    }

}