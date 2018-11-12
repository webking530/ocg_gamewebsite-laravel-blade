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
use Illuminate\Support\Facades\Auth;
use Models\Gaming\LotteryTicket;

class SettingController extends Controller {

//****************  General  Settings *************************
    public function general(Request $request) {

        return view('admin.setting.generalSettings');
    }

    public function updateGeneral(Request $request) {

        settings($request->get('key'), $request->get('value'));
        $this->flashNotifier->success(trans('app.common.operation_success'));
        if ($request->ajax()) {
            echo 1;
            exit;
        } else {
            return redirect()->back();
        }
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

    /**
     * 
     * @var Game $game
     * @param  \Illuminate\Http\Request  $request
     */
    public function showGamedata(Request $request) {
        $input = $request->all();
        $games = Game::select('id', 'slug', 'icon_url', 'credits', 'enabled');
        $games->orderBy('id', 'desc');
        $data = $games->get()->toArray();
        foreach ($games->get() as $key => $game) {
            $data[$key]['name'] = $game->getNameAttribute();
            $data[$key]['image'] = $game->getSmallIconAttribute();
            $data[$key]['highestwin'] = $game->getHighestWinAmount($game);
            $data[$key]['latestwin'] = $game->getLastWinAmount($game);
        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    /**
     * 
     * @param int $id
     * @param Request $request
     */
    public function gameStatusUpdate($id, Request $request) {
        $this->validate($request, [
            'enabled' => 'required'
        ]);
        $game = Game::find($id);
        $game->enabled = $request->get('enabled');
        $msg = ($request->get('enabled') == 0) ? 'app.common.disabled' : 'app.common.enabled';
        if ($game->save()) {
            $this->flashNotifier->success(trans($msg));
            return redirect()->route('setting.games');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    /**
     * 
     * @param int $id
     * @return type
     */
    public function editGameSettings($id) {
        $game = Game::find($id);
        return view('admin.setting.gameSettingsEdit', compact('game'));
    }

    public function updateGameSetting(Request $request) {

        $this->validate($request, [
            'settings' => 'required'
        ]);
        $game = Game::find($request->get('id'));
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

    /**
     * 
     * @param int $id
     */
    public function gameDetail($id) {

        $game = Game::with('winnings')->find($id);
        $gameActivePlayers = Game::with('sessions')->find($id);
        return view('admin.setting.gameDetail', compact('game', 'gameActivePlayers'));
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

    /**
     * 
     * @param type $id
     * @param Request $request
     * @return type
     */
    public function countryStatusUpdate($id, Request $request) {
        $game = Country::find($id);
        $game->enabled = $request->get('enabled');
        $msg = ($request->get('enabled') == 0) ? 'app.common.disabled' : 'app.common.enabled';
        if ($game->save()) {
            $this->flashNotifier->success(trans($msg));
            return redirect()->route('setting.countries');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function addCountry() {
        $language = \Models\Location\Language::pluck('code', 'code');
        $currency = \Models\Pricing\Currency::pluck('code', 'code');
        return view('admin.country.add', compact('language', 'currency'));
    }

    public function createCountry(Request $request) {

        $this->validate($request, [
            'code' => 'required',
            'currency_code' => 'required',
            'pricing_currency' => 'required',
            'locale' => 'required',
            'capital_timezone' => 'required',
        ]);
        $country = new Country ();
        $country->code = $request->get('code');
        $country->currency_code = $request->get('currency_code');
        $country->pricing_currency = $request->get('pricing_currency');
        $country->locale = $request->get('locale');
        $country->capital_timezone = $request->get('capital_timezone');
        if ($country->save()) {
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('setting.countries');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function editCountry($code) {

        $country = Country::find($code);
        $language = \Models\Location\Language::pluck('code', 'code');
        $currency = \Models\Pricing\Currency::pluck('code', 'code');
        return view('admin.country.add', compact('country', 'language', 'currency'));
    }

    /**
     * 
     * @param int $code
     * @param Request $request
     * @return type
     */
    public function updateCountry($code, Request $request) {

        $this->validate($request, [
            'code' => 'required',
            'currency_code' => 'required',
            'pricing_currency' => 'required',
            'locale' => 'required',
            'capital_timezone' => 'required',
        ]);
        $country = Country::find($code);
        if ($country->update($request->all())) {
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('setting.countries');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
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

    public function addBadges() {

        return view('admin.badges.add');
    }

    public function createdBadges(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'relevance' => 'required',
            'image_url' => 'required|file|image|max:4000'
        ]);
        $badge = new Badge();
        $badge->name = $request->get('name');
        $badge->description = $request->get('description');
        $badge->relevance = $request->get('relevance');
        $badge->slug = str_replace(' ', '-', $request->get('name'));
        $badge->image_url = 'img/badges/' . $request->file('image_url')->getClientOriginalName();
        if ($badge->save()) {
            $file = $request->file('image_url')->storeAs('badges', $request->file('image_url')->getClientOriginalName(), 'uploads');
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('setting.badges');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    /**
     * 
     * @param int $id
     * @return type
     */
    public function editBadges($id) {

        $badge = Badge::find($id);
        return view('admin.badges.add', compact('badge', 'language', 'currency'));
    }

    /**
     * 
     * @param int  $id
     * @param Request $request
     * @return type
     */
    public function updateBadges($id, Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'relevance' => 'required',
        ]);
        $badge = Badge::find($id);
        $badge->name = $request->get('name');
        $badge->description = $request->get('description');
        $badge->relevance = $request->get('relevance');
        $badge->slug = str_replace(' ', '-', $request->get('name'));
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

    //****************  Lottery Settings *************************
    public function lottery() {
        return view('admin.lottery.lottery');
    }

    public function showLotterydata(Request $request) {
        $input = $request->all();
        $Lottery = Lottery::select('id', 'prize', 'date_begin', 'status', 'type', 'ticket_price', 'country_code');
        $Lottery->orderBy('id', 'desc');
        $data = $Lottery->get()->toArray();
        foreach ($Lottery->get() as $key => $ltr) {
            $data[$key]['status'] = $ltr->getFormattedStatusAttribute($ltr->status);
            $data[$key]['type'] = $ltr->getFormattedStakeTextAttribute($ltr->type);
        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function updateLotterySettings(Request $request) {
        $data = $request->except('_token');
        settings($data);
        $this->flashNotifier->success(trans('app.common.operation_success'));
        return redirect()->back();
    }

    public function addLottery(Request $request) {
        return view('admin.lottery.add');
    }

    public function createLottery(Request $request) {

        $lottery = new Lottery();
        $lottery->prize = 0;
        $lottery->date_open = $request->get('date_open');
        $lottery->date_close = $request->get('date_close');
        $lottery->date_begin = $request->get('date_begin');
        $lottery->status = 3;
        $lottery->type = $request->get('type');
        $lottery->ticket_price = $request->get('ticket_price');
        if ($lottery->save()) {
            $lotteryticket = new LotteryTicket();
            $lotteryticket->lottery_id = $lottery->id;
            $lotteryticket->numbers = random_number_array();
            if ($lotteryticket->save()) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('setting.lottery');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    //Jackpt Configuration Start
    public function jackpot() {
        return view('admin.jackpot.index');
    }

}
