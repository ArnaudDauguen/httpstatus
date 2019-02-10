<?php
namespace controllers\publics;

use \models\Users as ModelUser;
use \models\Sites as ModelSite;

class Api extends \ApiController
{
	public function __construct (\PDO $pdo)
	{
		$this->model_user = new ModelUser($pdo);
		$this->model_site = new ModelSite($pdo);

		parent::__construct($pdo);
	}

	protected function get_api_key (?string $api_key) 
	{
		if ($api_key === null || empty($api_key))
		{
			if (!isset($_GET['api_key']) || empty($_GET['api_key'])) return null;

			$api_key = $_GET['api_key'];
		}

		return $api_key;
	}

	protected function check_api_key (?string $api_key)
	{
		$api_key = $this->get_api_key($api_key);

		if ($api_key === null)
		{
			return false;
		}

		$user = $this->model_user->get_one_by_api_key($this->get_api_key($api_key));

		if (!isset($user['id']) || empty($user['id']))
		{
			return false;
		}

		return true;
	}

	public function get_home (?string $api_key = null)
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false));
		}

		return $this->json(array('version' => 1, 'list' => HTTP_PWD . '/api/list'));
	}

	public function get_list (?string $api_key = null)
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false));
		}

		$sites = $this->model_site->get('sites');

		foreach ($sites as $key => $site)
		{
			$site['delete'] = HTTP_PWD . '/api/delete/' . $site['id'];
			$site['status'] = HTTP_PWD . '/api/status/' . $site['id'];
			$site['history'] = HTTP_PWD . '/api/history/' . $site['id'];

			$sites[$key] = $site;
		}

		$this->json(array('version' => 1, 'websites' => $sites));
	}
}