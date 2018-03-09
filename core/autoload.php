<?php


function autoload($class)
{
    // if file does not exist in LIBS_PATH folder [set it in config/config.php]
    if (file_exists("core/" . $class . ".php")) {
        require "core/" . $class . ".php";
    } else {

        exit ('"Cant find core file"');
    }
}
// spl_autoload_register defines the function that is called every time a file is missing. as we created this
// function above, every time a file is needed, autoload(THENEEDEDCLASS) is called
spl_autoload_register("autoload");