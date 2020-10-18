<?php

require_once('db.php');

$db = new Db();

// Delete Data
if(isset($_POST['deleteData'])) {
    $id = $_POST['id'];
    $db->deleteData($id);
}

// Search Data
if(isset($_GET['search'])) {
    $data = $db->searchData($_GET['search']);
} else {
    $data = $db->getData();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
    <h1>Insert Data</h1>
    <form action="insert.php" method="POST">
        <input type="text" placeholder="Name" name="name" required>
        <input type="text" placeholder="Email" name="email" required>
        <input type="submit" value="Insert" name="insertData">
    </form>

    <h1>Delete Data</h1>
    <form method="POST">
        <input type="text" placeholder="Id" name="id" required>
        <input type="submit" value="Delete" name="deleteData">
    </form>

    <h1>Edit Data</h1>
    <form method="POST" action="editData.php">
        <input type="text" placeholder="Id" name="id" required>
        <input type="text" placeholder="Name" name="name" required>
        <input type="submit" value="Edit" name="editData">
    </form>


    <h1>Search Data</h1>
    <form method="GET">
        <input type="text" placeholder="Search" name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']  ?>">
        <input type="submit" value="Search">
    </form>

    <h1>Data</h1>

    <?php
        foreach($data as $i) {
            echo $i['id'] ." " . $i['name'] . " " . $i['email'] . "<br>";
        }
    ?>
</body>
</html>