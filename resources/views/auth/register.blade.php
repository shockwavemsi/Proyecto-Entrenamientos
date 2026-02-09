<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Ciclistas</title>
</head>
<body>
<h1>Registro de Ciclistas</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label>Apellidos:</label>
        <input type="text" name="apellidos" required>
    </div>
    <div>
        <label>Correo:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label>Confirmar contraseña:</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <div>
        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required>
    </div>
    <div>
        <label>Peso (kg):</label>
        <input type="number" step="0.1" name="peso_base" required>
    </div>
    <div>
        <label>Altura (cm):</label>
        <input type="number" name="altura_base" required>
    </div>
    <button type="submit">Registrarse</button>
</form>

<p><a href="{{ route('login') }}">Ya tengo cuenta, iniciar sesión</a></p>
</body>
</html>
