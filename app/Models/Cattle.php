<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cattle extends Model
{
    use HasFactory;

    protected $fillable = [
        "literOfMilkProducedPerWeek",
        "kiloOfFeedIngestedPerWeek",
        "weight",
        "birth",
    ];

    protected $primaryKey = "code";
    protected $keyType = "string";
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            if (empty($model->code)) {
                $model->code = (string) Str::uuid();
            }
        });
    }
}
