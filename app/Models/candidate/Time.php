<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $fillable = ['time_range', 'allocation_from', 'allocation_to'];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
