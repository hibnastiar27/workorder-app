<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{

    use HasFactory;
    protected $table = 'workorders';
    protected $fillable = [
        'code_workorder',
        'product_name',
        'quantity',
        'deadline',
        'status',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
