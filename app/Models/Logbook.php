<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $table = 'logbook';

    protected $fillable = [
        'id', 'id_user', 'id_status', 'description', 'execution_time', 'start_time', 'end_time', 'results', 'constraint'
    ];
}
