<?php

namespace App\Http\Controllers\Admin;
use App\Models\Api\User;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->redirectTo = getAdminPanelUrl();
    }

    public function showLoginForm()
    {
        $data = [
            'pageTitle' => trans('auth.login'),
        ];


        return view('admin.auth.login', $data);
    }

    /**
     * Check either username or email.
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Validate the user login.
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
                'email' => 'required|email|exists:users,email,status,active',
                'password' => 'required|min:4',
            ]
        );
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $request->session()->put('login_error', trans('auth.failed'));
        throw ValidationException::withMessages(
            [
                'error' => [trans('auth.failed')],
            ]
        );
    }

   public function login(Request $request)
    {
        // dd($request->get('referral_code', null));

        $rules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4',
        ];

        if (!empty(getGeneralSecuritySettings('captcha_for_admin_login'))) {
            $rules['captcha'] = 'required|captcha';
        }
        // validate the form data
        $this->validate($request, $rules);
        $user = User::where('email', $request->email)->first();
        if ($user->status == 'active') {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                 if (Auth::user()->role_id == 4 || Auth::user()->role_id == 1) {
                     return Redirect::to(env('APP_URL') . '/panel');
                } elseif (Auth::user()->role_id == 2) {
                     return Redirect::to(env('APP_URL') . '/admin');
                } else {
                    // لأي role أخرى يمكن توجيهها إلى الصفحة الافتراضية
                     return Redirect::to(env('APP_URL'));
                }
            } else {
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                    'password' => 'Wrong password or this account not approved yet.',
                ]);
            }
        } elseif($user->status == 'pending') {

            $verificationController = new VerificationController();
            $checkConfirmed = $verificationController->checkConfirmed($user, 'email', $request->email);
            $referralCode = $request->get('referral_code', null);
            if ($checkConfirmed['status'] == 'send') {

                return redirect('/verification');
            }

        }
    }



    // public function login(Request $request)
    // {
    //     $rules = [
    //         'email' => 'required|email|exists:users,email,status,active',
    //         'password' => 'required|min:4',
    //     ];

    //     if (!empty(getGeneralSecuritySettings('captcha_for_admin_login'))) {
    //         $rules['captcha'] = 'required|captcha';
    //     }

    //     // validate the form data
    //     $this->validate($request, $rules);

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    //         return Redirect::to(getAdminPanelUrl());
    //     }

    //     return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
    //         'password' => 'Wrong password or this account not approved yet.',
    //     ]);
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(getAdminPanelUrl() . '/login');
    }
}
