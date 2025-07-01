<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Reset Password Section -->
<section class="d-flex justify-content-center align-items-center min-vh-100 bg-lightgray">
  <div class="card shadow p-4" style="width: 400px;">
     <div class="mb-2">
        <button type="button" onclick="history.back()" class="btn btn-outline-primary btn-sm"aria-disabled>
            Back
        </button>
    </div>
    <h2 class="text-center mb-4">Reset Password</h2>
    <div class="text-center mb-3">
      <img src="assets/images/login.png" alt="Logo" style="width: 150px;">
    </div>
    
    <form action="/login" method="post">
      @csrf
      <div class="mb-3 d-flex justify-content-center text-center ">
        <p>Masukkan email yang terdaftar, kami akan mengirimkan link untuk mereset password</p>
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="d-grid mt-4 mb-3">
        <button type="submit" class="btn btn-primary">Kirim</button>  
    </div>
    </form>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>