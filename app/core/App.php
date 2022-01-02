<?php

// coba2 MVC Native :v
class App
{
    // atur default controller
    protected $controller = 'Login';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        try {
            // echo '<pre>';print_R($_SERVER);exit;
            if (isset($_SERVER['PATH_INFO'])) {
                $path = trim(@$_SERVER['PATH_INFO'], '/');
                $path = explode('/', $path);
                // echo '<pre>';print_r($path);exit;

                // cek controller nya
                if (isset($path[0])) {
                    $path[0] = ucfirst($path[0]);
                    if (file_exists('../app/controllers/' . $path[0] . '.php')) {
                        $this->controller = $path[0];
                        unset($path[0]);
                    } else {
                        throw new Exception('Controller Tidak ditemukan.');
                    }
                }

                // buat instance classnya
                require_once '../app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;

                // cek method nya
                if (isset($path[1])) {
                    if (method_exists($this->controller, $path[1])) {
                        $this->method = $path[1];
                        unset($path[1]);
                    } else {
                        throw new Exception('Method tidak ada.');
                    }
                }

                if (!empty($path)) {
                    $this->params = array_values($path);
                }
            } else {
                // buat instance classnya
                require_once '../app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
            }
        } catch (Exception $e) {
            $this->controller = 'Errors';
            $this->method = 'index';
            $this->params = [
                array(
                    'file' => $e->getFile(),
                    'msg' => $e->getMessage(),
                    'line' => $e->getLine(),
                )
            ];

            // buat instance classnya
            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;
        }
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}
