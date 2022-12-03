
<?php

    // they are variables that are always available in all scopes

    /*
        $_GET contains the information about the variables passed through a URL or a form
        $_POST contains the information about the variables passed through a form
        $_COOKIE contains the information about the variables passed through a cookie
        $_SESSION contains the information about the variables passed through a session
        $_SERVER contains the information about the a server environments
        $_ENV contains the information about the environment variables 
        $_FILES contains the information about files updated to the script
        $_REQUEST contains the information about the variables passed through the form or URL

    */
    var_dump($_SERVER);

    echo $_SERVER["PHP_CPPFLAGS"];


?>