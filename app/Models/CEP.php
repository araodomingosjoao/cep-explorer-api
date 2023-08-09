<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CEP extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $primaryKey = 'cep';
    public $incrementing = false;

    protected $fillable = [
     'city', 'state', 'country',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'postal_code', 'cep');
    }
}
