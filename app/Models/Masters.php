<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Masters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'value',
        'description',
        'created_by',
    ];

    public function getOnebyId($id)
    {
        $data = DB::table('masters')->where('id', $id)->get();

        return $data;
    }

    public function getOnebyName($name)
    {
        $data = DB::table('masters')->where('name', $name)->get();

        return $data;
    }

    public function getParent()
    {
        $data = DB::table('masters')
                        ->where('parent_id', null)
                        ->where('deleted_at', null)
                        ->get();

        return $data;
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'created_by');
    }

    public function master()
    {
        return $this->hasMany(Masters::class, 'id', 'parent_id');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
