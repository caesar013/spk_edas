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
        return $this->belongsTo(Edas::class);
    }

    public function decisionmatrices()
    {
        return $this->hasMany(DecisionMatrix::class);
    }

    public function averages()
    {
        return $this->hasMany(Average::class);
    }

    public function pdas()
    {
        return $this->hasMany(PDA::class);
    }

    public function ndas()
    {
        return $this->hasMany(NDA::class);
    }
}
