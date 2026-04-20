<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{	
	use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'user_id',
        'tanggal',
        'status',
        'jumlah_harga',
        'kode',
        'nama',
        'no_hp',
        'alamat'
    ];
	
    public function user()
	{
	      return $this->belongsTo('App\Models\User','user_id', 'id', 'name');
	}

	public function pesanan_detail() 
	{
	     return $this->hasMany('App\Models\PesananDetails','pesanan_id', 'id');
	}
}