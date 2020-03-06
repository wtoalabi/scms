<?php
  
  namespace App\Http\Controllers\Accounts\Users\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Platform\Accounts\Users\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;
  
  protected $redirectTo = '/';
  
  public function __construct() {
    $this->middleware('guest');
  }
    
  public function register(Request $request) {
    $validatedData = $this->validator($request->all())->validate();
    $user = $this->create($validatedData);
    $this->guard()->login($user);
    
    return redirect()->intended();
  }
  
  protected function validator(array $data) {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }
    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
  public function showRegistrationForm()
  {
    return view('user.auth.register');
  }
  
}