<?php

  namespace App\Http\Controllers\Accounts\Users\Auth;

  use App\Http\Controllers\Accounts\AuthTraits\AuthenticatesUsers;
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use Illuminate\Http\Response;

  class LoginController extends Controller
  {

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function showLoginForm() {
      return view('user.auth.login');
    }

    public function login(Request $request) {
      $this->validateLogin($request);
      if (method_exists($this, 'hasTooManyLoginAttempts') &&
        $this->hasTooManyLoginAttempts($request)) {
          //$this->generateFailedAttemptsReport($request, Admin::class);
        $this->fireLockoutEvent($request);
        return $this->sendLockoutResponse($request);
      }
      //$this->logoutAllPreexistingLogins();
      if ($this->attemptLogin($request)) {
          auth('user')->user()->generateLoginActivity();
        return $this->sendLoginResponse($request);
      }
      $this->incrementLoginAttempts($request);
      return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request) {
      if ($this->userIsApproved()) {
        return auth('user')->attempt(
          $this->credentials($request), $request->filled('remember')
        );
      }
    }
      protected function sendLoginResponse(Request $request)
      {
          $request->session()->regenerate();

          $this->clearLoginAttempts($request);

          if ($response = $this->authenticated($request, $this->guard()->user())) {
              return $response;
          }
          return $request->wantsJson()
              ? new Response('', 204)
              : redirect()->route('user_dashboard');
      }

      public function logout(Request $request) {
          auth()->guard('user')->logout();
          $request->session()->invalidate();

          $request->session()->regenerateToken();
          if ($response = $this->loggedOut($request)) {
              return $response;
          }

          return $request->wantsJson()
              ? new Response('', 204)
              : redirect()->route('landing');
      }
  }
