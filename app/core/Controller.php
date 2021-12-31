<?php

class Controller
{
    public function view($view, $data = array(), $return = FALSE)
    {
        require_once "../app/views/$view.php";

        // return file data jika diminta
        if ($return === TRUE) {
            $buffer = ob_get_contents();
            @ob_end_clean();
            return $buffer;
        }
    }

    public function model($model)
    {
        require_once "../app/models/$model.php";
        return new $model;
    }
}
