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
    protected function fileUpload($fileIndex, $isImg = true){
        $target_dir = ($isImg) ? "uploads/img/" : "uploads/sound/";
        $newPATH = $target_dir . basename($_FILES[$fileIndex]["name"]);
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }

        if(file_exists($newPATH)){
            unset($_FILES[$fileIndex]);
            return $newPATH;
        }
        else {
            move_uploaded_file($_FILES[$fileIndex]["tmp_name"], $newPATH);
            unset($_FILES[$fileIndex]);
            return $newPATH;
        }
    }
    protected function creatorCleanUp($bandId, $bandMembers){
        $foundMembers = $this->md->db->SingleQuery("SELECT * FROM creators WHERE musician_id IS NOT NULL AND band_id = :id", ["id" => $bandId]);
        $single_col = array_column($foundMembers, "musician_id");
        var_dump($single_col);
        array_walk($bandMembers, function ($value) use ($bandId, $single_col) {
            if(!in_array($value, $single_col)){
                $this->md->insertRow("creators", ["musician_id" => $value, "band_id" => $bandId]);
            }
        });
        array_walk($foundMembers, function ($value) use ($bandMembers) {
            if(!in_array($value["musician_id"], $bandMembers)){
                $this->md->deleteRow("creators", $value["id"]);
            }
        });
    }
}