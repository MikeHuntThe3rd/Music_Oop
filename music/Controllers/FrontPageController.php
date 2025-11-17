<?php

namespace Music\Controllers;
use Music\Controllers\controller;

class FrontPageController extends controller {
    public function displaythis(){
        $this->rd->includeFile("FrontPage");
    }
}