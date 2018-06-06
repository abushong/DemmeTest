<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /**
     * Redirect the user to the GitHub authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $authUser = User::firstOrNew(['name'=>$user->name]);

        $authUser->name = $user->name;
        $authUser->email = $user->email;
        $authUser->password = 'password';

        $authUser->save();

        auth()->login($authUser);

        //$authUser = $this->findOrCreateUser($user);
        //Auth:login($authUser, true);

        return redirect($this->redirectTo);
        // $user->token;
    }

    public function findOrCreateUser($user){
        $authUser = User::where($user->name)->first();

        if($authUser){
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email
        ]);
    }
}
