<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    public $timestamps = false; 

    protected $fillable = [
        'first_name', 'last_name', 'contact_number', 'email', 'address', 'status', 'staff_id'
    ];

    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function lead() {
        return $this->hasOne(Lead::class, 'customer_id');
    }

    public function interactions() {
        return $this->hasMany(Interaction::class, 'customer_id');
    }
}