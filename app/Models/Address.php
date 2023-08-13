<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
       'city', 'uf', 'street', 'neighborhood', 'cep',
    ];

    public function cep()
    {
        return $this->belongsTo(CEP::class, 'postal_code', 'id');
    }
}
