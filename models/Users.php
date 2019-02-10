<?php
namespace models;

class Users extends \Model
{
    public function get_one_by_id (int $id)
    {   
        return $this->get_one('users', ['id' => $id]);
    } 
    
    public function get_one_by_email (string $email)
    {
        return $this->get_one('users', ['email' => $email]);
    }

    public function get_one_by_api_key (string $api_key)
    {
        return $this->get_one('users', ['api_key' => $api_key]);
    }

    public function create (string $email, string $password, string $api_key)
    {   
        return $this->insert('users', [
            'email' => $email,
            'password' => $password,
            'api_key' => $api_key,
        ]);
    }

    public function modify (int $id, string $email, string $password, string $api_key)
    {   
        return $this->update(
            'users',
            [
                'email' => $email,
                'password' => $password,
                'api_key' => $api_key,
            ],
            [
                'id' => $id,
            ]
        );
    }

    public function remove (int $id)
    {
        return $this->delete('users', ['id' => $id]);
    }
}