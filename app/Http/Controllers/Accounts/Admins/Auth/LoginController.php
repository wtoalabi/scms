<?php

  namespace App\Http\Controllers\Accounts\Admins\Auth;

  use App\Http\Controllers\Accounts\AuthTraits\AuthenticatesUsers;
  use App\Http\Controllers\Controller;
  use App\Platform\Accounts\Admins\Admin;
  use Illuminate\Http\Request;
  use Illuminate\Http\Response;

  class LoginController extends Controller
  {

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function showLoginForm() {
      return view('admin.auth.login');
    }

    public function login(Request $request) {
      $this->validateLogin($request);
      if (method_exists($this, 'hasTooManyLoginAttempts') &&
        $this->hasTooManyLoginAttempts($request)) {
          $this->generateFailedAttemptsReport($request, Admin::class);
        $this->fireLockoutEvent($request);
        return $this->sendLockoutResponse($request);
      }
      //$this->logoutAllPreexistingLogins();
      if ($this->attemptLogin($request)) {
          auth('admin')->user()->generateLoginActivity();
        return $this->sendLoginResponse($request);
      }
      $this->incrementLoginAttempts($request);
      return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request) {
      if ($this->adminIsApproved()) {
        return auth('admin')->attempt(
          $this->credentials($request), $request->filled('remember')
        );
      }
    }

      public function logout(Request $request) {
          $this->guard()->logout();

          $request->session()->invalidate();

          $request->session()->regenerateToken();
          if ($response = $this->loggedOut($request)) {
              return $response;
          }

          return $request->wantsJson()
              ? new Response('', 204)
              : redirect()->route('admin_login');
    }
  }
