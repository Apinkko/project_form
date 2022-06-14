<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service';
    protected $guarded = [];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function inventaris(){
        return $this->belongsTo('App\Models\Inventaris');
    }
    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
    public function teknisi(){
        return $this->belongsTo('App\Models\User');
    }
    public function teknisi_umum(){
        return $this->belongsTo('App\Models\TeknisiUmum');
    }
}
