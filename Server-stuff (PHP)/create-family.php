<?php
$servername = "localhost";
$username = "chris";
$password = "Chriso12";
$dbname = "carecentral";

$famName = $_POST["family-name"];
$famPassword = $_POST["family-password"];
$numOfChildren = $_POST["no-of-children"];

// turinging data into classes for sql tables
class Families {
    public $familyName;
    public $role = "family";
    public $familyPassword;
    public $numberOfChildren;

    // constructor to assign values to the object
    function __construct($name, $pword, $chnNumber) {
        $this->familyName = $name;
        $this->familyPassword = $pword;
        $this->numberOfChildren = $chnNumber;
    }

    // method to return family name
    function get_name() {
        return $this->familyName;
    }

    // method to return password
    function get_password() {
        return $this->familyPassword;
    }

    // method to return number of children
    function get_number_of_children() {
        return intval($this->numberOfChildren);
    }

    // method to return role
    function get_role() {
        return $this->role;
    }
}

// Redirect function
function redirect($url) {
    header("Location: ".$url);
    die();
}

// Define object for new family
$newFamily = new Families($famName, $famPassword, $numOfChildren);

// Create mySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checks for connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn -> connect_error);
}
echo "Connection successfully completed";
echo "<br>";

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO Families (familyname, familypassword, children) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $newName, $newPassword, $newNumberOfChildren);

// Set parameters
$newName = $newFamily->get_name();
$newPassword = $newFamily->get_password();
$newNumberOfChildren = $newFamily->get_number_of_children();

// Execute
$stmt->execute();

echo "New record created";
echo "<br>";

$stmt->close();
$conn->close();

if ($newNumberOfChildren < 0) {
    redirect("/new-child.html");
    die()
}
else {
    redirect("/family-UI.html");
    die()
}
?>