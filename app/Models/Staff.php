<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staff';
    protected $primaryKey = 'staff_id';
    public $timestamps = false; // Assuming basic schema without created_at/updated_at unless specified

    protected $fillable = [
        'first_name', 'last_name', 'roles', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function customers() {
        return $this->hasMany(Customer::class, 'staff_id');
    }

    public function interactions() {
        return $this->hasMany(Interaction::class, 'staff_id');
    }
}