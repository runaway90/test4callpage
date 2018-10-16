<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingList extends Model
{
    const ERROR_FORMAT_DATE = "Date is required and need be correct";
    const ERROR_FORMAT_TIME = "Time start/finish work is required and need format HH:mm";

    const WL_DATE = 'date';
    const WL_FROM = 'work_from';
    const WL_TO = 'work_to';

    protected $table = "working_list";

    protected $fillable = ['date', 'work_from', 'work_to', 'minutes_per_day'];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function getAll()
    {
        return WorkingList::where('id', ">", 0)->get();
    }
}
