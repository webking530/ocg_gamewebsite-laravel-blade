<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Models\Auth\User;
use Models\Gaming\Game;
use Illuminate\Http\Request;
use Models\Setting\Setting;
use Yajra\DataTables\DataTables;

class SettingController extends Controller {

    public function general() {
        $settings['user_registration'] = Setting::where('key', 'registration_enable_disable')->first();
        $settings['maintenance_mode'] = Setting::where('key', 'maintenance_mode')->first();
        if ($settings['user_registration'] == '') {
            Setting::create([
                "key" => 'registration_enable_disable',
                "value" => 'on'
            ]);
            $settings['user_registration'] = Setting::where('key', 'registration_enable_disable')->first();
        }
        if ($settings['maintenance_mode'] == '') {
            Setting::create([
                "key" => 'maintenance_mode',
                "value" => 'on'
            ]);
            $settings['maintenance_mode'] = Setting::where('key', 'maintenance_mode')->first();
        }

        return view('admin.setting.index', compact('settings'));
    }

    public function registrationEnableDisable($status) {
        $uerRegistration = Setting::where('key', 'registration_enable_disable')->first();
        $uerRegistration->value = $status;
        $uerRegistration->save();
        echo 1;
        exit;
    }

    public function maintenanceMode($status) {
//        if($status == 'off'){
//            \Artisan::call('up');
//        }else{
//            \Artisan::call('down');
//        }
        $maintenanceMode = Setting::where('key', 'maintenance_mode')->first();
        $maintenanceMode->value = $status;
        $maintenanceMode->save();
        echo 1;
        exit;
    }

    public function games() {
        return view('admin.setting.game');
    }

    public function showGamedata(Request $request) {
        $input = $request->all();
        $games = Game::select('id', 'slug', 'enabled');
        $games->orderBy('id', 'desc');
        $data = $games->get()->toArray();
         foreach ($games->get() as $key => $user) {
            $data[$key]['name'] = $user->getNameAttribute();
        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }
    public function statusupdate($id, Request $request) {
        $game = Game::find($id);
        $game->enabled = $request->enabled;
        $msg = ($request->enabled == 0) ? 'games.game_disabled' : 'games.game_enabled';
        if ($game->save()) {
            $this->flashNotifier->success(trans($msg));
            return redirect()->route('setting.games');
        }
    }
    public function editSettings($id, Request $request) {
        $game = Game::find($id);
        if ($request->isMethod('post')) {
            $settings = $request->except(['_token']);
            $settings = $settings['settings'];
            $game->settings = $settings;
            if ($game->save()) {
                $this->flashNotifier->success(trans('games.setting_changed'));
                return redirect()->route('setting.games');
            }
        }

        return view('admin.setting.gameSettingsEdit', compact('game'));
    }

}
