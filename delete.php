<?php 
require( __DIR__ . "/includes/load.php" );

requireAuth();

    if (isset($_GET["id"])) {
        $db->deletePlace($_GET["id"]);
    }
?>