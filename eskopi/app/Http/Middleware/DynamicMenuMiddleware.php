<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu; // Assuming you have a MenuItem model
use Illuminate\Http\Request;

class DynamicMenuMiddleware
{
    public function handle(Request $request, Closure $next)
    {
             // Get session data
             $id_group = session('id_group');
             $id_pengguna = session('id_pengguna');

           
           
             
             // Initialize the menu variable (empty collection if no menu found)
             $menu = collect();
     
             // Check if both session values exist
             if (!is_null($id_group) && !is_null($id_pengguna)) {
                 // Fetch dynamic menu based on session data
                 $menu = Menu::whereNull('parent_id')
                             ->where('id_group', $id_group)
                             ->where('id_pengguna', $id_pengguna)
                             ->with(['children' => function ($query) use ($id_pengguna) {
                                $query->where('id_pengguna', $id_pengguna);
                             }])
                             ->get();
             }
            
             // @dd($id_group);
            //@dd($id_pengguna);
             // Share the menu variable globally with all views (it will be an empty collection if no data)
             view()->share('menu', $menu);
     
             // Proceed with the request
             return $next($request);
    }
}
