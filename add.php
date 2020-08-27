<?php 
require( __DIR__ . "/includes/load.php" );
require(__DIR__ . "/includes/layout.php");

requireAuth();

if (isset($_POST["place_name"])) {
    if (isset($_GET["id"])) {
        $db->updatePlace($_GET["id"], $_POST["place_name"], $_POST["location"], $_POST["have_mail"]);
    } else {
        $db->addPlace($_POST["place_name"], $_POST["location"]);
    }
}

// For update, we get the data from the database based on
// the ID provided from the URL query. Example: /add.php?id=1
if (isset($_GET["id"])) {
    $place = $db->getPlace($_GET["id"]);

    $id = isset($place["id"]) ? $place["id"] : "";
    $place_name = isset($place["name"]) ? $place["name"] : "";
    $place_location = isset($place["location"]) ? $place["location"] : "";
    $have_mail = isset($place["have_mail"]) ? $place["have_mail"] : "";

} else {
    $id = "";
    $place_name = "";
    $place_location = "";
    $have_mail = "";
}
?>

<body class="bg-gray-200">
    <div class="flex justify-center">
        <div class="mt-16 flex flex-col bg-white shadow-lg mb-24 w-11/12">
            <div class="flex flex-row justify-between bg-white px-6 py-4 border-b-2">
                <div class="p-2">
                <button onclick="location.href='./dashboard.php'" class="p-2 font-bold mr-2">Places</button>
                <button onclick="location.href='./add.php'" class="px-4 py-3 font-bold rounded-full bg-black text-white mr-2">Add Places</button>
                </div>
                <div class="flex p-2 items-center">
                <a href="?logout=true"><button class="p-2 font-bold text-red-500">Logout</button></a>
                </div>
            </div>
            
            <div class="p-2">
                <form method="post">
                    <div class="p-2">
                        <label for="Places">Place Name</label>
                        <input required class="w-full h-12 border p-2" type="text" name="place_name" id="name" value="<?= $place_name; ?>">
                    </div>
                    <div class="p-2">
                        <label for="Places">Location</label>
                        <input required class="w-full h-12 border p-2" type="text" name="location" id="location" value="<?= $place_location; ?>">
                    </div>
                    <div class="p-2">
                        <label for="Places">Have Mail? (Test purpose)</label>
                        <select name="have_mail" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option selected disabled>Choose</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                        <div class="flex justify-end p-2">
                            <button class="bg-black font-bold text-white rounded p-4">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>