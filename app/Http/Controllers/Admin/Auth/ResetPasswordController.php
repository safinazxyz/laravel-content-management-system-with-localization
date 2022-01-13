<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showResetForm($token = null)
    {
        return view('admin.auth.admin_reset_password')->with(
            ['token' => $token]
        );
    }
    public function reset(ResetPasswordRequest $request)
    {

        $response = $this->broker()->reset(
            $this->credentials($request), function ($admin, $password) {
            $this->resetPassword($admin, $password);
        }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    protected function resetPassword($admin, $password)
    {
        $this->setUserPassword($admin, $password);

        $admin->setRememberToken(Str::random(60));

        $admin->save();
    }

    protected function setUserPassword($admin, $password)
    {
        $admin->password = Hash::make($password);
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    protected function sendResetResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return new JsonResponse(['message' => trans($response)], 200);
        }
        return redirect()->route('admin.login')->with('success_message', trans($response));
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
                'response' => '*Email or Reset Link is not correct!',
            ]);
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

}
