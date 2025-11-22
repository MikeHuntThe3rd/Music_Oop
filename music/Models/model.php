<?php

namespace Music\Models;
use Music\DB\db;
class model {
    public db $db;
    public function __construct(){
        $this->db = db::getInstance();
    }
    public function selectTable($table, $id = null, $where = [], $AND = true){
        if(count($where) > 0){
            $sql = "SELECT * FROM $table WHERE ";
            $keys = array_keys($where);
            for($i = 0; $i < count($where); $i++){
                $sql .= " " . $keys[$i] . " = :" . $keys[$i];
                if($i + 1 < count($where)){
                    if($AND){
                        $sql .= " AND";
                    }else{
                        $sql .= " OR";
                    }
                }
            }
            return $this->db->SingleQuery($sql, $where);
        }
        else if($id == null){
            return $this->db->SingleQuery("SELECT * FROM $table");
        }
        else{
            return $this->db->SingleQuery("SELECT * FROM $table WHERE `id` = :id", ["id" => $id]);
        }
    }
    public function findId($table, $col, $element){
        return $this->db->SingleQuery("SELECT id FROM $table WHERE $col = :element", ["element" => $element])[0]["id"];
    }
    protected function getTableCols($table){
        $rawData = $this->db->SingleQuery("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'music' AND TABLE_NAME = :t", ["t" => $table]);
        $outputArr = [];
        foreach($rawData as $assocArr){
            if($assocArr["COLUMN_NAME"] != "id"){
                $outputArr[] = $assocArr["COLUMN_NAME"];
            }
        }
        return $outputArr;
    }
    protected function getRelevantColsAndVars($table, $data){
        $keys = array_keys($data);
        $cols =$this->getTableCols($table);
        $cols = array_intersect($cols, $keys);
        $Vars = $cols;
        array_walk($Vars, function(&$value) {$value = ":$value";});
        return ["Cols" => $cols, "Vars" => $Vars];
    }
    public function updateRow($table, $data, $id){
        $data = array_filter($data, fn($k) => $k !== "id", ARRAY_FILTER_USE_KEY);
        $columns = $this->getRelevantColsAndVars($table, $data);
        $sql = "UPDATE $table SET";
        $size = count($columns["Cols"]);
        for($i = 0; $i < $size; $i++){
            $sql .= " ". $columns["Cols"][$i] . " = ". $columns["Vars"][$i];
            if($i + 1 != $size) $sql .= ",";
            else $sql .= " ";
        }
        $sql .= "WHERE id = $id";
        $this->db->SingleQuery($sql, $data);
    }
    public function insertRow($table, $data){
        $data = array_filter($data, fn($v) => $v !== "");
        $columns = $this->getRelevantColsAndVars($table, $data);
        $sql = "INSERT INTO $table (";
        $sql .= implode(", ", $columns["Cols"]) . ") VALUES (";
        $sql = $sql . implode(", ", $columns["Vars"]) . ")";
        echo "<br>";
        var_dump($sql);
        var_dump($data);
        echo "<br>";
        $this->db->SingleQuery($sql, $data);
    }
    public function deleteRow($table, $id){
        $this->db->SingleQuery("DELETE FROM $table WHERE id = :id", ["id" => $id]);
    }
}