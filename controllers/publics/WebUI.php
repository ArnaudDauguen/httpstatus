<?php
namespace controllers\publics;

use \descartes\Router as Router;
use \controllers\internals\Incs as Incs;
//use \controllers\publics\Api as Api;
use \models\Sites as ModelSite;
use \models\History as ModelHistory;

class WebUI extends \Controller{

    public function __construct (\PDO $pdo){
        parent::__construct($pdo);
        //$this->api = new Api($pdo);
        $this->model_site = new ModelSite($pdo);
        $this->model_history = new ModelHistory($pdo);
        $this->incs = new Incs();
    }

    public function home(){
        $sites = $this->model_site->get('sites');
        foreach ($sites as $key => $site)
		{   
            $site['site_status'] = $this->model_history->get_last_status($site['id']);
            $site['history_link'] = HTTP_PWD . '/history/' . $site['id'];
            //$site['history_link'] = Router::url('WebUI', 'see_history_by_site_id');

            $sites[$key] = $site;
        }
        
        return $this->render("index/home", array('sites' => $sites));
    }

    public function see_history_by_site_id(int $site_id){
        echo "display site hisotry of site: " . $site_id;
    }

}