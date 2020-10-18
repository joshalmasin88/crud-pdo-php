<?php

require_once('db.php');

if(isset($_POST['editData'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $db = new Db();
    $db->editData($id, $name);
    header('Location: index.php');
}