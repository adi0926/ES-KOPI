<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PenggunaDiklat;
use App\Models\Pengguna;
use App\Models\Diklat;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Blog\app\Models\Blog;
use Modules\ContactMessage\app\Models\ContactMessage;
use Modules\Language\app\Models\Language;
use Modules\Order\app\Models\Order;
use Modules\Order\app\Models\OrderItem;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // remove intended url from session
        $request->session()->forget('url');
        $diklatCount = Diklat::count();
        $penggunaDiklatCountVerified = PenggunaDiklat::where('status', 1)->count();
        $penggunaDiklatCountAll = PenggunaDiklat::count();
        $penggunaCount = Pengguna::count();

       
        //$menu = Menu::whereNull('parent_id')->get(); 
        $data = [
            'diklatCount' => $diklatCount,
            'penggunaDiklatCountVerified' => $penggunaDiklatCountVerified,
            'penggunaDiklatCountAll' => $penggunaDiklatCountAll,
            'penggunaCount' => $penggunaCount,
        ];
        return view('admin.dashboard', compact('data'));
    }

    public function setLanguage()
    {
        // clear menu cache
        Cache::forget('nav_menu');
        Cache::forget('footer_menu_one');
        Cache::forget('footer_menu_two');
        Cache::forget('footer_menu_three');
        Cache::forget('getSocialLinks');
        
        $lang = Language::whereCode(request('code'))->first();

        if (session()->has('lang')) {
            session()->forget('lang');
            session()->forget('text_direction');
        }
        if ($lang) {
            session()->put('lang', $lang->code);
            session()->put('text_direction', $lang->direction);

            $notification = __('Language Changed Successfully');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];

            return redirect()->back()->with($notification);
        }

        session()->put('lang', config('app.locale'));

        $notification = __('Language Changed Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}
