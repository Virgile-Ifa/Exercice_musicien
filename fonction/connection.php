<?php

    //connection a la bdd port 3308, dbname:mvb
    $bdd = new PDO("mysql:host=localhost;port=3308;dbname=mvc","root", "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
?>