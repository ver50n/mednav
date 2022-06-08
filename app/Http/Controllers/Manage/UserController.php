<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
  public $routePrefix = 'manage.user';
  public $viewPrefix = 'manage.user';
  public $module = 'user';

  public function list(Request $request)
  {
    $obj = new User();
    $filters = $request->query('filters');
    $page = $request->query('page');
    $sort = $request->query('sort');

    if($filters)
      $obj->fill($filters);
    $data = $obj->filter($filters, [
      'pagination' => true,
      'page' => $page,
      'sort' => $sort
    ]);

    return view($this->viewPrefix.'.list', [
      'obj' => $obj,
      'data' => $data,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function create()
  {
    $obj = new User();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $user = new User();

    $validator = $user->add($data);

    if($validator === true) {
      return redirect()->route($this->routePrefix.'.list')
        ->with('success', \Lang::get('common.create-succed', ['module' => \Lang::get('common.'.$this->module)]));
    }

    return redirect()
      ->back()
      ->with('error', \Lang::get('common.create-failed', ['module' => \Lang::get('common.'.$this->module)]))
      ->withInput($data)
      ->withErrors($validator);
  }

  public function update(Request $request)
  {
    $obj = User::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = User::findOrFail($request->id);

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
    $obj = User::findOrFail($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function delete(Request $request)
  {
    $obj = User::findOrFail($request->id);
    $obj->delete();

    return redirect()->route($this->routePrefix.'.list')
      ->with('success', \Lang::get('common.delete-succed', ['module' => \Lang::get('common.'.$this->module)]));
  }

  public function resetPasswordPost(Request $request)
  {
    $obj = User::findOrFail($request->id);
    $obj->resetPassword();

    return redirect()->route($this->routePrefix.'.list')
      ->with('success', \Lang::get('common.reset-password-succed', ['module' => \Lang::get('common.'.$this->module)]));
  }
}