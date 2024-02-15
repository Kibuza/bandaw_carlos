<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;
    protected $table = "instruments";

    public $timestamps = false;

    protected $primaryKey= "id";

    protected $fillable = [
        'family',
        'type',
        'brand',
        'model',
        'serial_number',
        'acquisition_date',
        'state',
        'comment',
        'image',
        'band_id',
    ];
}
