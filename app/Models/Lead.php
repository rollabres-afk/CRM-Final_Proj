<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'lead';
    protected $primaryKey = 'lead_id';
    public $timestamps = false;

    // Use 'last_updated' as the update timestamp if you want Laravel to manage it, 
    // otherwise manual management.
    protected $fillable = [
        'customer_id', 'lead_stage', 'last_updated'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}