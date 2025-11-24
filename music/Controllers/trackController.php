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
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR . static::CLASS_VARIABLES["table"], [static::CLASS_VARIABLES["dir"] => $table], array("music"), array("music"));
    }
    public function add_Display(){
        $creators = $this->md->selectTable("musicians");
        $bands = $this->md->selectTable("bands");
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR ."add", ["creators" => $creators, "bands" => $bands], array("change_music"), array("change_music"));
    }
    public function edit_Display($id){
        $creators = $this->md->selectTable("musicians");
        $bands = $this->md->selectTable("bands");
        $row = $this->md->selectTable(static::CLASS_VARIABLES["table"], $id);
        $creatortype = ($this->md->selectTable("creators", $row[0]["creator_id"])["bands_id"] === null)? "creator": "band";
        $this->rd->includeFile(static::CLASS_VARIABLES["dir"] . DIRECTORY_SEPARATOR . "edit", ["creators" => $creators, "bands" => $bands, "row" => $row[0], "id" => $id, "creatortype" => $creatortype], array("change_music"), array("change_music"));
    }
    public function add_Save($data){
        $data["track_PATH"] = $this->fileUpload("track_PATH", false);
        if($_FILES["icon_PATH"]["name"] != ""){
            $data["icon_PATH"] = $this->fileUpload("icon_PATH");
        }
        else {
            $data["icon_PATH"] = null;
        }
        $data["album"] = ($data["album"] == "") ? null : $data["album"];
        if($data["creator_type"] == "creator"){
            $data["creator_id"] = $this->md->selectTable("creators", null, ["musician_id" => $data["creator_id"], "band_id" => null])[0]["id"];
        }
        else{
            $data["creator_id"] = $this->md->selectTable("creators", null, ["band_id" => $data["creator_id"]])[0]["id"];
        }
        unset($data["creator_type"]);
        $this->md->insertRow(static::CLASS_VARIABLES["table"], $data);
        header("Location: ". static::CLASS_VARIABLES["table"]);
    }
    public function edit_Save($data, $id){
        $data["track_PATH"] = $this->fileUpload("track_PATH", false);
        if($_FILES["icon_PATH"]["name"] != ""){
            $data["icon_PATH"] = $this->fileUpload("icon_PATH");
        }
        else {
            $data["icon_PATH"] = null;
        }
        $data["album"] = ($data["album"] == "") ? null : $data["album"];
        if($data["creator_type"] == "creator"){
            $data["creator_id"] = $this->md->selectTable("creators", null, ["musician_id" => $data["creator_id"], "band_id" => null])[0]["id"];
        }
        else{
            $data["creator_id"] = $this->md->selectTable("creators", null, ["band_id" => $data["creator_id"]])[0]["id"];
        }
        unset($data["creator_type"]);
        $this->md->updateRow(static::CLASS_VARIABLES["table"], $data, $id);
        header("Location: ". static::CLASS_VARIABLES["table"]);
    }
    public function delete($id){
        $this->md->deleteRow(static::CLASS_VARIABLES["table"], $id);
        header("Location: ". static::CLASS_VARIABLES["table"]);
    }
}