<?php
require __DIR__ . '/users/users.php';

$user = [
    'name' => '',
    'username' => '',
    'email' => '',
    'website' => ''
];

$errors = [
    'name' => '',
    'username' => '',
    'email' => '',
    'website' => '',
];

$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user = array_merge($user, $_POST);

    $isValid = validateUser($user, $errors);

    if ($isValid) {
        $user = createUser($_POST);

        if (isset($_FILES['picture'])) {
            uploadImage($_FILES['picture'], $user);
        }
        
        header("Location: index.php");  
    }
}
?>

<?php include 'partials/header.php' ?>

    <?php include '_form.php' ?>

<?php include 'partials/footer.php' ?>