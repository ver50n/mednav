<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Admin;
use App\Models\CallCenter;
use App\Models\User;

use \App\Utils\DateTimeInherit;
use DateTime;
use DateInterval;

class ManageController extends Controller
{
    public function calculation()
    {
        $cc = new CallCenter();
        $cc->date_period = '2022-06-06';
        $cc->user_id = 1;
        $cc->place_id = 5;
        $cc->time_start = '2022-06-06 08:00:00';
        $cc->time_end = '2022-06-06 16:00:00';
        $cc->actual_time_start = '2022-06-06 08:00:00';
        $cc->actual_time_end = '2022-06-06 15:00:00';
        $cc->actual_time_rest_start = "2022-06-06 12:00:00";
        $cc->actual_time_rest_end = "2022-06-06 13:00:00";
        // $cc->actual_time_rest_start2 = "2022-06-07 03:00:00";
        // $cc->actual_time_rest_end2 = "2022-06-07 04:00:00";
        $cc->transport_fee = 0;
        $res = $cc->calculateSimulation();

        dd($res);
    }

    public function csvReader()
    {
        ini_set('max_execution_time', 0);
        $dataDirectory = resource_path("data");
        $row = 0;
        $max = 1;
        if (($handle = fopen($dataDirectory.'/cc-june.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                if($row == 1)
                    continue;

                $period = date('Y-m-d', strtotime($data[1]));
                $tomorrowPeriod = date('Y-m-d', strtotime("+1 day", strtotime($period)));

                $start = date('Y-m-d H:i:s', strtotime($period." ".$data[4]));
                $rawEnd = $data[5];
                $correctFormatEnd = str_replace("翌", "", $rawEnd);
                $end = date('Y-m-d H:i:s', strtotime($period." ".$correctFormatEnd));
                if(strpos($rawEnd, "翌") !== false)
                    $end = date('Y-m-d H:i:s', strtotime($tomorrowPeriod." ".$correctFormatEnd));
                $name = $data[6];
                $nameForLookup = $name;
                if($name != "(MRT)" && !strpos($name, " "))
                    $nameForLookup = mb_substr($name,0,2).' '.mb_substr($name,2);

                $user = User::where("name", $nameForLookup)->first();
                if(!$user) {
                    echo "error (user not found) : ".$name." ".$row."<br />";
                    continue;
                }

                $cc = new CallCenter();
                $ccdata['date_period'] = $period;
                $ccdata['user_id'] = $user->id;
                $ccdata['place_id'] = 5;
                $ccdata['time_start'] = $start;
                $ccdata['time_end'] = $end;
                $result = $cc->register($ccdata);

                if($result === true) {
                    echo "success : ".$nameForLookup." ".$start." - ".$end."<br />";
                } else {
                    echo "error : ".$name." ".$row."<br />";
                }

                // if($row > $max)
                    // break;
            }
            fclose($handle);
        }
    }

    public function dashboard()
    {
        //$this->csvReader();
        return view('manage.dashboard', [
        ]);
    }

    public function setting()
    {
        return view('manage.setting', []);
    }

    public function changePasswordPost(Request $request)
    {
        $id = \Auth::guard('admin')->id();
        $data = $request->all();
        $obj = Admin::findOrFail($id);
        $res = $obj->changePassword($data);

        if($res != true) {
            return redirect()->back()
                ->with('error', \Lang::get('common.change-password-error'));
        }
        return redirect()->back()
          ->with('success', \Lang::get('common.change-password-succed'));
    }
}