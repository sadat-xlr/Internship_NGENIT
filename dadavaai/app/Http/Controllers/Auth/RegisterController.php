<?php

namespace App\Http\Controllers\Auth;

use Spatie\Permission\Models\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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
    protected $redirectTo = '/admin-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('auth');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function addUser(Request $data)
    {
        
        
        $user = New User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        $user->remember_token = $data->_token;
        $user->save();

        // Send the mail
        Mail::send([], [], function($message) use ($user,$data) {
            
            $message->from('dadavaai.world@gmail.com');
            $message->to($user->email);
            $message->subject('Welcome to dadavaai team');
            $message->setBody('Dear '.$user->name.', Welcome to dadavaai admin panel. Your password is :'.$data->password, 'text/html');
        });

        // $role = Role::create(['name' => 'super admin']);
        // $user->assignRole($role);

        // return redirect('/admin-dashboard');
        return redirect()->back();

    }


}
