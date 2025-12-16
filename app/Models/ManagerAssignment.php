<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerAssignment extends Model
{
    use HasFactory;

    protected $table = 'manager_assignment';
    protected $primaryKey = 'assignmet_id'; // Note: matching the typo in your ERD
    public $timestamps = false;

    protected $fillable = [
        'manager_id', 'staff_id', 'date_assign'
    ];
}