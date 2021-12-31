<?php

class Errors extends Controller{
    public function index($params){
        $data['error'] = $params;
        $data['content'] = $this->view('error/index', $data, TRUE);
        $this->view('template', $data);
    }
}