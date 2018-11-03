<?php

namespace App\Http\Controllers\Account;

use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class SettingsController extends Controller
{
    public function index() {
        $user = $this->user;

        return view('user.settings.settings', compact('user'));
    }

    public function store(Request $request) {
        $this->user->update($request->except(['_token']));

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->route('user.settings.index');
    }

    public function updateAvatar(Request $request) {
        $this->validate($request, [
            'avatar' => 'required|file|image|max:4000'
        ]);

        $file = $request->file('avatar')->store('avatars', 'public');

        $this->user->update([
            'avatar_url' => $file
        ]);

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->route('user.settings.index');
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (Hash::check($request->current_password, $this->user->password)) {
            $this->user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $this->flashNotifier->success(trans('app.common.operation_success'));
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
        }

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->route('user.settings');
    }
}
