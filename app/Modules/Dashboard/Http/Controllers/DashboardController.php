<?php 
namespace App\Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input,Redirect,App;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Dashboard::dashboard.index');
    }

        /**
     * 修改语言
     *
     * @param Request $request
     * @return mixed
     */
    public function changeLanguage(Request $request)
    {
        session()->put('locale',$request->lang);
        return Redirect::intended('/');
    }
}