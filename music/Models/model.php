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
            return $this->db->SingleQuery("SELECT * FROM $table WHERE `id` = :id", ["id" => $id]);
        }
    }
    private function getTableCols($table){
        $rawData = $this->db->SingleQuery("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'music' AND TABLE_NAME = :t", ["t" => $table]);
        $outputArr = [];
        foreach($rawData as $assocArr){
            if($assocArr["COLUMN_NAME"] != "id"){
                $outputArr[] = $assocArr["COLUMN_NAME"];
            }
        }
        return $outputArr;
    }
    public function insertRow($table, $data){
        //remove empty elements
        $data = array_filter($data, fn($v) => $v !== "");
        //handle empty cols
        $keys = array_keys($data);
        $allColNames = $this->getTableCols($table);
        var_dump($allColNames);
        $filteredCols = implode(", ", array_intersect_key($allColNames, $keys));
        array_walk($keys, function(&$value) {$value = ":$value";});
        //format sql and add variables
        $sql = "INSERT INTO $table (";
        $sql .= $filteredCols . ") VALUES (";
        $sql = $sql . implode(", ", $keys) . ")";
        $this->db->SingleQuery($sql, $data);
    }
    public function deleteRow($table, $id){
        $this->db->SingleQuery("DELETE FROM $table WHERE id = :id", ["id" => $id]);
    }
}