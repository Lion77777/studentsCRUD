<?php

require_once './conn.php';

$id = $_GET['id'];

$sql = "DELETE FROM results WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo 'Something went wrong. Try again.';
}