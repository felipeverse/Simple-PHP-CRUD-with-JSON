<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function getUsers ()
{
    $json = json_decode(file_get_contents(__DIR__ . '/users.json'), true); 
    return $json['users'];
}

function getLastId()
{
    $json = json_decode(file_get_contents(__DIR__ . '/users.json'), true); 
    return $json['lastId'];
}

function getUserById ($id)
{
    $users = getUsers();    
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }

    return null;
}

function createUser ($newUser)
{
    $newUser['id'] = getLastId() + 1;
    
    $users = getUsers();
    $users[] = $newUser;

    $json['lastId'] = $newUser['id'];
    $json['users'] = $users;

    putJson($json);

    return $newUser;
}

function updateUser ($data, $id)
{
    $updateUser = [];
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = $updateUser = array_merge($user, $data);
        }
    }

    $json['lastId'] = getLastId();
    $json['users'] = $users;

    putJson($json);

    return $updateUser;
}

function deleteUser ($id)
{
    $users = getUsers();

    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            array_splice($users, $i, 1);
        }
    }

    $json['lastId'] = getLastId();
    $json['users'] = $users;

    putJson($json);
}

function uploadImage($file, $user)
{
    if (!is_dir(__DIR__ . "/users/images")) {
        mkdir(__DIR__ . "/images");
    }

    // Get the file extension from the filename
    $fileName = $file['name'];
    // Search for the dot in the filename
    $dotPosition = strpos($fileName, '.');
    // Take the substring from the dot position fill the end of the string
    $extension = substr($fileName, $dotPosition + 1);

    move_uploaded_file($file['tmp_name'], __DIR__ . "/images/{$user['id']}.$extension");

    $user['extension'] = $extension;

    updateUser($user, $user['id']);
    
}

function putJson($json)
{
    file_put_contents(__DIR__ . "/users.json", json_encode($json, JSON_PRETTY_PRINT));
}

function validateUser($user, &$errors) {
    $isValid = true;
    
    if (!$user['name']) {
        $isValid = false;
        $errors['name'] = 'Name is mandatory.';
    }

    if (!$user['username'] || strlen($user['username']) < 5 || strlen($user['username']) > 16) {
        $isValid = false;
        $errors['username'] = 'Username is required and it must be more than 5 and less than 16 characters.';
    }

    if ($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'This must be a valid email address.';
    }

    if ($user['website'] && !filter_var($user['website'], FILTER_VALIDATE_DOMAIN)) {
        $isValid = false;
        $errors['website'] = 'This must be a valida website.';
    }

    return $isValid;
}