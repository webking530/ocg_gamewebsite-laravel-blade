<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Models\Auth\User;
use Models\Gaming\Game;
use Models\Location\Country;
use Models\Gaming\Badge;
use Models\Gaming\Lottery;
use Models\Setting\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller {

//****************  General  Settings *************************
    public function general(Request $request) {

        if ($request->isMethod('post')) {
            settings($request->key, $request->value);
            $this->flashNotifier->success(trans('app.common.operation_success'));
            if ($request->ajax()) {
                echo 1;
                exit;
            } else {
                return redirect()->back();
            }
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
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function editGameSettings($id, Request $request) {
        $game = Game::find($id);
        if ($request->isMethod('post')) {
            $settings = $request->except(['_token']);
            $settings = $settings['settings'];
            $game->settings = $settings;
            if ($game->save()) {
                $this->flashNotifier->success(trans('games.setting_changed'));
                return redirect()->route('setting.games');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
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
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
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
            if ($country->save()) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('setting.countries');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
        return view('admin.country.add', compact('language', 'currency'));
    }

    public function editCountry($code, Request $request) {

        $country = Country::find($code);
        $language = \Models\Location\Language::pluck('code', 'code');
        $currency = \Models\Pricing\Currency::pluck('code', 'code');
        if ($request->isMethod('post')) {
            if ($country->update($request->all())) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('setting.countries');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
        return view('admin.country.add', compact('country', 'language', 'currency'));
    }

    //****************  Badges Settings *************************
    public function badges() {
        return view('admin.badges.badges');
    }

    public function showBadgesdata(Request $request) {
        $input = $request->all();
        $Badge = Badge::select('id', 'name', 'description', 'relevance');
        $Badge->orderBy('id', 'desc');
        $data = $Badge->get()->toArray();
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function addBadges(Request $request) {
        if ($request->isMethod('post')) {
            $badge = new Badge();
            $badge->name = $request->name;
            $badge->description = $request->description;
            $badge->relevance = $request->relevance;
            $badge->image_url = 'img/badges/' . $request->file('image_url')->getClientOriginalName();
            $badge->slug = str_replace(' ', '-', $request->name);
            if ($badge->save()) {
                $file = $request->file('image_url')->storeAs('badges', $request->file('image_url')->getClientOriginalName(), 'uploads');
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('setting.badges');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
        return view('admin.badges.add');
    }

    public function editBadges($id, Request $request) {

        $badge = Badge::find($id);
        if ($request->isMethod('post')) {
            $badge->name = $request->name;
            $badge->description = $request->description;
            $badge->relevance = $request->relevance;
            $badge->slug = str_replace(' ', '-', $request->name);
            if ($request->hasFile('image_url')) {
                $badge->image_url = 'img/badges/' . $request->file('image_url')->getClientOriginalName();
                $file = $request->file('image_url')->storeAs('badges', $request->file('image_url')->getClientOriginalName(), 'uploads');
            }
            if ($badge->update()) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('setting.badges');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
        return view('admin.badges.add', compact('badge', 'language', 'currency'));
    }

    //****************  Lottery Settings *************************
    public function lottery() {
        return view('admin.lottery.lottery');
    }

    public function showLotterydata(Request $request) {
        $input = $request->all();
        $Lottery = Lottery::select('id', 'prize', 'date_begin', 'status', 'type', 'ticket_price', 'country_code');
        $Lottery->orderBy('id', 'desc');
        $data = $Lottery->get()->toArray();
//        foreach ($Lottery->get() as $key => $ltr) {
//            $data[$key]['name'] = $ltr->getNameAttribute();
//        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function updateLotterySettings(Request $request) {
        $data = $request->except('_token');
        foreach ($data as $key => $val) {
            settings($key, $val);
        }
        $this->flashNotifier->success(trans('app.common.operation_success'));
        return redirect()->back();
    }

//    public function addLottery(Request $request) {
//        if ($request->isMethod('post')) {
//            $badge = new Badge();
//            $badge->name = $request->name;
//            $badge->description = $request->description;
//            $badge->relevance = $request->relevance;
//            $badge->image_url = 'img/badges/' . $request->file('image_url')->getClientOriginalName();
//            $badge->slug = str_replace(' ', '-', $request->name);
//            if ($badge->save()) {
//                $file = $request->file('image_url')->storeAs('badges',$request->file('image_url')->getClientOriginalName() ,'uploads');
//                $this->flashNotifier->success(trans('app.common.operation_success'));
//                return redirect()->route('setting.badges');
//            } else {
//                $this->flashNotifier->error(trans('app.common.operation_error'));
//                return redirect()->back();
//            }
//        }
//        return view('admin.lottery.add');
//    }
//
//    public function editLottery($id, Request $request) {
//
//        $badge = Badge::find($id);
//        if ($request->isMethod('post')) {
//            $badge->name = $request->name;
//            $badge->description = $request->description;
//            $badge->relevance = $request->relevance;
//            $badge->slug = str_replace(' ', '-', $request->name);
//            if($request->hasFile('image_url')){
//                $badge->image_url = 'img/badges/' . $request->file('image_url')->getClientOriginalName();
//                $file = $request->file('image_url')->storeAs('badges',$request->file('image_url')->getClientOriginalName() ,'uploads');
//            }
//            if ($badge->update()) {
//                $this->flashNotifier->success(trans('app.common.operation_success'));
//                return redirect()->route('setting.badges');
//            } else {
//                $this->flashNotifier->error(trans('app.common.operation_error'));
//                return redirect()->back();
//            }
//        }
//        return view('admin.badges.add', compact('badge', 'language', 'currency'));
//    }
}
