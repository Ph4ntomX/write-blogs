<!DOCTYPE html>
<html>
<?php require "lib/head.php"; ?>
<?php
    $database = connectDatabase();
    
    $posts = getPosts($database);

    $posts = array_filter(array_reverse($posts), function($post) {
        return $post["status"] == "publish";
    });
?>
  <body>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      
      <h1 class="h1 text-center mb-4">MUST READ BLOGS</h1>

      <?php require "lib/important_message.php"; ?>

      <?php foreach($posts as $post) : ?>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?= $post["title"]; ?></h5>
          <p class="card-text"><?= substr($post["content"], 0, 25); ?>...</p>
          <div class="text-end">
            <a href="/post?id=<?= $post["id"]; ?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

      <?php if(!isset($_SESSION["user"])) { ?>
        <div class="mt-4 d-flex justify-content-center gap-3">
          <a href="/login" class="btn btn-link btn-sm">Login</a>
          <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
        </div>
      <?php } else { ?>
        <div class="mt-4 d-flex justify-content-center gap-3">
          <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
          <a href="/logout" class="btn btn-link btn-sm">Logout</a>
        </div>
      <?php } ?>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
