<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreSocialUserRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    use ApiResponse;

    public function socialLogin(StoreSocialUserRequest $request)
    {
        $data = $request->validated();

        $defaults = [
            'password'          => bcrypt(Str::random(16)),
            'email_verified_at' => now(),
        ];

        $avatarPath = null;

        if ($request->avatar_path) {
            try {
                // Download the avatar image content
                $avatarContents = file_get_contents($request->avatar_path);

                $imageName = Str::slug(time()) . '.jpg';

                // Define the path to store the image
                $folder = 'uploads/profileImages';
                $path   = public_path($folder);

                // Create the directory if it does not exist
                if (! file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                // Save the image to the specified path
                file_put_contents($path . '/' . $imageName, $avatarContents);

                // Store the relative path to the image in the database
                $avatarPath = '/' . $folder . '/' . $imageName;
            } catch (\Exception $e) {
                return $this->error(['error' => 'Failed to download avatar.'], 'Something went wrong', 500);
            }
        }
        $defaults['avatar_path'] = $avatarPath;

        // Find or create user
        $user = User::firstOrCreate(
            [
                'provider'    => $data['provider'],
                'provider_id' => $data['provider_id'],
            ],
            array_merge($defaults, [
                'name'  => $data['name'] ?? 'Unknown User',
                'email' => $data['email'] ?? null,
            ])
        );

        // Create token
        $token = $user->createToken('postman')->plainTextToken;

        return $this->success([
            'user'       => $user,
            'token'      => $token,
            'token_type' => 'Bearer',
        ], 'Login successful');
    }
}
