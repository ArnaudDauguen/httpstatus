<?php
namespace controllers\publics;

use \descartes\Router as Router;
use \controllers\internals\Incs as Incs;
use \controllers\internals\WebsiteStatus as WebStatus;
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
        $this->web_status = new WebStatus($pdo);
    }

    public function home(){
        $sites = $this->model_site->get('sites');
        foreach ($sites as $key => $site)
		{   
            $site['site_status'] = $this->model_history->get_last_status($site['id']);
            
            $sites[$key] = $site;
        }
        $functions = array(
            'see_history' =>'see_history_by_site_id',
            'add' => 'add_site',
            'edit' => 'edit_by_id',
            'delete' => 'delete_by_id',
        );
        
        return $this->render("index/home", array('sites' => $sites, 'controller' => 'WebUI', 'functions' => $functions));
    }

    public function see_history_by_site_id(int $site_id){

        $complete_history = $this->model_history->get_by_site_id($site_id, "update_time", true);

        return $this->render('index/history', array('site_id' => $site_id, 'complete_history' => $complete_history));
    }


    public function add(){
        
        if(!isset($_POST['url'])){
            return $this->render('index/add_site');
        }else{
            $url = htmlspecialchars($_POST['url']);

            //so, all is good
            $this->model_site->create($_SESSION['user_id'], $url);
            $site_id = $this->model_site->get_one_by_url($url)['id'];

            //recup du status
            $site_status = $this->web_status->get_website_status($url);
            $this->model_history->create($site_id, $site_status);

            header('location:' . $_SESSION['come_from']);

        }
    }

    public function edit_by_id(int $site_id){
        
        if(!isset($_POST['url'])){
            $actual_url = $this->model_site->get_one_by_id($site_id)['url'];
            return $this->render('index/edit_site', array('actual_url' => $actual_url));
        }else{
            $url = htmlspecialchars($_POST['url']);

            //so, all is good
            $this->model_site->modify($site_id, $url);

            //recup du status
            $site_status = $this->web_status->get_website_status($url);
            $this->model_history->create($site_id, $site_status);

            header('location:' . $_SESSION['come_from']);

        }

    }

    public function delete_by_id(int $site_id){
        $this->model_site->remove($site_id);
        $this->model_history->remove_site_history($site_id);
        header('location:' . $_SESSION['come_from']);

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
            $_SESSION['user_id'] = $requested_user['id'];
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