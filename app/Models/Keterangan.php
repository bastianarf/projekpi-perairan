<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keterangan extends Model
{
    protected $table = 'keterangan';
    protected $fillable = ['sppd_id','keterangan'];
}
