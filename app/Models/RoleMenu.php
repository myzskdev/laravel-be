<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role_id',
        'menu_id',
    ];

    public function roles()
    {
        return $this->hasMany(Roles::class, 'id', 'role_id');
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id', 'menu_id');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
