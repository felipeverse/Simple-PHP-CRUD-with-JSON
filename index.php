<?php
require __DIR__ .'/users/users.php';

$users = getUsers();

include "partials/header.php";
?>
    <div class="container">
        <p>
            <a class="btn btn-success" href="create.php"><i class="bi bi-plus"></i> Create new User</a>
        </p>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php if (count($users) > 0) : ?>
                <tbody>
                    <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="align-middle">
                                    <?php if (isset($user['extension'])): ?>
                                        <img style="width: 60px; height: 60px; border-radius: 50%" src="<?php echo "/users/images/{$user['id']}.{$user['extension']}" ?>" alt="Imagem de perfil de <?php echo $user['name']; ?>">
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle"><?php echo $user['name'] ?></td>
                                <td class="align-middle"><?php echo $user['username'] ?></td>
                                <td class="align-middle"><?php echo $user['email'] ?></td>
                                <td class="align-middle">
                                    <?php if ($user['website']): ?>
                                        <?php if (filter_var($user['website'], FILTER_VALIDATE_URL)) : ?>
                                            <a target="_blank" href="<?php echo $user['website'] ?>">
                                                Website
                                            </a>
                                        <?php else : ?>
                                            <a target="_blank" href="http://<?php echo $user['website'] ?>">
                                                Website
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>  
                                </td>
                                <td class="d-inline-flex">
                                    
                                    <a href="view.php?id=<?php echo $user['id'] ?>" class="mx-1 btn btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="update.php?id=<?php echo $user['id'] ?>" class="mx-1 btn btn-outline-secondary">
                                        <i class="bi bi-pencil-square">
                                        </i>
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger deleteModalButton" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $user['id'] ?>">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php else : ?>
                <tr>
                    <td colspan="7">No users found.</td>
                </tr>
            <?php endif; ?>
        </table>

        <?php include "_deleteModal.php"; ?>
        

    </div>

    <?php include "partials/footer.php"; ?>