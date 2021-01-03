<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rincian_l2 extends Model
{
    protected $table = 'rincian_l2s';
    protected $guarded = ['id'];

    public function sppd()
    {
        return $this->BelongsTo(Sppd::class);
    }

    public static function getRincianl2($id)
    {
        return rincian_l2::get()->where('sppd_id',$id);
    }
}
