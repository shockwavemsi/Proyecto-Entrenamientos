<?php
namespace App\Http\Controllers; // importante para que extienda de ahi

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ciclista;

class CiclistaController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request) // el request es lo que envia el usuario, es un objeto
    {
        $ciclista = Ciclista::where('email', $request->email)->first(); // se convierte en un objeto con los datos de la consulta

        if ($ciclista && $ciclista->password === $request->password) {
            Auth::login($ciclista);
            return redirect('/bienvenida');
        }

        return back()->with('error', 'Correo o contraseña incorrectos');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // son funciones del auth del modelo, investigarlo?
    }

    public function showBienvenida()
    {
        return view('bienvenida');
    }

    public function linkCiclista()
    {
        return view('ciclista');
    }

    // Mostrar formulario
    public function registerForm()
    {
        return view('/register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:80',
            'apellidos' => 'required|string|max:80',
            'email' => 'required|email|unique:ciclista,email',
            'password' => 'required|string|min:4|confirmed', // confirmed para password_confirmation
            'fecha_nacimiento' => 'required|date',
            'peso_base' => 'required|numeric',
            'altura_base' => 'required|integer',
        ]);

        // Crear ciclista
        Ciclista::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => $request->password, // ¿hash?
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'peso_base' => $request->peso_base,
            'altura_base' => $request->altura_base,
        ]);

        // Redirigir a login
        return redirect('/login')->with('success', 'Cuenta creada correctamente. ¡Puedes iniciar sesión!');
    }
}

