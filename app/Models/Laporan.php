<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $guarded = ['id'];

    public static function getLaporan($id)
    {
        return laporan::get()->where('sppd_id',$id);
    }

    public static function destroy($id)
    {
        $id->delete();
    }
}


