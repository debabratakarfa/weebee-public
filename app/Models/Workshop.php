<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Workshop extends Model
{
    protected $fillable = [
        'id', 'name', 'start', 'end', 'event_id', 'name', 'created_at', 'updated_at'
    ];
}
