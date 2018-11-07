<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Models\Bonuses\Bonus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller {

    public function index() {
        return view('admin.bonus.index');
    }

    public function showdata(Request $request) {
        $input = $request->all();
        $bonuses = Bonus::select('id', 'type', 'prize', 'name', 'description', 'enabled');
        $bonuses->orderBy('id', 'desc');
        $data = $bonuses->get()->toArray();
        foreach ($bonuses->get() as $key => $bonus) {
            $data[$key]['type'] = $bonus->getFormattedTypeAttribute();
            $data[$key]['prize'] = $bonus->getFormattedPrizeAttribute();
        }

        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function edit($id) {
        $bonus = Bonus::findOrFail($id);
        return view('admin.bonus.edit', compact('bonus'));
    }

    public function update(Request $request, $id) {
        $rules = array(
            'name' => "required|unique:bonuses,name,$id",
            'type' => 'required',
            'prize' => 'required',
            'enabled' => 'required',
            'description' => "required|unique:bonuses,description,$id",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('bonus.create')
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            $bonus = Bonus::findOrFail($id);
            $bonus->name = $request->get('name');
            $bonus->type = $request->get('type');
            $bonus->prize = $request->get('prize');
            $bonus->enabled = $request->get('enabled');
            $bonus->description = $request->get('description');
            if ($bonus->save()) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('bonus.index');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
    }

    public function create() {
        return view('admin.bonus.edit');
    }

    public function store(Request $request) {
        $rules = array(
            'name' => 'required|unique:bonuses',
            'type' => 'required',
            'prize' => 'required',
            'enabled' => 'required',
            'description' => 'required|unique:bonuses',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('bonus.create')
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            $bonus = new Bonus;
            $bonus->name = $request->get('name');
            $bonus->type = $request->get('type');
            $bonus->prize = $request->get('prize');
            $bonus->enabled = $request->get('enabled');
            $bonus->description = $request->get('description');
            $bonus->slug = $request->get('slug');
            if ($bonus->save()) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('bonus.index');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
    }

    public function destroy($id) {
        $bonus = Bonus::find($id);
        if ($bonus->delete()) {
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('bonus.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function statusUpdate($id, Request $request) {
        $bonus = Bonus::find($id);
        $bonus->enabled = $request->get('enabled');
        $msg = ($request->get('enabled') == 0) ? 'app.common.disabled' : 'app.common.enabled';
        if ($bonus->save()) {
            $this->flashNotifier->success(trans($msg));
            return redirect()->route('bonus.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

}
