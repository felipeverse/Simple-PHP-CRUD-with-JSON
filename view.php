<?php
include "partials/header.php";
require __DIR__ . "/users/users.php";

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
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><b>View user:</b> <?php echo $user['name']?></h3>
        </div>   
        <div class="card-body">
            <?php if($user['extension']): ?>
                <img style="width: 100px; height: 100px; border-radius: 50%" class="mx-2" src="users/images/<?php echo $user['id'] . '.' . $user['extension']; ?>" alt="">
            <?php endif; ?>
            <a class="btn btn-secondary" href="update.php?id=<?php echo $user['id'] ?>">Update</a>
            <form style="display: inline-block;" method="POST" action="delete.php">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <button type="button" class="btn btn-outline-danger deleteModalButton" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $user['id'] ?>">
                    Delete
                </button>
            </form>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $user['name'] ?></td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td><?php echo $user['username'] ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $user['email'] ?></td>
                </tr>
                <tr>
                    <th>Website:</th>
                    <td>
                        <a target="_blank" href="http://<?php echo $user['website'] ?>">
                            <?php echo $user['website'] ?>
                        </a>   
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="card-body">
            <a class="btn btn-primary align-self-end" href="index.php">Voltar</a>
        </div>
    </div>
</div>

<?php include "_deleteModal.php"; ?>

<?php include "partials/footer.php"; ?>