<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Callcenter;

class StaffController extends Controller
{

    public function dashboard()
    {
        $id = \Auth::guard('web')->id();
        $ccThisMonth = Callcenter::where('status', '<>', 'draft')->where('user_id', $id)->whereMonth('date_period', \Carbon\Carbon::now()->month)
            ->get();

        return view('staff.dashboard', [
            'ccThisMonth' => $ccThisMonth
        ]);
    }

    public function setting()
    {
        return view('staff.setting', []);
    }

    public function changePasswordPost(Request $request)
    {
        $id = \Auth::guard('web')->id();
        $data = $request->all();
        $obj = User::findOrFail($id);
        $res = $obj->changePassword($data);

        if($res != true) {
            return redirect()->back()
                ->with('error', \Lang::get('common.change-password-error'));
        }
        return redirect()->back()
          ->with('success', \Lang::get('common.change-password-succed'));
    }
}