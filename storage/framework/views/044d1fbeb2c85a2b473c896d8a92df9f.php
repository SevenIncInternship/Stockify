<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Login Section -->
<section class="d-flex justify-content-center align-items-center min-vh-100 bg-lightgray">
  <div class="card shadow p-4" style="width: 400px;">
    <h2 class="text-center mb-4">Daftar</h2>
    <div class="text-center mb-3">
      <img src="assets/images/login.png" alt="Login Image" style="width: 150px;">
    </div>
    
    <form action="/login" method="post">
      <?php echo csrf_field(); ?>
      <div class="mb-3">
        <input type="text" name="fullName" class="form-control" placeholder="Full Name" required>
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Remember me
          </label>
        </div>
        <div class="text-end">
        <a href="/forgot-password"> Lupa Password</a>
      </div>
      </div>
      <div class="d-grid mt-2">
        <button type="submit" class="btn btn-primary">Login</button>  
    </div>
    <div>
      <p class="text-center mt-3">Belum Punya Akun? <a href="/register">Daftar</a></p>
    </div>
    </form>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\KULIAH\KP\REPO\Stockify\Stockify\resources\views/daftar.blade.php ENDPATH**/ ?>