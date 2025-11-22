<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            if ($user->status === 'inactive') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.']);
            }

            // Log login activity (optional - có thể tạo bảng activity_logs)
            \Log::info('User logged in', ['user_id' => $user->id, 'email' => $user->email]);

            return redirect()->intended($this->redirectTo())->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput($request->only('email'));
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
        ]);

        try {
            \DB::beginTransaction();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'patient',
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'status' => 'active',
            ]);

            Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
            ]);

            \DB::commit();

            Auth::login($user);

            return redirect()->route('patient.dashboard')->with('success', 'Đăng ký thành công! Chào mừng bạn đến với hệ thống.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi đăng ký. Vui lòng thử lại.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kiểm tra email có tồn tại trong database
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email này chưa được đăng ký trong hệ thống.']);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            \Log::info('Password reset link sent', ['email' => $request->email]);
            return back()->with(['status' => 'Chúng tôi đã gửi link đặt lại mật khẩu đến email của bạn. Vui lòng kiểm tra hộp thư.']);
        }

        return back()->withErrors(['email' => 'Không thể gửi email. Vui lòng thử lại sau.']);
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                // Log password reset activity
                \Log::info('Password reset successful', ['user_id' => $user->id, 'email' => $user->email]);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Bạn có thể đăng nhập với mật khẩu mới.');
        }

        return back()->withErrors(['email' => 'Token không hợp lệ hoặc đã hết hạn. Vui lòng yêu cầu đặt lại mật khẩu mới.'])->withInput($request->only('email'));
    }

    protected function redirectTo()
    {
        $user = Auth::user();
        
        // Admin redirect về dashboard quản lý
        if ($user->isAdmin()) {
            return route('admin.dashboard');
        }
        
        // Các role khác redirect về trang chủ
        return route('welcome');
    }
}

