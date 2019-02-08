<?php
namespace models;

class Sites extends \Model
{
    public function get_one_by_id (int $id)
    {   
        return $this->get_one('sites', ['id' => $id]);
    }

    public function get_one_by_url (string $url)
    {   
        return $this->get_one('sites', ['url' => $url]);
    }

    public function create (string $url)
    {   
        return $this->insert('sites', [
            'url' => $url,
        ]);
    }

    public function modify (int $id, string $url)
    {   
        return $this->update(
            'sites',
            [
                'url' => $url,
            ],
            [
                'id' => $id,
            ]
        );
    }

    public function remove (int $id)
    {
        return $this->delete('sites', ['id' => $id]);
    }
}