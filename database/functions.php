<?php

    // require MySQL Connection
    require('DBController.php');

    // require Polling Unit class
    require('Polling-unit.php');

    // require Lga class
    require('Lga.php');

    // require Create Polls class
    require('Create.php');

    // require New Polls results class
    require('New-result.php');

    // DBController object
    $db = new DBController();

    // Polling Unit object
    $poll = new PollingUnit($db);

    // Lga object
    $lga = new Lga($db);

    // Create Polls object
    $create = new Create($db);

    // New results object
    $newResults = new NewResult($db);

?>