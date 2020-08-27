<?php 
require( __DIR__ . "/includes/load.php" );
require(__DIR__ . "/includes/layout.php");

requireAuth();

    if (isset($_GET["id"])) {
        $id = $_GET['id'];
    } else {
        exit($this->mysqli->error);
    }

?>

<div class="flex flex-col justify-center items-center mt-8">
    <img
        alt="qr code"
        src="<?= getQR($id); ?>"
    >
    <div>Scan me</div>
</div>