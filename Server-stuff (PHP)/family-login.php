<?php
$servername = "localhost";
$username = "chris";
$password = "Chriso12";
$dbname = "carecentral";

$familyName = $_POST["family-name"];
$familyPassword = $_POST["family-password"];

// Redirect function
function redirect($url) {
    header("Location: ".$url);
    die();
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn -> connect_error);
}
echo "Connection successfully completed";
echo "<br>";
$sql_select = "SELECT familyname, familypassword FROM families";
$result = $conn->query($sql_select);
$authorized = 0;
while ($row = $result->fetch_assoc()) {
    if ($familyName === $row["familyname"]) {
        $authorized += 1;
    }
    else {
        $authorized -= 1;
    }
    if ($familyPassword === $row["familypassword"]) {
        $authorized += 1;
    }
    else {
        $authorized -= 1;
    }
}

$conn->close();

if ($authorized > 1) {
    redirect("/family-UI.html");
}
else {
    redirect("/login-failed.html");
}
?>