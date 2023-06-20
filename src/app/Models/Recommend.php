<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    public $timestamps = false;

    use HasFactory;

    // テーブル名を指定
    protected $table = 'recommends';

    protected $fillable = [
        'wine_name',
        'english_wine_name',
        'winery',
        'wine_type',
        'wine_image',
        'wine_country',
        'wine_url',
        'years',
        'producer',
        'breed',
        'capacity',
        'one_word',
        'comment'
    ];
}
