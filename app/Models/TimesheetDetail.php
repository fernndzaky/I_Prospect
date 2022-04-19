<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'timesheet_id',
        'work_type_id',
        'work_description',
        'attachment',
        'workinghours',
    ]; 

    public function workType() {
        return $this->belongsTo(WorkType::class);
    }
    

    public function timesheet() {
        return $this->belongsTo(Timesheet::class);
    }
}
