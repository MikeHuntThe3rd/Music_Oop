<?php

namespace Music\Routing;
use Music\Controllers\FrontPageController;
use Music\Controllers\musicianController;

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
        $id = $data["id"] ?? null;
        switch ($URI){
            case "/":
                $front = new FrontPageController();
                $front->displaythis();
                break;
            case "/musicians":
                $ms = new musicianController();
                $ms->display();
                break;
            case "/ADD_musician":
                $ms = new musicianController();
                $ms->add_Display();
                break;
            case "/EDIT_musician":
                $ms = new musicianController();
                $ms->edit_Display($id);
                break;
            default:
                echo "no GET uri matched the input";
                break;
        }
    }
    public function POSTreq($ReqURI){
        $data = $this->FilterPostKeys($_POST);
        $id = $data["id"] ?? null;
        switch ($ReqURI){
            case "/ADD_musician":
                $ms = new musicianController();
                $ms->add_Save($data);
                break;
            case "/EDIT_musician":
                $ms = new musicianController();
                $ms->edit_Save($id);
                break;
            case "/DEL_musician":
                $ms = new musicianController();
                $ms->delete($id);
                break;
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