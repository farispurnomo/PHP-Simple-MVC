<?php

class M_User
{
    private $table = 'core_user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function paginate($offset = 0, $limit = 25, $search = '')
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE 1 ';
        if ($search != '') {
            $query .= ' AND user_id LIKE :search';
            $query .= ' OR user_name LIKE :search ';
        }
        $query .= ' ORDER BY user_name';
        $query .= ' LIMIT :offset, :limit ';

        $this->db->query($query);
        if ($search != '') {
            $this->db->bind('search', "%$search%");
        }
        $this->db->bind('limit', $limit);
        $this->db->bind('offset', $offset);
        $this->db->execute();

        $data = $this->db->resultSet();

        $totalData = count($this->getAll());
        $lastPage = ceil($totalData / $limit);

        $datarow = (object) array(
            'current_page' => '1',
            'last_page' => $lastPage,
            'total_data' => $totalData,
            'datas' => $data
        );

        return $datarow;
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id=:user_id');
        $this->db->bind('user_id', $id);

        return $this->db->single();
    }

    public function store($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' (user_id, user_name, password, user_avatar) VALUES (:user_id, :user_name, :password, :user_avatar)';

        $this->db->query($query);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('user_name', $data['user_name']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('user_avatar', $data['foto']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($id, $params = array())
    {
        $query = "UPDATE " . $this->table;
        $query .= " SET user_name=:user_name ";
        if ($params['password'] != '') {
            $query .= ", password=:password ";
        }
        if ($params['foto'] != '') {
            $query .= ", user_avatar=:user_avatar ";
        }
        $query .= " WHERE user_id=:user_id";

        $this->db->query($query);
        $this->db->bind('user_id', $id);
        $this->db->bind('user_name', $params['user_name']);
        if ($params['password'] != '') {
            $this->db->bind('password', md5($params['password']));
        }
        if ($params['foto'] != '') {
            $this->db->bind('user_avatar', $params['foto']);
        }
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE user_id=:user_id";
        $this->db->query($query);
        $this->db->bind('user_id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
