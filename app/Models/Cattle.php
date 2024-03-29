<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cattle extends Model
{
    use HasFactory;

    protected $fillable = [
        "literOfMilkProducedPerWeek",
        "kiloOfFeedIngestedPerWeek",
        "weight",
        "birth",
        "downcast",
    ];

    public $timestamps = false;
}
