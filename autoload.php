<?php
//Inicio de php
 //función de autocargar
 function controller_autoload($classname){
    include 'controllers/'. $classname . '.php';
 }

 spl_autoload_register('controller_autoload');
//Fin de php
?>