<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Carbon\Carbon;
use App\User;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarContrasenia;
use Illuminate\Support\Facades\Hash;
use Dotenv\Validator;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function index(){
        return view('auth.passwords.reset');
    }

    public function resetPassword(){

        Request()->validate([
            'email' => 'required|exists:users'
        ],[
            'email.required'=>'Ingresa una dirección de correo',   
            'email.exists' => 'El correo no existe.',
        ]);

            $contador = User::where('email','=' ,Request('email'))->count();
             
            if($contador>0){
               $user = User::where('email','=',Request('email'))->first();
               $current = Carbon::now();
               $current = new Carbon();
               $password = $current->toDateTimeString().''.$user->email;
               $password = Hash::make($password);
               $user->password = Hash::make($password);
               $user->save();

               Mail::to('1530438@upv.edu.mx')->queue(new RecuperarContrasenia($user,$password));
               return 'se ha enviado un correo con la nueva contraseña';
            }
    }
}
