<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
        ];

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $extension = strtolower($avatar->getClientOriginalExtension());
            $filename = uniqid('avatar_') . '.' . $extension;
            $path = 'avatars/' . $filename;

            $avatarContents = file_get_contents($avatar->getRealPath());
            $sourceImage = imagecreatefromstring($avatarContents);

            if ($sourceImage !== false) {
                $width = imagesx($sourceImage);
                $height = imagesy($sourceImage);
                $squareSize = min($width, $height);
                $destImage = imagecreatetruecolor(500, 500);

                imagealphablending($destImage, false);
                imagesavealpha($destImage, true);
                $transparent = imagecolorallocatealpha($destImage, 0, 0, 0, 127);
                imagefilledrectangle($destImage, 0, 0, 500, 500, $transparent);

                $srcX = $width > $height ? intval(($width - $height) / 2) : 0;
                $srcY = $height > $width ? intval(($height - $width) / 2) : 0;

                imagecopyresampled(
                    $destImage,
                    $sourceImage,
                    0,
                    0,
                    $srcX,
                    $srcY,
                    500,
                    500,
                    $squareSize,
                    $squareSize
                );

                ob_start();
                switch ($extension) {
                    case 'png':
                        imagepng($destImage);
                        break;
                    case 'gif':
                        imagegif($destImage);
                        break;
                    case 'webp':
                        imagewebp($destImage);
                        break;
                    default:
                        imagejpeg($destImage, null, 90);
                        break;
                }
                $resizedContents = ob_get_clean();

                imagedestroy($sourceImage);
                imagedestroy($destImage);

                Storage::disk('public')->put($path, $resizedContents);
                $data['avatar'] = $path;
            } else {
                $data['avatar'] = $avatar->store('avatars', 'public');
            }
        }

        $user->update($data);

        if ($request->filled('address')) {
            $address = $user->addresses()->where('is_default', true)->first();
            if ($address) {
                $address->update(['line_one' => $request->address]);
            } else {
                $user->addresses()->create([
                    'line_one' => $request->address,
                    'is_default' => true,
                    'label' => 'Utama',
                    'recipient_name' => $request->name,
                    'phone' => $request->phone,
                    'city' => '-',
                    'state' => '-',
                    'postal_code' => '-',
                    'country' => 'Indonesia',
                    'type' => 'shipping',
                ]);
            }
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
