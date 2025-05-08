<!DOCTYPE html>
<html>
<?php
    require "lib/head.php";
    verifyUserLoggedIn();

    $database = connectDatabase();
    
    $id = $_GET["id"] ?? "";

    if(empty($id)) {
        $_SESSION["error"] = "User not found";
        header("Location: /manage/users");
        exit;
    }

    $user = getUserById($id);

    if(!$user) {
        $_SESSION["error"] = "User not found";
        header("Location: /manage/users");
        exit;
    }

    $name = $user["name"];
    $email = $user["email"];
    $role = $user["role"];
?>

  <body>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit User</h1>
      </div>
      <?php require "lib/important_message.php"; ?>
      <div class="card mb-2 p-4">
        <form method="POST" action="/manage/users/do_edit">
          <input type="hidden" name="id" value="<?= $id; ?>">
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>" />
              </div>
              <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" />
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role">
              <option value="">Select an option</option>
              <option value="user" <?= $role == "user" ? "selected" : "" ?>>User</option>
              <option value="editor" <?= $role == "editor" ? "selected" : "" ?>>Editor</option>
              <option value="admin" <?= $role == "admin" ? "selected" : "" ?>>Admin</option>
            </select>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage/users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
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
