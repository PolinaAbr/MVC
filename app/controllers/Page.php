<?php

namespace app\controllers;
use polinaframework\base\Controller;

class Page extends Controller {
    public function viewAction() {
        debug($this->route);
        echo "Page::view";
    }
}