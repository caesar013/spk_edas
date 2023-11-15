<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edas',
        'code',
        'name',
        'weight',
        'type',
    ];

    public function edas()
    {
        return $this->belongsTo(Edas::class, 'id_edas', 'id');
    }

    public function decisionmatrices()
    {
        return $this->hasMany(DecisionMatrix::class, 'id_criteria', 'id');
    }

    public function averages()
    {
        return $this->hasMany(Average::class, 'id_criteria', 'id');
    }

    public function pdas()
    {
        return $this->hasMany(PDA::class, 'id_criteria', 'id');
    }

    public function ndas()
    {
        return $this->hasMany(NDA::class, 'id_criteria', 'id');
    }
}
