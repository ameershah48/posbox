<?php
function login($username, $password) {
    global $db;

    // Username or password is empty
    if (empty($username) || empty($password)) {
        exit( "Username/password is empty" );
    }

    $password = hash("md5", $password);
    $mysqli = $db->mysqli();
    $result = $mysqli->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    if ( $result->num_rows > 0 ) {
        $result->free_result();
        setcookie("user", $username, time()+3600); 
        return true;
    }
    
    return false;
}

function requireAuth() {
    if (!isset($_COOKIE["user"])) {
        header( "Location: ./" );
        exit;
    }

    if(isset($_GET['logout']) == "true"){
        setcookie("user", "", time() - 3600);
        header( "Location: ./" );
    }

}

function getQR($id) {
    return "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://posbox.ameershah48.com/doi.php?id=$id";
}

function getDOI($id){
    global $db;

    $mysqli = $db->mysqli();
    $result = $mysqli->query("SELECT have_mail FROM places WHERE id = '$id'");
    if ( $result->num_rows > 0 ) {
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        return $row['have_mail'];
    }
}