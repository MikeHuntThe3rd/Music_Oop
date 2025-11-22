<?php

namespace Music\Routing;
use Music\Controllers\BandsController;
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
        switch ($URI){
            case "/home":
                new FrontPageController()->displaythis();
                break;
            //musicians
            case "/musicians":
                new musicianController()->display();
                break;
            case "/ADD_musician":
                new musicianController()->add_Display();
                break;
            //bands
            case "/bands":
                new BandsController()->display();
                break;
            case "/ADD_band":
                new BandsController()->add_Display();
                break;
            default:
                new FrontPageController()->displaythis();
                break;
        }
    }
    public function POSTreq($ReqURI){
        $data = $this->FilterPostKeys($_POST);
        $id = $data["id"] ?? null;
        switch ($ReqURI){
            //musicians
            case "/ADD_musician":
                new musicianController()->add_Save($data);
                break;
            case "/EDIT_musician":
                new musicianController()->edit_Display($id);
                break;
            case "/EDIT_musician_save":
                new musicianController()->edit_Save($data, $id);
                break;
            case "/DEL_musician":
                new musicianController()->delete($id);
                break;
            //bands
            case "/ADD_band_save":
                new BandsController()->add_Save($data);
                break;
            case "/EDIT_band":
                new BandsController()->edit_Display($id);
                break;
            case "/EDIT_band_save":
                new BandsController()->edit_Save($data, $id);
                break;
            case "/DEL_band":
                new BandsController()->delete($id);
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