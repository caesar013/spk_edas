<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edas',
        'code',
        'name',
    ];

    public function edas()
    {
        return $this->belongsTo(Edas::class, 'id_edas', 'id');
    }

    public function decisionmatrices()
    {
        return $this->hasMany(DecisionMatrix::class, 'id_alternative', 'id');
    }

    public function pdas()
    {
        return $this->hasMany(PDA::class, 'id_alternative', 'id');
    }

    public function ndas()
    {
        return $this->hasMany(NDA::class, 'id_alternative', 'id');
    }

    public function sps()
    {
        return $this->hasMany(SP::class, 'id_alternative', 'id');
    }

    public function sns()
    {
        return $this->hasMany(SN::class, 'id_alternative', 'id');
    }

    public function nsps()
    {
        return $this->hasMany(NSP::class, 'id_alternative', 'id');
    }

    public function nsns()
    {
        return $this->hasMany(NSN::class, 'id_alternative', 'id');
    }

    public function apraisalscores()
    {
        return $this->hasMany(ApraisalScore::class, 'id_alternative', 'id');
    }
}
