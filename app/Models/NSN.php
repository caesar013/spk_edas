<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NSN extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alternative',
        'value',
    ];

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }
}
