<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggalkwitansi extends Model
{
    protected $table = 'tanggalkwitansi';
    protected $guarded = ['id'];

    public static function getTanggalkwitansi($id)
    {
        return tanggalkwitansi::get()->where('sppd_id',$id);
    }


    public static function destroy($id)
    {
        $id->delete();
    }

}
