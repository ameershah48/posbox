<?php 
require(__DIR__ . "/includes/layout.php");
require( __DIR__ . "/includes/load.php" );

requireAuth();

$places = [];
$stmt = $db->mysqli()->query("SELECT * FROM places ORDER BY id DESC");
if ($stmt->num_rows > 0) {
    while ($data = $stmt->fetch_assoc()) {
        $id = $data["id"];
        $name = $data["place_name"];
        $location = $data["place_location"];
        $have_mail = $data["have_mail"];


        $places[$id] = compact("id", "name", "location", "have_mail");
    }
}

?>

<body class="bg-gray-200">
    <div class="flex justify-center">
        <div class="mt-16 flex flex-col bg-white shadow-lg mb-24 w-11/12">
            <div class="flex flex-row justify-between bg-white px-6 py-4">
                <div class="p-2">
                <button onclick="location.href='./dashboard.php'" class="px-4 py-3 font-bold mr-2 rounded-full bg-black text-white">Places</button>
                <button onclick="location.href='./add.php'" class="p-2 font-bold mr-2">Add Places</button>
                </div>
                <div class="flex p-2 items-center">
                <a href="?logout=true"><button class="p-2 font-bold text-red-500">Logout</button></a>
                </div>
            </div>
            <?php if (isset($_GET["success"]) && $_GET["success"] == true): ?>
                <div style="padding: 8px 25px; background-color:#158467; color:white">
                    New place has been added!
                </div>
            <?php elseif (isset($_GET["updated"]) && $_GET["updated"] == true): ?>
                <div style="padding: 8px 25px; background-color:#158467; color:white">
                    The place has been updated!
                </div>
            <?php elseif (isset($_GET["deleted"]) && $_GET["deleted"] == true): ?>
                <div style="padding: 8px 25px; background-color:#ab2b11; color:white">
                    The place with an ID of <?= $_GET['id'] ?> has been deleted
                </div>
            <?php endif; ?>
            <div class=" h-64 overflow-auto">
            <?php if (empty($places)): ?>
                <div class="content" style="display:flex; height:200px; align-items:center; justify-content:center">
                    No places added yet.
                </div>
            <?php else: ?>
            <table class="min-w-full leading-normal" style="height:150px; overflow:auto;">
            <thead>
                    <tr>
                        <th class="w-2 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            PLACE
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            LOCATION
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            HAVE MAIL?
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                        </th>
                    </tr>
                </thead>
                    <tbody>
                    <?php foreach($places as $id => $place): ?>
                        <tr>
                        <td class="w-2 px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                <?= $place["id"] ?>
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                <?= $place["name"] ?>
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                <?= $place["location"] ?>
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                <?php
                                    if ($place["have_mail"] == 1) 
                                        {
                                            echo "Yes";
                                        } 
                                    else 
                                        {
                                            echo "No";
                                        }
                                ?>
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-48">
                                <div class="flex flex-row w-auto">
                                    <div class="mr-2">
                                        <a href="./add.php?id=<?=$id ?>">
                                            <svg viewBox="0 0 20 20" fill="currentColor" class="pencil w-6 h-6">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="mr-2">
                                        <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?= "./delete.php?id=$id" ?>">
                                            <svg viewBox="0 0 20 20" fill="currentColor" class="trash w-6 h-6">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="mr-2">
                                        <a onClick="window.open('./qr.php?id=<?=$id?>','MyWindow','width=300,height=250'); return false;" href="">
                                            <svg viewBox="0 0 20 20" fill="currentColor" class="qrcode w-6 h-6">
                                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd"></path><path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z">
                                                    </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>