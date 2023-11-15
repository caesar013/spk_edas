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
        return $this->belongsTo(User::class);
    }

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }
}
