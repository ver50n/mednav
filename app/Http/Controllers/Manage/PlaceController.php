<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Place;
use App\Models\PlaceHourlyWage;
use App\Models\PlaceShiftHour;

class PlaceController extends Controller
{
  public $routePrefix = 'manage.place';
  public $viewPrefix = 'manage.place';
  public $module = 'place';

  public function list(Request $request)
  {
    $obj = new Place();
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
    $obj = new Place();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $place = new Place();

    $validator = $place->add($data);

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
    $obj = Place::findOrFail($request->id);
    $wages = [];
    $shifts = [];

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'wages' => $wages,
      'shifts' => $wages,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Place::findOrFail($request->id);

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
    $obj = Place::findOrFail($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function delete(Request $request)
  {
    $obj = Place::findOrFail($request->id);
    $obj->delete();

    return redirect()->route($this->routePrefix.'.list')
      ->with('success', \Lang::get('common.delete-succed', ['module' => \Lang::get('common.'.$this->module)]));
  }

  public function updateWagePost(Request $request)
  {
    $placeId = $request->place_id;
    $obj = Place::findOrFail($placeId);
    $data = $request->all();
    
    $validator = PlaceHourlyWage::setPlaceHourlyWages($data);

    if($validator === true) {
      return redirect()
        ->back()
        ->with('success', \Lang::get('common.update-wage-succed', ['module' => \Lang::get('common.'.$this->module)]));
    }

    return redirect()
      ->back()
      ->with('error', \Lang::get('common.update-wage-failed', ['module' => \Lang::get('common.'.$this->module)]))
      ->withInput($data)
      ->withErrors($validator);
  }

  public function updateShiftPost(Request $request)
  {
    $placeId = $request->place_id;
    $obj = Place::findOrFail($placeId);
    $data = $request->all();
    
    $validator = PlaceShiftHour::setPlaceShiftHours($data);

    if($validator === true) {
      return redirect()
        ->back()
        ->with('success', \Lang::get('common.update-wage-succed', ['module' => \Lang::get('common.'.$this->module)]));
    }

    return redirect()
      ->back()
      ->with('error', \Lang::get('common.update-wage-failed', ['module' => \Lang::get('common.'.$this->module)]))
      ->withInput($data)
      ->withErrors($validator);
  }

  public function getWages(Request $request)
  {
    $placeId = $request->id;
    $obj = Place::findOrFail($placeId);
    $data = $request->all();

    $wages = PlaceHourlyWage::getWages($data);
    return json_encode($wages);
  }
  
  public function getShift(Request $request)
  {
    $placeId = $request->id;
    $obj = Place::findOrFail($placeId);
    $data = $request->all();

    $shift = PlaceShiftHour::getShift($data);
    return json_encode($shift);
  }
}