<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edas',
        'id_criteria',
        'id_alternative',
        'id_subcriteria',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'id_criteria', 'id');
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'id_alternative', 'id');
    }

    public function edas()
    {
        return $this->belongsTo(Edas::class, 'id_edas', 'id');
    }

    public function subcriteria()
    {
        return $this->belongsTo(Subcriteria::class, 'id_subcriteria', 'id');
    }
}
