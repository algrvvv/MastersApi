<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "desc_data"
    ];

    public function clients(){
        return $this->hasMany(Client::class, "id_childdata");
    }
}
