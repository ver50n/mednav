<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard', [
        ]);
    }
}