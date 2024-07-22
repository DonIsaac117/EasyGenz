<?php
class Enrutador{
    public function cargarview($view){
        $carpeta = explode("/", $view);
        switch($carpeta[1]){
            case 'inicio':
                require_once("./views/". $carpeta[0] ."/". $carpeta[1]. ".php");
                break;
                case"crear":
                require_once("./views/". $carpeta[0] ."/". $carpeta[1]. ".php");
                break;
                default:
                require_once("./views/pageNotfound.php");
                break;
        }
    }
}