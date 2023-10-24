<?php

namespace App\Models;

use App\Models\Lga;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = [
        'state_id',
        'state_name',
    ];



        public function localGovernments()
        {
            return $this->hasMany(Lga::class);
        }


}
