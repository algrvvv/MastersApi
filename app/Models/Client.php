<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        "fio", "email", "phone", "birth_date", "id_childdata"
    ];
    protected $casts = [
        'birth_date' => 'datetime:Y-m-d',
    ];

    public function rooms()
    {
        return $this->hasMany(Rooms::class); // один ко многим
    }
}
