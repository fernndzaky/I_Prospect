<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ]; 

    public function timesheetDetails() {
        return $this->hasMany(TimesheetDetail::class);
    }
}
