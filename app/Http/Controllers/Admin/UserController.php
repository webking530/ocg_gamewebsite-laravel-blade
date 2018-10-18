<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Models\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function showdata()
    {
        $users['data'] = User::all();
        echo json_encode($users);
        exit;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function show($id)
    {
        $user['details'] = User::where('id', $id)->first();
        $gender = User::getGenderList();
        $user['gender'] = $gender[$user['details']->gender];
        return view('admin.user.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, User::rules(true, $id));
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('user.index')->withSuccess(trans('user.success_edited'));
    }

    public function suspendUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->suspended_on = date('Y-m-d h:m:s');
        $user->save();
        return back()->withSuccess(trans('app.success_destroy'));
    }

    public function resumeUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->suspended_on = 0;
        $user->save();
        return back()->withSuccess(trans('app.success_destroy'));
    }

    public function switchUser(Request $request, User $user)
    {
//        $new_user = User::find($user->id);
//        Session::put('orig_user', Auth::id());
//        Auth::login($new_user);
        return redirect()->route('user.index');
    }

    public function switchBack()
    {
//        $id = Session::pull('orig_user');
//        $orig_user = User::find($id);
//        Auth::login($orig_user);
        return redirect()->route('user.index');
    }

}
