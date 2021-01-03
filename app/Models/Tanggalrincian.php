<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggalrincian extends Model
{
    protected $table = 'tanggalrincian';
    protected $guarded = ['id'];

    public static function getTanggalrincian($id)
    {
        return tanggalrincian::get()->where('sppd_id',$id);
    }


    public static function destroy($id)
    {
        $id->delete();
    }
}
