<?php
namespace App\Http\Controllers\Api\Auth;

use App\Helpers\OtpHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use ApiResponse;

    public function register(StoreUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);
        if ($user) {
            return OtpHelper::sendEmailOtp($user->email, 'register');
        }

        return $this->error(null, 'Failed to register user', 500);
    }

    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation failed', 422);
        }

        return OtpHelper::sendEmailOtp($request->email, 'register');
    }

    public function verifyRegisterOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation failed', 422);
        }

        $cacheKey  = 'user_otp_' . $request->email;
        $cachedOtp = Cache::get($cacheKey);

        if (! $cachedOtp || $cachedOtp != $request->otp) {
            return $this->error(null, 'OTP expired or invalid!', 400);
        }

        User::where('email', $request->email)->update([
            'email_verified_at' => now(),
        ]);

        Cache::forget($cacheKey);

        return $this->success([], 'Email verified successfully!');
    }
}
