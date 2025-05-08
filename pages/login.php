<!DOCTYPE html>
<html>
<?php require "lib/head.php"; ?>
  <body>
    <div class="container my-5 mx-auto" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">Login</h1>

      <div class="card p-4">
        <?php require "lib/important_message.php"; ?>
        
        <form method="POST" action="/auth/login">
          <div class="mb-2">
            <label for="email" class="visually-hidden">Email</label>
            <input
              type="text"
              class="form-control"
              id="email"
              name="email"
              placeholder="email@example.com"
            />
          </div>
          <div class="mb-2">
            <label for="password" class="visually-hidden">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Password"
            />
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>

      <!-- links -->
      <div
        class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
      >
        <a href="/" class="text-decoration-none small"
          ><i class="bi bi-arrow-left-circle"></i> Go back</a
        >
        <a href="/signup" class="text-decoration-none small"
          >Don't have an account? Sign up here
          <i class="bi bi-arrow-right-circle"></i
        ></a>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
