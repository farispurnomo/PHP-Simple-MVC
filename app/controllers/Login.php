<?php

class Login extends Controller
{
    private $login;
    public function __construct()
    {
        $this->login = $this->model('M_Login');
    }

    public function index()
    {
        $this->view('login');
    }

    public function login()
    {
        $post = $_POST;

        if (isset($post['userid']) && isset($post['password'])) {
            $cek = $this->login->checkLogin($post['userid'], $post['password']);
            if ($cek) {

                // set session
                $_SESSION['user_id'] = $cek['user_id'];
                $_SESSION['user_name'] = $cek['user_name'];
                $_SESSION['user_avatar'] = $cek['user_avatar'];

                header('Location:' . BASE_URL . 'mahasiswa');
            } else {
                FlashData::setMessage('msg', 'ID Pengguna atau Kata Sandi salah', 'danger');
                header('Location:' . BASE_URL . 'login');
            }
        } else {
            header('Location:' . BASE_URL . 'login');
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_avatar']);

        header('Location:' . BASE_URL . 'login');
    }
}
