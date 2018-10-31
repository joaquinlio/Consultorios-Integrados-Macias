<?php
    session_start();
    //mi funcion de autocarga
    function miAutocargador($clase){
        require_once "clases/".$clase.".php";
    }

    spl_autoload_register("miAutocargador");

  