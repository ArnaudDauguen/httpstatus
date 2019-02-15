<?php
namespace controllers\internals;

use \models\Sites as ModelSite;
use \models\History as ModelHistory;

class WebsiteStatus extends \InternalController
{
    public function __construct (?\PDO $pdo = null)
    {
		$this->model_site = new ModelSite($pdo);
		$this->model_history = new ModelHistory($pdo);

        parent::__construct($pdo);
    }

    public function get_website_status (string $url) : int
    {
        $timeout = 10;
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($curl);
        $response = trim(strip_tags($response));
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return $status;
    }

    public function check_status (int $status) : bool
    {
        return $status < 400;
    }

    public function send_mail (int $site_id) : bool
    {
        return false;
    }

    public function init ()
    {
        $sites = $this->model_site->get('sites');

        foreach ($sites as $site)
        {
            $status = $this->get_website_status($site['url']) ?? 999;

            $this->model_history->create($site['id'], $status);

            // Récupération des 3 derniers status
            $history = $this->model_history->get('history', ['site_id' => $site['id']], 'update_time', true, 3);
            $website_errors = [];

            foreach ($history as $status)
            {
                array_push($website_errors, $this->check_status((int) $status['status']));
            }

            // Envoie du mail si le dernier est vieux de 2h ou plus
            $two_hours_before = new \DateTime('now');
            $two_hours_before = $two_hours_before->sub(new \DateInterval('PT2H'));

            if (!in_array(true, $website_errors) && $two_hours_before >= new \DateTime($site['last_mail']))
            {
                $mail = $this->send_mail($site['id']);

                if ($mail)
                {
                    $this->model_site->update('sites', ['last_mail' => $now->getTimestamp()], ['id' => $site['id']]);
                }
            }
        }
    }
}