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
			return $this->json(array('success' => false, 'error' => 'api key required'));
		}

		return $this->json(array('version' => 1, 'list' => HTTP_PWD . '/api/list'));
	}

	public function get_list (string $api_key = '')
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false, 'error' => 'api key required'));
		}

		$sites = $this->model_site->get('sites');


		foreach ($sites as $key => $site)
		{
			$site['delete'] = HTTP_PWD . '/api/delete/' . $site['id'];
			$site['status'] = HTTP_PWD . '/api/status/' . $site['id'];
			$site['history'] = HTTP_PWD . '/api/history/' . $site['id'];

			$sites[$key] = $site;
			unset($sites[$key]['user_id']);
			unset($sites[$key]['last_mail']);
		}

		$this->json(array('version' => 1, 'websites' => $sites));
	}

	public function post_add (string $api_key = '')
	{
		$api_key = $this->get_api_key($api_key);

		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false, 'error' => 'api key required'));
		}

		$user = $this->model_user->get_one_by_api_key($api_key);
		$site = $this->model_site->create($user['id'], htmlspecialchars($_POST['url']));

		if (!$site)
		{
			return $this->json(array('success' => false, 'error' => 'error during process'));
		}

		$id = $this->model_site->last_id();

		if ($id === null || empty($id))
		{
			return $this->json(array('success' => false, 'error' => 'site id not found'));
		}

		return $this->json(array('success' => true, 'id' => $id));
	}

	public function delete_delete (int $id, string $api_key = '')
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false, 'error' => 'api key required'));
		}

		$site = $this->model_site->remove($id);
		$history = $this->model_history->remove_site_history($id);

		if (!$site || !$history)
		{
			return $this->json(array('success' => false, 'error' => 'site id or history not found'));
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
			return $this->json(array('success' => false, 'error' => 'api key required'));
		}

		$site = $this->model_site->get_one_by_id($site_id);

		if(!$site)
		{
			return $this->json(array('success' => false, 'error' => 'site id not found'));
		}

		$url = $site['url'];

		$site = $this->model_history->get_last_status($site_id);

		if (!$site)
		{
			return $this->json(array('success' => false, 'error' => 'history for site id not found'));
		}

		$status = array('code' => (int) $site['status'], 'at' => $site['update_time']);

		return $this->json(array('id' => $site_id, 'url' => $url, 'status' => $status));
	}

	public function get_history (int $site_id, string $api_key = '')
	{
		if (!$this->check_api_key($api_key))
		{
			return $this->json(array('success' => false, 'error' => 'api key required'));
		}

		$history = $this->model_history->get_website_history_by_id($site_id);

		if (!$history)
		{
			return $this->json(array('success' => false, 'error' => 'history not found'));
		}

		foreach ($history as $key => $update)
		{
			$update_v2 = array('code' => $update['status'], 'at' => $update['update_time']);
			$history[$key] = $update_v2;
		}

		$site = $this->model_site->get_one_by_id($site_id);

		if(!$site)
		{
			return $this->json(array('success' => false, 'error' => 'site id not found'));
		}

		$url = $site['url'];

		return $this->json(array('id' => $site_id, 'url' => $url, 'status' => $history));
	}
}