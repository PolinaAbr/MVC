<?php

namespace app\controllers;
use polinaframework\base\Controller;

class Main extends Controller {
    public function indexAction() {
        debug($this->route);
        echo "Main::index";
    }
}