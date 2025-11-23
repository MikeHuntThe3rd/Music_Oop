<?php

namespace Music\Controllers;
use Music\Controllers\controller;

class TrackController extends controller{
    protected const CLASS_VARIABLES = [
        "table" => "music",
        "dir" => "tracks"
    ];

    public function display(){
        $table = $this->md->selectTable(static::CLASS_VARIABLES["table"]);
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR . static::CLASS_VARIABLES["table"], [static::CLASS_VARIABLES["dir"] => $table]);
    }
    public function add_Display(){
        $creators = $this->md->selectTable("creators");
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR ."add", ["creators" => $creators]);
    }
    public function edit_Display($id){
        $creators = $this->md->selectTable("creators");
        $row = $this->md->selectTable(static::CLASS_VARIABLES["table"], $id);
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR . "edit", ["creators" => $creators, "row" => $row[0], "id" => $id]);
    }
    public function add_Save($data){
        $this->md->insertRow(static::CLASS_VARIABLES["table"], $data);
        header("Location: ". static::CLASS_VARIABLES["table"]);
    }
    public function edit_Save($data, $id){
        $this->md->updateRow(static::CLASS_VARIABLES["table"], $data, $id);
        header("Location: ". static::CLASS_VARIABLES["table"]);
    }
    public function delete($id){
        $this->md->deleteRow(static::CLASS_VARIABLES["table"], $id);
        header("Location: ". static::CLASS_VARIABLES["table"]);
    }
}