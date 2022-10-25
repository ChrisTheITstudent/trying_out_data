<?php
$servername = "localhost";
$username = "chris";
$password = "Chriso12";
$dbname = "carecentral";

$famName = $_POST["family-name"];
$given_name = $_POST["firstName"];
$surname = $_POST["lastName"];
$ageOfChild = intval($_POST["age"]);

class Children {
    public $family;
    public $firstName;
    public $lastName;
    public $age;
    public $isAttending;

    function __construct($fName, $first, $second, $newAge) {
        $this->family = $fName;
        $this->firstName = $first;
        $this->lastName = $second;
        $this->age = $newAge;
        $this->isAttending = 0;
    }
    function get_familyName() {
        return $this->family;
    }
    function get_firstName() {
        return $this->firstName;
    }
    function get_lastName() {
        return $this->lastName;
    }
    function get_age() {
        return intval($this->age);
    }
    function get_attending() {
        return intval($this->isAttending);
    }
}

// Redirect function
function redirect($url) {
    header("Location: ".$url);
    die();
}

// Create object for new child
$newChild = new Children($famName, $given_name, $surname, $ageOfChild);

// Create mySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checks for connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn -> connect_error);
}
echo "Connection successfully completed";
echo "<br>";

// Sets the number of children in the family as a variable
$sql_select = "SELECT children FROM families";
$result = $conn->query($sql_select);

// Set the result as a usable variable
while ($row = $result->fetch_assoc()) {
    $familyNumber = $row["children"];
}
echo "<p>Family number: " . $familyNumber . "</p><br>";

// Sets the temp data as result
$sql_select = "SELECT tempnumber, assosiation FROM tempdata";
$result = $conn->query($sql_select);

// Initializes number of results variable.
$numberOfResults = 0;

// Set temp results as usable variable if any are returned and
// numberOfResults as number
if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        if ($row["assosiation"] = $famName) {
            $tempNumber = $row["tempnumber"];
            $numberOfResults += 1;
        }
    }
    echo "<p>temp number: " . strval($tempNumber) . "</p>";
    echo "<p>numberOfResults: " . strval($numberOfResults) . "</p><br>";
}
// Set temp data as familyNumber if 0 results are returned and 
// numberOfResults as false.
else {
    $tempNumber = $familyNumber;
    $numberOfResults = 0;
    echo "<p>temp number: " . strval($tempNumber) . "</p>";
    echo "<p>numberOfResults: " . strval($numberOfResults) . "</p><br>";
}

// If there's no temp data assosiated with the family name, add the number
// of children for that family as temp data.
if ($numberOfResults < 1) {
    $sql_insert = "INSERT INTO tempdata (assosiation, tempnumber) VALUES ('$famName', '$tempNumber')";
    if($conn->query($sql_insert) === TRUE){
        echo "Temp record added";
        echo "<br>";
    }
    else {
        "Error: unable to execute $sql_insert. " . $conn->error;
    }
}

// Add posted child data to the children table if the temp data is > 0
if ($tempNumber > 0) {
    $sql_insert = "INSERT INTO children (familyname, firstname, lastname, age, isAttending) VALUES (?, ?, ?, ?, ?)";
    
    if($stmt = $conn->prepare($sql_insert)){
        $stmt->bind_param("sssii", $newFamily, $newFirstName, $newLastName, $lastestAge, $Attending);

        $newFamily = $newChild->get_familyName();
        $newFirstName = $newChild->get_firstName();
        $newLastName = $newChild->get_lastName();
        $lastestAge = $newChild->get_age();
        $Attending = $newChild->get_attending();

        $stmt->execute();

        echo "Child records inserted";
        echo "<br>";
    }
    else {
        echo "Error: Could not prepare query: ". $sql_insert . "."  . $conn->error;
    }

    $stmt->close();
}

// Minus temp data by 1
echo "<p>Family number (before editing): " . strval($tempNumber) . "<p>";

$tempNumber -= 1;

$sql_update = "UPDATE tempdata SET tempnumber=$tempNumber";

if ($conn->query($sql_update) === TRUE) {
    echo "Record updated";
    echo "<br>";
}
else {
    echo "Error updating temp number: " . $conn->error;
}

// If the familyNumber is now > 0, redirect to the form page
if ($tempNumber > 0) {
    echo "<p>Family number: " . $tempNumber . "</p><br>";
}
// Else, redirect to family created confirmation
else {
    echo "All records complete!!!";
    $sql_delete = "DELETE FROM tempdata";
    if ($conn->query($sql_delete) === TRUE) {
        echo "All temp data is deleted";
    }
    else {
        echo "Error deleting temp data: " . $conn->error;
    }
}

$conn->close();
?>