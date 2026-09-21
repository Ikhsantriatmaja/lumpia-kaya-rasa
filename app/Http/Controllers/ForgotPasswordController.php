<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Pelanggan;
use App\Models\PasswordReset;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function form()
    {
        return view('auth.forgot-password');
    }

    public function kirimOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        $admin = Admin::where('email', $email)->first();
        $pelanggan = Pelanggan::where('email', $email)->first();

        if (!$admin && !$pelanggan) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        $otp = rand(100000, 999999);

        PasswordReset::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
                'expired_at' => Carbon::now()->addMinutes(10)
            ]
        );

        Mail::raw(
            "Kode OTP Reset Password Anda: $otp",
            function ($message) use ($email) {
                $message->to($email)
                        ->subject('OTP Reset Password');
            }
        );

        return redirect()
            ->route('password.otp')
            ->with('email', $email);
    }

    public function otpForm()
    {
        return view('auth.otp');
    }

    public function verifikasiOtp(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'otp' => 'required'
        ]);

        $reset = PasswordReset::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->first();

        if (!$reset) {
            return back()->with('error', 'OTP tidak valid');
        }

        if (Carbon::now()->gt($reset->expired_at)) {
            return back()->with('error', 'OTP sudah kadaluarsa');
        }

        return redirect()->route(
            'password.reset.form',
            ['email' => $request->email]
        );
    }

    public function resetForm(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        $pelanggan = Pelanggan::where('email', $request->email)->first();

        if ($admin) {

            $admin->password = Hash::make($request->password);
            $admin->save();

            PasswordReset::where(
                'email',
                $request->email
            )->delete();

            return redirect('/login')
                ->with(
                    'success',
                    'Password admin berhasil diubah'
                );
        }

        if ($pelanggan) {

            $pelanggan->password = Hash::make($request->password);
            $pelanggan->save();

            PasswordReset::where(
                'email',
                $request->email
            )->delete();

            return redirect('/login-pelanggan')
                ->with(
                    'success',
                    'Password pelanggan berhasil diubah'
                );
        }

        return back()->with(
            'error',
            'Email tidak ditemukan'
        );
    }
}
