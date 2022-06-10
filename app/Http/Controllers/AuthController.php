<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\RegistrationEmailNotification;
use Carbon\Carbon;
use PDOException;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('front.auth.login');
    }

    public function loginProcess()
    {
        $validator = Validator::make(request()->all(), [
           
            'email'        => 'required|email',
            'password'     => 'required|min:6',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials=request()->only(['email','password']);


        if(auth()->attempt($credentials)){
            if( auth()->user()->email_verification_token == null){
                $this->setSuccess('user logged in');  
                return redirect()->route('cart.show');
            } else {
                
                $this->setError('account is not activated');
                return redirect()->route('login');
            }

        }

        $this->setError('invalid email/pass');
        return redirect()->back();

    }

    public function registerForm()
    {
        return view('front.auth.register');
    }

    public function registerProcess()
    {
        // dd($request->all());
        $validator = Validator::make(request()->all(), [

            'name'         => 'required',
            'email'        => 'required|email',
            'phone_number' => 'required|min:11',
            'password'     => 'required|min:6',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        try {
            
            $user = User::create([
                'name'          => request()->input('name'),
                'email'         => request()->input('email'),
                'phone_number'  => request()->input('phone_number'),
                'password'      => bcrypt(request()->input('password')),
                'email_verification_token' => time().request()->input('email').Str::random(40),
            ]);

            $user->notify(new RegistrationEmailNotification($user));

            session()->flash('type', 'success');
            session()->flash('message', 'account successfully registered');

            return redirect()->route('login');
        } catch (\Exception $e) { //(exception $e) dile j kono ecxception e dhorbe
            session()->flash('type', 'wearning');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }
    public function activate(Request $token)
    {
        dd($token);
        if ($token == null) {
            return redirect()->route('/');
        }

        $user = User::where('email_verification_token', $token)->firstOrFail();
      
        if ($user) {
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null,
            ]);
            $this->setSuccess('account has activited.u can login now'); //session er message er helper jeta controller e likha ace
            return redirect()->route('login');
        }

        $this->setSuccess('account not found'); 
        return redirect()->route('login');
    }
    
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
