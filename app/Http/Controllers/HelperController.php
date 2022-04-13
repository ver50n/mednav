<?php

namespace App\Http\Controllers;

use App;
use Session;
use Lang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelperController extends Controller
{
  public function changeRowPerPage(Request $request)
  {
    $rowPerPage = $request->input('rpp');
    Session::put('rowPerPage', $rowPerPage);

    return Response()->json([
      'success' => true
    ]);
  }

  function changeLocale(Request $request)
  {
    $locale = $request->input('locale');
    \App::setLocale($locale);
    \Session::put('locale', $locale);
    \Session::save();

    return Response()->json([
        'success' => true
    ]);
  }

  public function export(Request $request)
  {
    $request = $request->all();
    $export = new \App\Helpers\ExportUtil('csv');
    $model = '\\App\\Models\\'.$request['model'];
    $objClass = new $model();
    $options = [
      'file_name' => $request['model'],
      'with_header' => true,
      'model' => $request['model'],
    ];

    $filters = (isset($request['filters'])) ? $request['filters'] : [];
    $data = $objClass->filter($filters, ['no-paging' => true]);
    $data = $objClass->csvFormatter($data->toArray());

    $export->exportCsv($data, $options);

    // return redirect()
    //   ->back()
    //   ->with('success', '抽出Request承りました。処理時間かかりますので、しばらくお待ちください。');
  }

  public function download(Request $request)
  {
    $request = $request->all();
    $path = $request['path'];
    $fileName = $request['file_name'];

    $headers = array(
      'Content-Type: text/csv',
    );

    return response()->download($path, $fileName, $headers);
  }
  
  public function activation(Request $request)
  {
    $request = $request->all();
    $model = '\\App\\Models\\'.$request['model'];
    $id = $request['id'];

    $obj = $model::findOrFail($id);
    
    $obj->is_active = $obj->is_active ? 0 : 1;
    $obj->save();
      
    return redirect()
      ->back()
      ->with('success', $request['model'].'('.$id.'): '.($obj->is_active ? '有効にしました' : '無効にしました'));
  }

  public function loadSchedule(Request $request)
  {
    $data = $request->all();
    $data['is_for_member_only'] = [0];

    if(\Auth::check())
      $data['is_for_member_only'] = [0,1];

    $data = \App\Models\Schedule::loadSchedule($data);
    $data = \App\Models\Schedule::formatFullCalendar($data);
    
    return Response()->json($data);
  }

  public function downloadFile(Request $request)
  {
    $request = $request->all();
    $pathName = $request['path_name'];
    $fileName = $request['file_name'];

    $disk = \Storage::disk('public')->path(config('image.path.' . $pathName));
    $filepath = $disk . $fileName;
    
    return Response()->download($filepath);
  }
}