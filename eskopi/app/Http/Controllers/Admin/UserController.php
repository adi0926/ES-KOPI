<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Level;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    public function show()
    {
        $daftaruser = DB::table('v_user')
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.user.user', compact(['daftaruser']));
    }
    public function add_user()
    {
        $levels = Level::orderBy('id_role', 'asc')->get();
        return view('admin.user.add_user', compact(['levels']));
    }
    public function user_store(Request $request)
    {
        $request->validate([
           
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255'
           
        ]);
        
        $post = Admin::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_group' => $request->level,
                    'status' => $request->status


                ]);

                if($post){
                    $notification = __('User berhasil ditambahkan');
                    $notification = ['messege' => $notification, 'alert-type' => 'success'];
                    return redirect('admin/user')->with($notification);
                } else {
                    $notification = __('Terjadi kesalahan, gagal menambah user');
                    $notification = ['messege' => $notification, 'alert-type' => 'error'];
                    return redirect()->back()->with($notification);
                }
    }
    

    public function edit_user($id)
    {  
        $id = Crypt::decrypt($id);
        $user = Admin::where('id', '=' , $id)->first();
        $levels = Level::orderBy('id_role', 'asc')->get();
       // @dd($user);
		return view('admin.user.edit_user', compact(['user','levels']));	
  	}
      public function user_update(Request $request)
      {   
          $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255'
          ]);
          
          $user = Admin::find($request->id);
          
          if (empty($request->password)) {
            // If the new password is empty, use the old password
            $password = $request->password_old;
            } else {
                // Otherwise, use the new password
            $password = Hash::make($request->password);
          }
        //   var_dump($request->status);
        //   die;
  
          $post = $user->update([
                      'name' => $request->name,
                      'email' => $request->email,
                      'password' => $password,
                      'id_group' => $request->level,
                      'status' => $request->status
                  ]);
                  
          if($post){
              $notification = __('User berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/user')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah User');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
        } 
        public function user_delete($id)
        {   
            $post = User::findOrFail($id);
            $post->delete();

            return redirect('admin/user')->with('message', 'User Berhasil dihapus');
        }

}