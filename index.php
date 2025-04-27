<?php
// Database connection
$servername = "sql107.infinityfree.com";
$username = "if0_38845745";
$password ="GOojCYYtSQOqOmF";
$dbname = "if0_38845745_contactdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$studno = $name = $cpno = "";

// Add Record
if (isset($_POST['add'])) {
    $studno = $_POST['studno'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];

    $sql = "INSERT INTO tblSMS (studno, name, cpno) VALUES ('$studno', '$name', '$cpno')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Added!'); window.location.href='contact.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Search Record for Update/Delete
if (isset($_POST['search_update']) || isset($_POST['search_delete'])) {
    $studno_search = $_POST['studno_search'];
    $sql = "SELECT * FROM tblSMS WHERE studno='$studno_search'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studno = $row['studno'];
        $name = $row['name'];
        $cpno = $row['cpno'];
    } else {
        echo "<script>alert('Student Number not found.');</script>";
    }
}

// Update Record
if (isset($_POST['update'])) {
    $studno = $_POST['studno'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];

    $sql = "UPDATE tblSMS SET name='$name', cpno='$cpno' WHERE studno='$studno'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Updated!'); window.location.href='contact.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete Record
if (isset($_POST['delete'])) {
    $studno = $_POST['studno'];

    $sql = "DELETE FROM tblSMS WHERE studno='$studno'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Deleted!'); window.location.href='contact.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacts Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .menu {
            margin-bottom: 30px;
        }
        .menu-item {
            display: inline-block;
            margin-right: 20px;
        }
        .menu-item a {
            text-decoration: none;
            color: blue;
            font-weight: bold;
            padding: 5px;
            cursor: pointer;
        }
        .form-container {
            display: none;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            width: 400px;
        }
        input[type="text"] {
            width: 90%;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 5px 15px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h3 class="menu">
    <div class="menu-item"><a id="showAdd">Add Record</a></div>
    <div class="menu-item"><a id="showUpdate">Update Record</a></div>
    <div class="menu-item"><a id="showDelete">Delete Record</a></div>
</h3>

<!-- Add Form -->
<div id="addForm" class="form-container">
    <h4>Add Record</h4>
    <form method="POST">
        Student Number: <input type="text" name="studno" required><br><br>
        Name: <input type="text" name="name" required><br><br>
        CP No.: <input type="text" name="cpno" value="63" required> (ex. 639201234567)<br><br>
        <input type="submit" name="add" value="Save">
    </form>
</div>

<!-- Update Form -->
<div id="updateForm" class="form-container">
    <h4>Update Record</h4>
    <form method="POST">
        Student Number: <input type="text" name="studno_search" required>
        <input type="submit" name="search_update" value="Search"><br><br>
        Name: <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
        CP No.: <input type="text" name="cpno" value="<?php echo $cpno ?: '63'; ?>"> (ex. 639201234567)<br><br>
        <input type="hidden" name="studno" value="<?php echo $studno; ?>">
        <input type="submit" name="update" value="Update">
    </form>
</div>

<!-- Delete Form -->
<div id="deleteForm" class="form-container">
    <h4>Delete Record</h4>
    <form method="POST">
        Student Number: <input type="text" name="studno_search" required>
        <input type="submit" name="search_delete" value="Search"><br><br>
        <input type="hidden" name="studno" value="<?php echo $studno; ?>">
        <input type="submit" name="delete" value="Delete">
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addForm = document.getElementById('addForm');
    const updateForm = document.getElementById('updateForm');
    const deleteForm = document.getElementById('deleteForm');

    document.getElementById('showAdd').addEventListener('click', function() {
        addForm.style.display = 'block';
        updateForm.style.display = 'none';
        deleteForm.style.display = 'none';
    });

    document.getElementById('showUpdate').addEventListener('click', function() {
        addForm.style.display = 'none';
        updateForm.style.display = 'block';
        deleteForm.style.display = 'none';
    });

    document.getElementById('showDelete').addEventListener('click', function() {
        addForm.style.display = 'none';
        updateForm.style.display = 'none';
        deleteForm.style.display = 'block';
    });
});
</script>

</body>
</html>