<?php

namespace Music\Routing;
use Music\Controllers\BandsController;
use Music\Controllers\FrontPageController;
use Music\Controllers\musicianController;
use Music\Controllers\TrackController;

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
                $controller = new FrontPageController();
                $controller->displaythis();
                break;
            // musicians
            case "/musicians":
                $controller = new musicianController();
                $controller->display();
                break;
            case "/ADD_musician":
                $controller = new musicianController();
                $controller->add_Display();
                break;
            // bands
            case "/bands":
                $controller = new BandsController();
                $controller->display();
                break;
            case "/ADD_band":
                $controller = new BandsController();
                $controller->add_Display();
                break;
            // music (tracks)
            case "/music":
                $controller = new TrackController();
                $controller->display();
                break;
            case "/ADD_music":
                $controller = new TrackController();
                $controller->add_Display();
                break;
            default:
                $_SESSION["msg"] = ["warning", "Get url not found! Defaulting to front page"];
                $controller = new FrontPageController();
                $controller->displaythis();
                break;
        }
    }
    
    public function POSTreq($ReqURI){
        $data = $this->FilterPostKeys($_POST);
        $id = $data["id"] ?? null;
        switch ($ReqURI){
            // musicians
            case "/ADD_musician":
                $controller = new musicianController();
                $controller->add_Save($data);
                break;
            case "/EDIT_musician":
                $controller = new musicianController();
                $controller->edit_Display($id);
                break;
            case "/EDIT_musician_save":
                $controller = new musicianController();
                $controller->edit_Save($data, $id);
                break;
            case "/DEL_musician":
                $controller = new musicianController();
                $controller->delete($id);
                break;
            // bands
            case "/ADD_band_save":
                $controller = new BandsController();
                $controller->add_Save($data);
                break;
            case "/EDIT_band":
                $controller = new BandsController();
                $controller->edit_Display($id);
                break;
            case "/EDIT_band_save":
                $controller = new BandsController();
                $controller->edit_Save($data, $id);
                break;
            case "/DEL_band":
                $controller = new BandsController();
                $controller->delete($id);
                break;
            // music (tracks)
            case "/ADD_music":
                $controller = new TrackController();
                $controller->add_Save($data);
                break;
            case "/EDIT_music":
                $controller = new TrackController();
                $controller->edit_Display($id);
                break;
            case "/EDIT_music_save":
                $controller = new TrackController();
                $controller->edit_Save($data, $id);
                break;
            case "/DEL_music":
                $controller = new TrackController();
                $controller->delete($id);
                break;
            default:
                $_SESSION["msg"] = ["warning", "POST url not found! Defaulting to front page"];
                $controller = new FrontPageController();
                $controller->displaythis();
                break;
        }
    }
    
    public function FilterPostKeys($data){
        $filterKeys = ['_method', 'submit'];
        return array_diff_key($data, array_flip($filterKeys));
    }
}