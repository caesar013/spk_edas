<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function criterias()
    {
        return $this->hasMany(Criteria::class, 'id_edas', 'id');
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class, 'id_edas', 'id');
    }

    public function decisionmatrices()
    {
        return $this->hasMany(DecisionMatrix::class, 'id_edas', 'id');
    }

    public function apraisalscores()
    {
        return $this->hasMany(ApraisalScore::class, 'id_edas', 'id');
    }

    public function averages()
    {
        return $this->hasMany(Average::class, 'id_edas', 'id');
    }

    public function ndas()
    {
        return $this->hasMany(Nda::class, 'id_edas', 'id');
    }

    public function nsns()
    {
        return $this->hasMany(Nsn::class, 'id_edas', 'id');
    }

    public function nsps()
    {
        return $this->hasMany(Nsp::class, 'id_edas', 'id');
    }

    public function pdas()
    {
        return $this->hasMany(Pda::class, 'id_edas', 'id');
    }

    public function sns()
    {
        return $this->hasMany(Sn::class, 'id_edas', 'id');
    }

    public function sps()
    {
        return $this->hasMany(Sp::class, 'id_edas', 'id');
    }

    public function subcriterias()
    {
        return $this->hasMany(Subcriteria::class, 'id_edas', 'id');
    }
}
