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
}
