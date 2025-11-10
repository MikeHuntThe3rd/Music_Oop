<?php

namespace Music\Controllers;
use Music\Models\model;
use Music\Views\Render;

class controller {
    public model $md;
    public Render $rd;
    public function __construct(){
        $this->md = new model();
        $this->rd = new Render();
    }
}