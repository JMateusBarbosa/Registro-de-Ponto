<?php 

    define('INCLUDE_PATH','/registro_de_ponto/');
    
    $autoload = function($class){
        if(file_exists($class.'.php')){
            include($class.'.php');
        }
        else{
            die('Nao conseguimos encontrar a classe '.$class);
        }
    };

    spl_autoload_register($autoload);

    $application = new Application();
    $application->run();
?>