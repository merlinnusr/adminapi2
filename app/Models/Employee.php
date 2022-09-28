<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'company_id',
        'phone',
    ];

    /**
     * Get the user that owns the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
