<?php

class User extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = $this->model('M_User');

        // usir jika belum login
        $this->checkLogin();
    }

    public function index()
    {
        $data['content'] = $this->view('user/index', [], TRUE);
        $this->view('template', $data);
    }

    public function create()
    {
        $data['content'] = $this->view('user/form_create', [], TRUE);
        $this->view('template', $data);
    }

    public function store()
    {
        $post = $_POST;
        $cek = $this->user->getById($post['id']);

        try {
            if (!$cek) {
                $filename = '';
                if ($_FILES['foto']['name'] != '') {

                    $filename = $this->uploadFiles($post['id']);
                }

                $params = [
                    'user_id' => $post['id'],
                    'user_name' => $post['nama'],
                    'password' => $post['password'],
                    'foto' => $filename
                ];

                $this->user->store($params);
                FlashData::setMessage('msg', 'Berhasil Menambah Data', 'success');
                header('Location:' . BASE_URL . 'user');
            } else {
                throw new Exception('Data Sudah Ada');
            }
        } catch (Exception $e) {
            FlashData::setMessage('id', $post['id']);
            FlashData::setMessage('nama', $post['nama']);
            FlashData::setMessage('msg', $e->getMessage(), 'danger');
            header('Location:' . BASE_URL . 'user/create');
        }
    }

    public function show()
    {
        $post = $_POST;

        $curpage = $post['page'] ?: 1;

        $limit = 15;
        $offset = $limit * ($curpage - 1);

        $data = $this->user->paginate($offset, $limit, @$post['search']);
        $data->paging_html = Pagination::render($data->last_page, $curpage);

        echo $this->view('user/table', $data);
    }

    public function edit($id)
    {
        $data = $this->user->getById($id);
        if (!$data) {
            header('Location:' . BASE_URL . 'user');
        }
        $data['content'] = $this->view('user/form_edit', $data, TRUE);
        $this->view('template', $data);
    }

    public function update($id)
    {
        $post = $_POST;

        $filename = '';
        if ($_FILES['foto']['name'] != '') {
            $filename = $this->uploadFiles($id);
        }

        $params = [
            'user_name' => $post['nama'],
            'password' => $post['password'],
            'foto' => $filename
        ];

        $this->user->update($id, $params);

        FlashData::setMessage('msg', 'Berhasil Mengubah Data', 'success');
        header('Location:' . BASE_URL . 'user');
    }

    public function destroy($id)
    {
        $rows = $this->user->delete($id);
        if ($rows > 0) {
            FlashData::setMessage('msg', 'Berhasil Menghapus Data', 'success');
        } else {
            FlashData::setMessage('msg', 'Gagal Menghapus Data', 'danger');
        }
        header('Location:' . BASE_URL . 'user');
    }

    private function uploadFiles($name)
    {
        $allowed = array('svg', 'png', 'jpeg', 'jpg');
        $filename = $_FILES['foto']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            throw new Exception('Hanya mendukung file dengan ekstensi .svg, .png, .jpeg, jpg');
        }

        $target_dir = 'uploads/user/';
        $target_file = "{$target_dir}{$name}.$ext";
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
        return $target_file;
    }
}
