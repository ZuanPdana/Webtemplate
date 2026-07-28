<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
        ]);

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
