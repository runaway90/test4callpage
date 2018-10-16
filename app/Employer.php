<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Employer extends Model
{
    const ERROR_EMPLOYER_ID = "Unknowing employer, please check Id";
    const ERROR_EMPLOYER_DATA_REQUIRED = "Employer data is required";
    const ERROR_MORE_THEN_ONCE_IN_DAY = "This employer already have working time in this day";
    const E_ID = 'id_employer';
    const E_NAME ='first_name';
    const E_SURNAME ='second_name';
    const E_VACANCY ='vacancy';

    protected $table = "employer";

    protected $fillable = [
        'first_name',
        'second_name',
        'vacancy',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function workingList()
    {
        return $this->hasMany(WorkingList::class);
    }

    public function getIdentifiedEmployer(Request $request)
    {
        $id = $request->query('id_employer');

        $employer = Employer::where('id', $id);

        if($employer->count < 0){
            return $employer->first();
        }else{
            return null;
        }

    }

    public function create()
    {
        return new Employer();
    }

    public function change(Request $request)
    {

    }

}
