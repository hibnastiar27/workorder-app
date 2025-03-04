<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'workorder_id',
        'note',
        'created_by',
    ];

    public function workorder()
    {
        return $this->belongsTo(Workorder::class, 'workorder_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
