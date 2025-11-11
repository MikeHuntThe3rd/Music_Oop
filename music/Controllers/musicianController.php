<?php


namespace Music\Controllers;
use Music\Controllers\controller;

class musicianController extends controller {
    public function display(){
        $creators = $this->md->selectTable("musicians");
        $this->rd->includeFile("creators/musician.php", ["creators" => $creators]);
    }
    public function add_Display(){
        $this->rd->includeFile("creators/add.php");
    }
    public function edit_Display($id){
        $creator = $this->md->selectTable("musicians", $id);
        $this->rd->includeFile("creators/edit.php", ["creator" => $creator]);
    }
    public function add_Save($data){
        var_dump($this->md->getTableCols("musicians"));
        var_dump($data);
        $this->md->insertRow("musicians", $data);
        //header("Location: musicians");
    }
}