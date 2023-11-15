<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edas',
        'name',
    ];

    public function edas()
    {
        return $this->belongsTo(Edas::class);
    }

    public function decisionmatrices()
    {
        return $this->hasMany(DecisionMatrix::class);
    }

    public function pdas()
    {
        return $this->hasMany(PDA::class);
    }

    public function ndas()
    {
        return $this->hasMany(NDA::class);
    }

    public function sps()
    {
        return $this->hasMany(SP::class);
    }

    public function sns()
    {
        return $this->hasMany(SN::class);
    }

    public function nsps()
    {
        return $this->hasMany(NSP::class);
    }

    public function nsns()
    {
        return $this->hasMany(NSN::class);
    }

    public function apraisalscores()
    {
        return $this->hasMany(ApraisalScore::class);
    }
}
