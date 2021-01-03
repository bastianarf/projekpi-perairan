<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{
    protected $table = 'rincian';
    protected $guarded = ['id'];

    public function sppd()
    {
        return $this->BelongsTo(Sppd::class);
    }
  //  public function user()
  //  {
  //      return $this->belongsToMany(User::class);
  //  }

    public static function getRincian($id)
    {
        return Rincian::get()->where('sppd_id',$id);
    }

    public static function destroy($id)
    {
        $id->delete();
    }
}
