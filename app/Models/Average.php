<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Average extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_criteria',
        'value',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'id_criteria', 'id');
    }

    public function edas()
    {
        return $this->belongsTo(Edas::class, 'id_edas', 'id');
    }
}
