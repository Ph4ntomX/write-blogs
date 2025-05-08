<!DOCTYPE html>
<html>
<?php
    require "lib/head.php";
    verifyUserLoggedIn();

    $database = connectDatabase();
    $sql = "SELECT * FROM users";
    $statement = $database->query($sql);
    $users = $statement->fetchAll();
?>

  <body>
    <div class="container mx-auto my-5" style="max-width: 700px;">

    <?php require "lib/important_message.php"; ?>

      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Users</h1>
        <div class="text-end">
          <a href="/manage/users/add" class="btn btn-primary btn-sm"
            >Add New User</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($users as $user) : ?>
            <tr>
              <th scope="row"><?= $user["id"]; ?></th>
              <td><?= $user["name"]; ?></td>
              <td><?= $user["email"]; ?></td>
              <td><span class="badge bg-<?= $user["role"] == "admin" ? "primary" : ($user["role"] == "editor" ? "info" : "success"); ?>"><?= $user["role"]; ?></span></td>
              <td class="text-end">
              <?php if (isEditor() && userHasHigherRole($user["role"]) && $_SESSION["user"]["id"] !== $user["id"]) : ?>
                <div class="buttons">
                <form action="/manage/users/edit" method="GET" class="d-inline">
                      <input type="hidden" name="id" value="<?= $user["id"]; ?>">
                      <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-pencil"></i>
                      </button>
                </form>

                <form action="/manage/users/change-password" method="GET" class="d-inline ms-2">
                      <input type="hidden" name="id" value="<?= $user["id"]; ?>">
                      <button type="submit" class="btn btn-warning btn-sm">
                        <i class="bi bi-key"></i>
                      </button>
                </form>

                <?php if(isAdmin()) : ?>
                <form action="/manage/users/do_delete" method="POST" class="d-inline ms-2">
                      <input type="hidden" name="id" value="<?= $user["id"]; ?>">
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                      </button>
                </form>
                <?php endif; ?>
                </div>
                
            <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
