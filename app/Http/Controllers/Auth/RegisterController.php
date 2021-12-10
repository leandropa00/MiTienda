<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'clave'  => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string'   => 'El nombre debe ser un texto',
            'nombre.max'      => 'El nombre supera la longitud permitida',
            'correo.required' => 'El correo es requerido',
            'correo.string'   => 'El correo debe ser un texto',
            'correo.email'    => 'El correo es inválido',
            'correo.max'      => 'El correo supera la longitud permitida',
            'correo.unique'   => 'El correo ya fue registrado anteriormente',
            'clave.required'  => 'La contraseña es requerida',
            'clave.string'    => 'La contraseña debe ser un texto',
            'clave.min'       => 'La contraseña debe tener al menos 8 caracteres',
            'clave.confirmed' => 'Las contraseñas no coinciden',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'clave'  => Hash::make($data['clave']),
        ]);
    }
}
