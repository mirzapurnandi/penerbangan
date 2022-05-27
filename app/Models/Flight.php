<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;
    protected $table = 'flights';
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function nama_kota_berangkat()
    {
        return $this->hasOne(Town::class, 'id', 'kota_berangkat');
    }

    public function nama_kota_tujuan()
    {
        return $this->hasOne(Town::class, 'id', 'kota_tujuan');
    }
}
