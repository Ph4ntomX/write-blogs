<!DOCTYPE html>
<html>
<?php require "lib/head.php"; ?>
<?php
    $database = connectDatabase();
    $posts = getPosts($database);

    if(!isEditor()) {
      $posts = array_filter($posts, function($post) {
        return $post["user_id"] === $_SESSION["user"]["id"];
      });
    }
?>

  <body>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <?php require "lib/important_message.php"; ?>
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/manage/posts/add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($posts as $post) : ?>
            <tr>
              <th scope="row"><?= $post["id"]; ?></th>
              <td><?= $post["title"]; ?></td>
              <?php if($post["status"] == "pending") : ?>
                <td><span class="badge bg-warning">Pending Review</span></td>
              <?php else : ?>
                <td><span class="badge bg-success">Published</span></td>
              <?php endif; ?>
              <td class="text-end">
                <div class="buttons">
                  <a href="/post?id=<?= $post["id"]; ?>" target="_blank" class="btn btn-primary btn-sm me-2 <?php if($post["status"] == "pending") : ?>disabled<?php endif; ?>">
                    <i class="bi bi-eye"></i>
                  </a>
                  <form action="/manage/posts/edit" method="GET" class="d-inline">
                    <input type="hidden" name="id" value="<?= $post["id"]; ?>">
                    <button type="submit" class="btn btn-secondary btn-sm me-2">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </form>
                  <form action="/manage/posts/do_delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= $post["id"]; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
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
