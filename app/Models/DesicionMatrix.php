<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesicionMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_criteria',
        'id_alternative',
        'value',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }
}
