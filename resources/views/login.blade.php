<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/css/bootstrap.min.css">
  <title>Login</title>
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width:400px">
  <div class="card">
    <div class="card-header text-center"><strong>Iniciar sesión</strong></div>
    <div class="card-body">
      <form method="POST" action="{{ url('login') }}">
        @csrf
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        @error('email')<div class="text-danger mb-2">{{ $message }}</div>@enderror
        <button class="btn btn-primary btn-block">Entrar</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
