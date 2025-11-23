<?php


namespace Music\Controllers;
use Music\Controllers\controller;

class musicianController extends controller {
    private const CLASS_VARIABLES = [
        "table" => "musicians",
        "dir" => "creators"
    ];
    public function display(){
        $table = $this->md->selectTable(static::CLASS_VARIABLES["table"]);
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR . static::CLASS_VARIABLES["table"], [static::CLASS_VARIABLES["dir"] => $table]);
    }
    public function add_Display(){
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR ."add");
    }
    public function edit_Display($id){
        $table = $this->md->selectTable(static::CLASS_VARIABLES["table"], $id);
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR . "edit", ["creator" => $table[0], "id" => ["id" => $id]]);
    }
    public function add_Save($data){
        $this->md->insertRow(static::CLASS_VARIABLES["table"], $data);
        $latestId = $this->md->db->SingleQuery("SELECT MAX(id) FROM " . static::CLASS_VARIABLES["table"])[0]["MAX(id)"];
        $this->md->insertRow("creators", ["musician_id" => $latestId]);
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