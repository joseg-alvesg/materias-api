<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_de_publicação' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDataDePublicacaoAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

}
