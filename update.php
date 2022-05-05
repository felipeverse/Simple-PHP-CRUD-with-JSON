<?php
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
    include "partials/not_found.php";
    exit;
}

$userId = $_GET['id'];

$user = getUserById($userId);

if (!$user) {
    include "partials/not_found.php";
    exit;
}

$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = array_merge($user, $_POST);
    
    $isValid = validateUser($user, $errors);

    if ($isValid) {
        updateUser($_POST, $userId);

        if (isset($_FILES['picture'])) {
            uploadImage($_FILES['picture'], $user);
        }
    
        header('Location: index.php');
    }
}
?>


<?php include 'partials/header.php' ?>

    <?php include '_form.php'; ?>

<?php include "partials/footer.php"; ?>