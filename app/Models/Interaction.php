<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    protected $table = 'interaction';
    protected $primaryKey = 'interaction_id';
    public $timestamps = false;

    protected $fillable = [
        'customer_id', 'staff_id', 'date_time', 'interaction_type', 'notes'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}