<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory, Notifiable;

    
    protected $table = 'v_user_menu';

    protected $fillable = ['id','nama_menu', 'url', 'icon', 'active_segment','parent_id','id_pengguna','id_group'];
    
    public function parent()
     {
         return $this->belongsTo(Menu::class, 'parent_id');
     }

     public function children()
     {
         return $this->hasMany(Menu::class, 'parent_id');
     }
     public function scopeByUserAndGroup($query, $id_pengguna, $id_group)
     {
         return $query->whereIn('id_pengguna', $id_pengguna)
                      ->whereIn('id_group', $id_group)
                      ->whereNull('parent_id') // Get top-level menus (no parent)
                      ->with('children')       // Load submenus (children)
                      ->orderBy('id');    // Order menu by ID
     }


}