<?php
require __DIR__ . '/users/users.php';

if (!isset($_POST['id'])) {
    include "partials/not_found.php";
    exit;
}

$userId = $_POST['id'];

$user = getUserById($userId);
if (!$user) {
    include "partials/not_found.php";
    exit;
}

deleteUser($userId);

header('Location: index.php');
?>