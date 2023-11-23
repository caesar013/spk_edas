<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_criteria',
        'id_edas',
        'value',
        'information',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'id_criteria', 'id');
    }

    public function edas()
    {
        return $this->belongsTo(Edas::class, 'id_edas', 'id');
    }

    public function decisionmatrices()
    {
        return $this->hasMany(DecisionMatrix::class, 'id_subcriteria', 'id');
    }
}
