<?php

namespace App\Http\Controllers;

use App\Http\Requests\Avatar\StoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = $request->user();

            $user->fill($request->validated());

            $avatar = $user->savedAvatars->first();
            $user->avatar_id = $avatar->id;

            $avatarsDelete = $user->avatars()->whereNot('id', $avatar->id)->get();

            foreach ($avatarsDelete as $avatarDelete) {
                $avatarDelete->delete();
            }

            $avatar->update(['status' => 1]);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            DB::commit();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $exception) {
            DB::rollBack();

            return Redirect::back()->with(['message' => $exception->getMessage()]);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function avatarStore(StoreRequest $request): RedirectResponse
    {
        foreach ($request->user()->savedAvatars as $oldAvatar) {
            $oldAvatar->delete();
        }

        $path = Storage::disk('public')->put('/avatars', $request['avatar']);

        Avatar::create([
            'path' => $path,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('status', 'avatar-changed');
    }

    /**
     * @return RedirectResponse
     */
    public function avatarDelete(): RedirectResponse
    {
        $user = auth()->user();

        foreach ($user->avatars as $avatar) {
            Storage::disk('public')->delete($avatar->path);
            $avatar->delete();
        }

        $user->update(['avatar_id' => null]);

        return redirect()->back()->with('status', 'avatar-changed');
    }
}
