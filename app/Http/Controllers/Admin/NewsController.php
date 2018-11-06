<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Models\News\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller {

    public function index() {
        return view('admin.news.index');
    }

    public function showdata(Request $request) {
        $input = $request->all();
        $users = News::select('id', 'name', 'order', DB::raw('DATE_FORMAT(date_from, "%d %M,%Y") as fromDate'), DB::raw('DATE_FORMAT(date_to, "%d %M,%Y") as toDate'));
        $users->orderBy('id', 'desc');
        $data = $users->get()->toArray();
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function edit($id) {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id) {
        $rules = array(
            'name' => 'required',
            'content' => 'required',
            'order' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('news.edit')
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            $user = News::findOrFail($id);
            if ($user->update($request->except('_token'))) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('news.index');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
    }

    public function create() {
        return view('admin.news.edit');
    }

    public function store(Request $request) {
        $rules = array(
            'name' => 'required',
            'content' => 'required',
            'order' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('news.create')
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            $news = new News;
            $news->name = $request->get('name');
            $news->content = $request->get('content');
            $news->order = $request->get('order');
            $news->date_from = $request->get('date_from');
            $news->date_to = $request->get('date_to');
            if ($news->save()) {
                $this->flashNotifier->success(trans('app.common.operation_success'));
                return redirect()->route('news.index');
            } else {
                $this->flashNotifier->error(trans('app.common.operation_error'));
                return redirect()->back();
            }
        }
    }

    public function destroy($id) {
        $news = News::find($id);
        if ($news->delete()) {
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('news.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

}
