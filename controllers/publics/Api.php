<?php
namespace controllers\publics;

use \models\Users as ModelUser;
use \models\Sites as ModelSite;
use \models\History as ModelHistory;

class Api extends \ApiController
{
	public function __construct (\PDO $pdo)
	{
		$this->model_user = new ModelUser($pdo);
		$this->model_site = new ModelSite($pdo);
		$this->model_history = new ModelHistory($pdo);

		parent::__construct($pdo);
	}

	protected function get_api_key (string $api_key) 
	{
		if (empty($api_key))
		{
			if (!isset($_GET['api_key']) || empty($_GET['api_key'])) return null;

			$api_key = $_GET['api_key'];
		}

		return htmlspecialchars($api_key);
	}

	protected function check_api_key (string $api_key)
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

	public function get_home (string $api_key = '')
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false));
		}

		return $this->json(array('version' => 1, 'list' => HTTP_PWD . '/api/list'));
	}

	public function get_list (string $api_key = '')
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

	public function post_add (string $api_key = '')
	{
		$api_key = $this->get_api_key($api_key);

		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false));
		}

		$user = $this->model_user->get_one_by_api_key($api_key);
		$site = $this->model_site->create($user['id'], htmlspecialchars($_POST['url']));

		if (!$site)
		{
			return $this->json(array('success' => false));
		}

		$id = $this->model_site->last_id();

		if ($id === null || empty($id))
		{
			return $this->json(array('success' => false));
		}

		return $this->json(array('success' => true, 'id' => $id));
	}

	public function delete_delete (int $id, string $api_key = '')
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false));
		}

		$site = $this->model_site->remove($id);

		if (!$site)
		{
			return $this->json(array('success' => false));
		}

		return $this->json(array('success' => true));
	}

	public function get_delete (int $id, string $api_key = '')
	{
		return $this->delete_delete($id, $api_key);
	}

	public function get_status (int $site_id, string $api_key = '')
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false));
		}

		$site = $this->model_history->get_last_status($site_id);

		if (!$site)
		{
			return $this->json(array('success' => false));
		}

		$status = (int) $site['status'];

		return $this->json(array('success' => true, 'status' => $status));
	}

	public function get_history (int $site_id, string $api_key = '')
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false));
		}

		$history = $this->model_history->get_website_history_by_id($site_id);

		if (!$history)
		{
			return $this->json(array('success' => false));
		}

		foreach ($history as $update)
		{
			
		}

		return $this->json(array('success' => true, 'history' => $history));
	}
}