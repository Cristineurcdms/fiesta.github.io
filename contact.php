<?php
$servername = "sql107.infinityfree.com";
$username = "if0_38845745";
$password = "GOojCYYtSQOqOmF";
$dbname = "if0_38845745_contactdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studno = $name = $cpno = "";

if (isset($_POST['add'])) {
    $studno = $_POST['studno'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];

    $sql = "INSERT INTO tblSMS (studno, name, cpno) VALUES ('$studno', '$name', '$cpno')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Added!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['search_update'])) {
    $studno_search = $_POST['studno_search'];
    $sql = "SELECT * FROM tblSMS WHERE studno='$studno_search'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<form method='POST' action='contact.php'>
                <h4>Update Record</h4>
                Student Number: <input type='text' name='studno' value='{$row['studno']}' readonly><br><br>
                Name: <input type='text' name='name' value='{$row['name']}'><br><br>
                CP No.: <input type='text' name='cpno' value='{$row['cpno']}'><br><br>
                <input type='submit' name='update' value='Update'>
              </form>";
    } else {
        echo "<script>alert('Student Number not found.'); window.location.href='index.html';</script>";
    }
}

if (isset($_POST['update'])) {
    $studno = $_POST['studno'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];

    $sql = "UPDATE tblSMS SET name='$name', cpno='$cpno' WHERE studno='$studno'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Updated!'); window.location.href='index.html';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_POST['search_delete'])) {
    $studno_search = $_POST['studno_search'];
    $sql = "SELECT * FROM tblSMS WHERE studno='$studno_search'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<form method='POST' action='contact.php'>
                <h4>Confirm Delete</h4>
                Student Number: <input type='text' name='studno' value='{$row['studno']}' readonly><br><br>
                Name: <input type='text' value='{$row['name']}' disabled><br><br>
                CP No.: <input type='text' value='{$row['cpno']}' disabled><br><br>
                <input type='submit' name='delete' value='Delete'>
              </form>";
    } else {
        echo "<script>alert('Student Number not found.'); window.location.href='index.html';</script>";
    }
}

if (isset($_POST['delete'])) {
    $studno = $_POST['studno'];
    $sql = "DELETE FROM tblSMS WHERE studno='$studno'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Deleted!'); window.location.href='index.html';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
