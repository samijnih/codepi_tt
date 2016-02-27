<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * $redirectPath is the first property which is checked by
     * \Illuminate\Foundation\Auth\RedirectsUsers::redirectPath()
     * If $redirectTo doesn't exist, '/home' will be used
     * @var string
     */
    protected $redirectPath;

    /**
     * Url to use to redirect the user after the authentication
     * If $redirectPath doesn't exist, $redirectTo will be used
     * @var string
     */
    protected $redirectTo;

    /** 
     * The login path
     * @var string
     */
    protected $loginPath;

    /** 
     * Url to use to redirect the user after his logout
     * @var string
     */
    protected $redirectAfterLogout = '/';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->redirectPath = route('admin::show::index');
        $this->loginPath    = route('admin::auth::login');
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
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
