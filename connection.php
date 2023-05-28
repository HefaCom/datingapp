
<?php

    $database= new mysqli("localhost","root","","mydatingapp");
    if ($database->connect_error)
        die("Connection failed:  ".$database->connect_error);


?>