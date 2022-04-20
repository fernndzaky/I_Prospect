<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'total_working_hours',
        'status_id',
        'signed_by',
    ]; 


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function timesheetDetails() {
        return $this->hasMany(TimesheetDetail::class);
    }
}
