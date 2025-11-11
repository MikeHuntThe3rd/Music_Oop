<?php

namespace Music\Models;
use Music\DB\db;
class model {
    public db $db;
    public function __construct(){
        $this->db = db::getInstance();
    }
    public function selectTable($table, $id = null){
        if($id == null){
            return $this->db->SingleQuery("SELECT * FROM :t", ["t" => $table]);;
        }
        else{
            return $this->db->SingleQuery("SELECT * FROM :t WHERE `id` = :id", ["t" => $table, "id" => $id]);
        }
    }
    public function getTableCols($table){
        return $this->db->SingleQuery("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'music' AND TABLE_NAME = :t", ["t" => $table]);
    }
    public function insertRow($table, $data){
        $this->db->SingleQuery("INSERT INTO :t (:cols) VALUES (:vals)", ["t" => $table, "cols" => $this->getTableCols($table), "vals" => $data]);
    }
}