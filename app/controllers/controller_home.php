<?php

// resource.com/catalog/getAll?apiKey=13mro977yok5kcn25zr546a89h9c71u9

class Controller_Home extends Controller {

    function __construct() {
        $this->model = new Model_Home;
        parent::__construct();
    }

    function action_index() {
        $data = $this->model->getData();
        $this->view->generate(
            "home_view.php",
            "template_view.php",
            $data
        );
    }

    function action_edit() {
        $data = $this->model->getData();
        $this->view->generate(
            "home_view.php",
            "template_view.php",
            $data
        );
    }

    function getAllApi(){
        $sql = "SELECT * FROM apikeys";
        return $this->model->getAll($sql);
    }
}