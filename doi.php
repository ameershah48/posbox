<?php 
require( __DIR__ . "/includes/load.php" );
require(__DIR__ . "/includes/layout.php");

if (isset($_POST["have_mail"])) {
        $db->updateMail($_GET["id"], $_POST["have_mail"]);
}

?>

<body class="bg-gray-200">
    <div class="flex justify-center">
        <div class="mt-16 flex flex-col bg-white shadow-lg ">
            <div class="p-6">
                <div class="flex justify-center p-2 mb-2">
                    <p class="text-center font-semibold text-4xl">Do I have <br>a mail?</p>
                </div>
                <form method="post">
                        <div class="flex justify-center p-2">
                            <a href="./" class="font-bold text-black p-4 mx-2">Cancel</a>
                            <input type="hidden" name="have_mail" value="1">
                            <button class="bg-green-500 font-bold text-white rounded px-8 py-2 mx-2">
                                Yes
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>