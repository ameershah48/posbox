<?php 
require( __DIR__ . "/includes/load.php" );
require(__DIR__ . "/includes/layout.php");

if ($_POST) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (login($username, $password)) {
        header("Location: ./dashboard.php");
        exit;
    }
    
    exit("Invalid username/password.");
}

?>
<body class="bg-gray-200">
    <div class="flex justify-center items-center w-screen h-screen bg-white-200">
        <div class="flex flex-col bg-white p-4 shadow-lg">
            <form class="form" method="post">
            <div class="p-2"><input class="w-full h-12 bg-gray-200 p-2" name="username" value="ameer" type="text"></div>
            <div class="p-2"><input class="w-full h-12 bg-gray-200 p-2" name="password" value="123" type="password"></div>
            <div class="flex justify-center p-2"><input class="w-full bg-black font-bold text-white p-2 rounded" value="LOGIN" type="submit"></div>
            <div class="mt-5">
                <p class="font-thin italic">*Project based on <a class="text-blue-500" href="https://github.com/omarqe/bcwo-s1">Omarqe's Github</a> with some modifications! :D</p>
            </div>
            </form>
        </div>
    </div>
</body>