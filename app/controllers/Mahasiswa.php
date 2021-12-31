<?php

class Mahasiswa extends Controller
{
    private $mahasiswa;
    public function __construct()
    {
        $this->mahasiswa = $this->model('M_Mahasiswa');
    }

    public function index()
    {
        $data['content'] = $this->view('mahasiswa/index', [], TRUE);
        $this->view('template', $data);
    }

    public function create()
    {
        $data['content'] = $this->view('mahasiswa/form_create', [], TRUE);
        $this->view('template', $data);
    }

    public function store()
    {
        $post = $_POST;
        $cek = $this->mahasiswa->getById($post['nim']);

        try {
            if (!$cek) {
                $filename = '';
                if ($_FILES['foto']['name'] != '') {

                    $filename = $this->uploadFiles($post['nim']);
                }

                $params = [
                    'nim' => $post['nim'],
                    'nama' => $post['nama'],
                    'foto' => $filename
                ];

                $this->mahasiswa->store($params);
                FlashData::setMessage('msg', 'Berhasil Menambah Data', 'success');
                header('Location:' . BASE_URL . 'mahasiswa');
            } else {
                throw new Exception('Data Sudah Ada');
            }
        } catch (Exception $e) {
            FlashData::setMessage('nim', $post['nim']);
            FlashData::setMessage('nama', $post['nama']);
            FlashData::setMessage('msg', $e->getMessage(), 'danger');
            header('Location:' . BASE_URL . 'mahasiswa/create');
        }
    }

    public function show()
    {
        $post = $_POST;

        $curpage = $post['page'] ?: 1;

        $limit = 15;
        $offset = $limit * ($curpage - 1);

        $data = $this->mahasiswa->paginate($offset, $limit, @$post['search']);
        $data->paging_html = Pagination::render($data->last_page, $curpage);

        echo $this->view('mahasiswa/table', $data);
    }

    public function edit($id)
    {
        $data = $this->mahasiswa->getById($id);
        if (!$data) {
            header('Location:' . BASE_URL . 'mahasiswa');
        }
        $data['content'] = $this->view('mahasiswa/form_edit', $data, TRUE);
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
            'nama' => $post['nama'],
            'foto' => $filename
        ];

        $this->mahasiswa->update($id, $params);

        FlashData::setMessage('msg', 'Berhasil Mengubah Data', 'success');
        header('Location:' . BASE_URL . 'mahasiswa');
    }

    public function destroy($id)
    {
        $rows = $this->mahasiswa->delete($id);
        if ($rows > 0) {
            FlashData::setMessage('msg', 'Berhasil Menghapus Data', 'success');
        } else {
            FlashData::setMessage('msg', 'Gagal Menghapus Data', 'danger');
        }
        header('Location:' . BASE_URL . 'mahasiswa');
    }

    private function uploadFiles($name)
    {
        $allowed = array('svg', 'png', 'jpeg', 'jpg');
        $filename = $_FILES['foto']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            throw new Exception('Hanya mendukung file dengan ekstensi .svg, .png, .jpeg, jpg');
        }

        $target_dir = 'uploads/mahasiswa/';
        $target_file = "{$target_dir}{$name}.$ext";
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
        return $target_file;
    }
}
