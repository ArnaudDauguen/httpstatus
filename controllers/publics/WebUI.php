<?php
namespace controllers\publics;

use \descartes\Router as Router;
use \controllers\internals\Incs as Incs;
use \models\Sites as ModelSite;
use \models\History as ModelHistory;
use \models\Users as ModelUser;

class WebUI extends \Controller{

    public function __construct (\PDO $pdo){
        parent::__construct($pdo);
        $this->model_site = new ModelSite($pdo);
        $this->model_history = new ModelHistory($pdo);
        $this->model_user = new ModelUser($pdo);
        $this->incs = new Incs();
    }

    public function home(){
        $sites = $this->model_site->get('sites');
        foreach ($sites as $key => $site)
		{   
            $site['site_status'] = $this->model_history->get_last_status($site['id']);
            
            $sites[$key] = $site;
        }
        
        return $this->render("index/home", array('sites' => $sites, 'controller' => 'WebUI', 'function' => 'see_history_by_site_id'));
    }

    public function see_history_by_site_id(int $site_id){
        echo "display site hisotry of site: " . $site_id;
    }


    public function login(){
        if(!isset($_POST['email']) or !isset($_POST['password'])){
            return $this->render('index/login');
        }else{
            $password = $_POST['password'];
            $email = $_POST['email'];

            $requested_user = $this->model_user->get_one_by_email($email);
            
            if(sizeof($requested_user) <= 0){
                echo "Unknown user";
                exit();
            }

            if(!password_verify($password, $requested_user['password'])){
                echo "Wrong password!";
                exit();
            }

            //so, all is good
            $_SESSION['api_key'] = $requested_user['api_key'];
            $_SESSION['logged'] = true;
            header('location:' . $_SESSION['come_from']);

        }
    }

    public function logout(){
        $_SESSION['api_key'] = null;
        $_SESSION['logged'] = false;
        header('location:' . $_SESSION['come_from']);
    }

}