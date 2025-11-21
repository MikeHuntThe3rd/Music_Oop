<?php

namespace Music\Controllers;
use Music\Controllers\controller;

class BandsController extends controller {
    private const CLASS_VARIABLES = [
        "table" => "bands",
        "dir" => "groups"
    ];
    public function display(){
        $table = $this->md->selectTable(static::CLASS_VARIABLES["table"]);
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR . static::CLASS_VARIABLES["table"], [static::CLASS_VARIABLES["dir"] => $table]);
    }
    public function add_Display(){
        $musicians = $this->md->selectTable("musicians");
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR ."add", ["creators" => $musicians]);
    }
    public function edit_Display($id){
    }
    public function add_Save($data){
        $this->md->insertRow(static::CLASS_VARIABLES["table"], ["name" => $data["name"]]);
        $members = $data["musicians"];
        $id = $this->md->findId(static::CLASS_VARIABLES["table"], "name", $data["name"]);
        foreach($members as $member){
            $this->md->insertRow("creators", ["musician_id" => $member, "band_id" => $id]);
        }
        header("Location: bands");
    }
    public function edit_Save($data, $id){
    }
    public function delete($id){
        $this->md->deleteRow(static::CLASS_VARIABLES["table"], $id);
        header("Location: ". static::CLASS_VARIABLES["table"]);
    }
}