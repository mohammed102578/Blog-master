<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['roleName', 'permission'];
    


public function user()
    {
        return $this->belongsTo(User::class);
    }

}