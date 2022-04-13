<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageController extends Controller
{
    public function dashboard()
    {
        return view('manage.dashboard', [
        ]);
    }
}