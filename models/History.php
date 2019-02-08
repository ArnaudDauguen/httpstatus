<?php
namespace models;

class History extends \Model
{
    public function get_one_by_id (int $id)
    {   
        return $this->get_one('history', ['id' => $id]);
    } 
    
    public function get_by_site_id (int $site_id)
    {
        return $this->get('history', ['site_id' => $site_id]);
    }

    public function create (string $email, int $site_id, string $update_time, string $status)
    {   
        return $this->insert('history', [
            'site_id' => $site_id,
            'update_time' => $update_time,
            'status' => $status,
        ]);
    }

    public function modify (int $id, int $site_id, string $update_time, string $status)
    {   
        return $this->update(
            'history',
            [
                'site_id' => $site_id,
                'update_time' => $update_time,
                'status' => $status,
            ],
            [
                'id' => $id,
            ]
        );
    }

    public function remove (int $id)
    {
        return $this->delete('history', ['id' => $id]);
    }
}