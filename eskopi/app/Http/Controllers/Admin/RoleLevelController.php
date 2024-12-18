<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\CoreMenu;
use App\Models\AksesGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class RoleLevelController extends Controller
{

    public function role_level ()
    {
        $level = Level::orderBy('id_role', 'desc')->get();
        return view('admin.role-level.role_level', compact(['level']));
    }

    public function add_level()
    {
        $diklats = Level::orderBy('id_role', 'asc')->get();
        return view('admin.level.add_level');
    }

    public function level_store(Request $request)
    {
        $request->validate([
           
            'nama_role' => 'required|string|max:255'
           
           
        ]);
        
        $post = Level::insert([
                    'nama_role' => $request->nama_role


                ]);

                if($post){
                    $notification = __('Level berhasil ditambahkan');
                    $notification = ['messege' => $notification, 'alert-type' => 'success'];
                    return redirect('admin/level')->with($notification);
                } else {
                    $notification = __('Terjadi kesalahan, gagal menambah user');
                    $notification = ['messege' => $notification, 'alert-type' => 'Level'];
                    return redirect()->back()->with($notification);
                }
    }

    public function edit_role_level($id)
    {  
        $id = Crypt::decrypt($id);
        $aksesgroup = AksesGroup::where('id_group', $id)->pluck('id_menu')->all();
        $menuList = CoreMenu::get();
		return view('admin.role-level.edit_role_level', compact('menuList','aksesgroup', 'id'));	    
	}
    public function role_level_update(Request $request)
    {
        // Validate input
        $request->validate([
            'id_group' => 'required', // assuming 'core_akses_group' table has an 'id' column
            'menu' => 'required|array',  // Ensuring 'menu' is an array
            'menu.*' => 'exists:core_menu,id'  // Validate that each menu ID exists in the 'core_menu' table
        ]);
    
        // Retrieve all the request data
        $data = $request->all();
        $menuData = $data['menu'];
        $groupId = $data['id_group'];
    
        // Check if there are any menu items selected
        if (count($menuData) > 0) {
            // Begin a transaction to ensure atomicity
            DB::beginTransaction();
            try {
                // Delete existing AksesGroup entries for the given group ID
                AksesGroup::where('id_group', $groupId)->delete();
    
                // Loop through the menu items and insert them
                foreach ($menuData as $row) {
                    $newd = [
                        'id_menu' => $row,
                        'id_group' => $groupId
                    ];

                    
    
                    // Create a new AksesGroup entry
                    $menuPer = new AksesGroup();
                    $menuPer->fill($newd);
                    $menuPer->save();
                }
    
                // Commit the transaction
                DB::commit();
    
                // Return success notification after all items are saved
                $notification = __('Role Level berhasil diubah');
                $notification = ['messege' => $notification, 'alert-type' => 'success'];
                return redirect('admin/role-level')->with($notification);
            } catch (\Exception $e) {
                // Rollback the transaction in case of any error
                DB::rollBack();
    
                // Return an error notification
                $notification = __('Terjadi kesalahan, gagal mengubah Role Level');
                $notification = ['messege' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }
        }
    
        // If no menu data is provided
        $notification = __('Tidak ada menu yang dipilih');
        $notification = ['messege' => $notification, 'alert-type' => 'error'];
        return redirect()->back()->with($notification);
    }

    public function level_update(Request $request)
    {    	
        $request->validate([
            'nama_role' => 'required|string|max:255'
           
          ]);
          
          $level = Level::find($request->id);
          
          
          $post = $level->update([
                      'nama_role' => $request->nama_role
                     
                  ]);
                  
          if($post){
              $notification = __('Level berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/level')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Level');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    public function level_delete($id)
	{   
        $post = Level::findOrFail($id);
        $post->delete();

		return redirect('admin/level')->with('message', 'Level Berhasil dihapus');
    }

}