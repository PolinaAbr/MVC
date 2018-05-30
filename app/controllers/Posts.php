<?php

namespace app\controllers;
use polinaframework\base\Controller;

class Posts extends Controller {

    public function indexAction() {
        debug($this->route);
        echo "Posts::index";
    }

    public function addAction() {
        debug($this->route);
        echo "Posts::add";
    }
}