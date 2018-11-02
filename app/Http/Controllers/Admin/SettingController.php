<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Models\Auth\User;
use Models\Gaming\Game;
use Illuminate\Http\Request;
use Models\Setting\Setting;
use Yajra\DataTables\DataTables;
use Models\Location\Country;

class SettingController extends Controller {

//****************  General  Settings *************************
    public function general(Request $request) {

        if ($request->isMethod('post')) {
            $this->flashNotifier->success(trans('app.common.operation_success'));
            settings($request->key, $request->value);
        }
        return view('admin.setting.generalSettings');
    }

    public function showGeneralSettingsdata(Request $request) {
        $input = $request->all();
        $Settings = Setting::select('id', 'key', 'value');
        $Settings->orderBy('id', 'desc');
        $data = $Settings->get()->except(10)->toArray();
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

//****************  Game Settings *************************
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

    public function gameStatusUpdate($id, Request $request) {
        $game = Game::find($id);
        $game->enabled = $request->enabled;
        $msg = ($request->enabled == 0) ? 'app.common.disabled' : 'app.common.enabled';
        if ($game->save()) {
            $this->flashNotifier->success(trans($msg));
            return redirect()->route('setting.games');
        }
    }

    public function editGameSettings($id, Request $request) {
        $game = Game::find($id);
        if ($request->isMethod('post')) {
            $settings = $request->except(['_token']);
            if ($game->save()) {
                $this->flashNotifier->success(trans('games.setting_changed'));
                return redirect()->route('setting.games');
            }

            $settings = $settings['settings'];
            $game->settings = $settings;
        }

        return view('admin.setting.gameSettingsEdit', compact('game'));
    }

    //****************  Countries Settings *************************

    public function countries() {
        return view('admin.country.countries');
    }

    public function showCountrydata(Request $request) {
        $input = $request->all();
        $Country = Country::select('code', 'currency_code', 'pricing_currency', 'locale', 'capital_timezone', 'enabled');
        $Country->orderBy('code', 'desc');
        $data = $Country->get()->toArray();
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function countryStatusUpdate($id, Request $request) {
        $game = Country::find($id);
        $game->enabled = $request->enabled;
        $msg = ($request->enabled == 0) ? 'app.common.disabled' : 'app.common.enabled';
        if ($game->save()) {
            $this->flashNotifier->success(trans($msg));
            return redirect()->route('setting.countries');
        }
    }

    public function addCountry(Request $request) {
        $language = \Models\Location\Language::pluck('code', 'code');
        $currency = \Models\Pricing\Currency::pluck('code', 'code');
        if ($request->isMethod('post')) {
            $country = new Country ();
            $country->code = $request->code;
            $country->currency_code = $request->currency_code;
            $country->pricing_currency = $request->pricing_currency;
            $country->locale = $request->locale;
            $country->capital_timezone = $request->capital_timezone;
            $country->save();
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('setting.countries');
        }
        return view('admin.country.add', compact('language', 'currency'));
    }

    public function editCountry($code, Request $request) {

        $country = Country::find($code);
        $language = \Models\Location\Language::pluck('code', 'code');
        $currency = \Models\Pricing\Currency::pluck('code', 'code');
        if ($request->isMethod('post')) {
            $country->update($request->all());
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('setting.countries');
        }
        return view('admin.country.add', compact('country', 'language', 'currency'));
    }

}
