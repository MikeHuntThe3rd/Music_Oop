<?php

namespace Music\Controllers;
use Music\Controllers\controller;

class FrontPageController extends controller {
    public function display(){
        $this->rd->includeFile("FrontPage.php");
    }
}