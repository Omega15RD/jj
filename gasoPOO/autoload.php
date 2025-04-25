<?php
// autoload.php
function autoload($class_name) {
    include_once $class_name . '.php';
}

// Registramos el autoloader
spl_autoload_register('autoload');
?>
