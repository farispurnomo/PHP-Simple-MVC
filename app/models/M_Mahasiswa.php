<?php

class M_Mahasiswa
{
    private $table = 'mst_mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function paginate($offset = 0, $limit = 25, $search = '')
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE 1 ';
        if ($search != '') {
            $query .= ' AND nim LIKE :search';
            $query .= ' OR nama LIKE :search ';
        }
        $query .= ' ORDER BY nama ';
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
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nim=:nim');
        $this->db->bind('nim', $id);

        return $this->db->single();
    }

    public function store($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' (nim, nama, foto) VALUES (:nim, :nama, :foto)';

        $this->db->query($query);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('foto', $data['foto']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($id, $params = array())
    {
        $query = "UPDATE " . $this->table;
        $query .= " SET nama=:nama ";
        if ($params['foto'] != '') {
            $query .= ", foto=:foto ";
        }
        $query .= " WHERE nim=:nim";

        $this->db->query($query);
        $this->db->bind('nim', $id);
        $this->db->bind('nama', $params['nama']);
        if ($params['foto'] != '') {
            $this->db->bind('foto', $params['foto']);
        }
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE nim=:nim";
        $this->db->query($query);
        $this->db->bind('nim', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
