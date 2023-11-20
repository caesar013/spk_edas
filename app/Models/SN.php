<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SN extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edas',
        'id_alternative',
        'value',
    ];

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'id_alternative', 'id');
    }

    public function edas()
    {
        return $this->belongsTo(Edas::class, 'id_edas', 'id');
    }
}
