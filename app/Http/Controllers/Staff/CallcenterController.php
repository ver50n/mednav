<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Callcenter;
use Auth;

class CallcenterController extends Controller
{
  public $routePrefix = 'staff.callcenter';
  public $viewPrefix = 'staff.callcenter';
  public $module = 'callcenter';

  public function list(Request $request)
  {
    $userId = Auth::user()->id;
    $obj = new Callcenter();
    $filters = $request->query('filters');
    $filters['user_id'] = $userId;
    
    $page = $request->query('page');
    $sort = $request->query('sort');

    if($filters)
      $obj->fill($filters);
    $data = $obj->filter($filters, [
      'pagination' => true,
      'page' => $page,
      'sort' => $sort,
      'notDraft' => true
    ]);

    return view($this->viewPrefix.'.list', [
      'obj' => $obj,
      'data' => $data,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function update(Request $request)
  {
    $obj = Callcenter::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Callcenter::findOrFail($request->id);

    $validator = $obj->edit($data);

    if($validator === true) {
      return redirect()
        ->back()
        ->with('success', \Lang::get('common.update-succed', ['module' => \Lang::get('common.'.$this->module)]));
    }

    return redirect()
      ->back()
      ->with('error', \Lang::get('common.update-failed', ['module' => \Lang::get('common.'.$this->module)]))
      ->withInput($data)
      ->withErrors($validator);
  }

  public function view(Request $request)
  {
    $obj = Callcenter::findOrFail($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function request(Request $request)
  {
    $obj = Callcenter::findOrFail($request->id);
    $obj->request();

    return redirect()
      ->back()
      ->with('success', \Lang::get('common.request-succed', ['module' => \Lang::get('common.'.$this->module)]));
  }
}