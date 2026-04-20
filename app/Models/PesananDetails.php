<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetails extends Model
{
	use HasFactory;

    protected $table = 'pesanan_details';

    protected $fillable = [
        'pesanan_id',
        'product_id',
        'jumlah',
        'jumlah_harga'
    ];
	
    public function product()
	{
	      return $this->belongsTo('App\Models\Backend\Product','product_id', 'id');
	}

	public function pesanan()
	{
	      return $this->belongsTo('App\Models\Pesanan','pesanan_id', 'id');
	}
}
