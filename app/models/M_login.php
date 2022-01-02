<?php

class M_login
{
    private $table = 'core_user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function checkLogin($userid, $password)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id=:user_id AND password=:password');
        $this->db->bind('user_id', $userid);
        $this->db->bind('password', md5($password));

        return $this->db->single();
    }
}
