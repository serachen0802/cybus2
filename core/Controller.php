<?php

class Controller {
    public function model($model) {
        require_once "../cybusEasy/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array()) {
        require_once "../cybusEasy/views/$view.php";
    }
}

?>