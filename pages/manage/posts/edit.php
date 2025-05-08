<!DOCTYPE html>
<html>
<?php require "lib/head.php"; ?>
<?php
    $database = connectDatabase();
    
    $id = $_GET["id"] ?? "";

    if(empty($id)) {
        $_SESSION["error"] = "Post not found";
        header("Location: /manage/posts");
        exit;
    }

    $post = getPostById($id);

    if(!$post) {
        $_SESSION["error"] = "Post not found";
        header("Location: /manage/posts");
        exit;
    }
?>

  <body>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <?php require "lib/important_message.php"; ?>
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/manage/posts/do_edit">
          <input type="hidden" name="id" value="<?= $post["id"]; ?>">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input
              type="text"
              name="post-title"
              class="form-control"
              id="post-title"
              value="<?= $post["title"]; ?>"
            />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea class="form-control" id="post-content" rows="10" name="post-content"><?= $post["content"]; ?></textarea>
          </div>

          <?php if(isAdmin()) : ?>
            <div class="mb-3">
              <label for="post-status" class="form-label">Status</label>
              <select class="form-control" id="post-status" name="post-status">
                <option value="pending" <?= $post["status"] == "pending" ? "selected" : "" ?>>Pending for Review</option>
                <option value="publish" <?= $post["status"] == "publish" ? "selected" : "" ?>>Publish</option>
              </select>
            </div>
          <?php else : ?>
            <input type="hidden" name="post-status" value="pending">
          <?php endif; ?>
          
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage/posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
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
