<?php

namespace Music\Routing;

class Router{
    public function ReqHandle(){
        $MethodType = strtoupper($_SERVER["REQUEST_METHOD"]);
        $ReqURI = $_SERVER["REQUEST_URI"];
        switch ($MethodType){
            case "GET":
                $this->GETreq($ReqURI);
                break;
            case "POST":
                $this->POSTreq($ReqURI);
                break;
            case "PATCH":
                break;
            case "DELETE":
                break;
            default:
                echo "error method not found";
                break;
        }
    }
    public function GETreq($URI){
        $data = $this->FilterPostKeys($_POST);
        $id = $data["ISBN"] ?? null;
        switch ($URI){
            default:
                echo "no GET uri matched the input";
                break;
        }
    }
    public function POSTreq($ReqURI){
        $data = $this->FilterPostKeys($_POST);
        $id = $data["id"] ?? null;
        switch ($ReqURI){
            //books
            default:
                echo "no POST uri matched the input";
                break;
        }
    }
    public function FilterPostKeys($data){
        $filterKeys = ['_method', 'submit'];
        return array_diff_key($data, array_flip($filterKeys));
    }
}