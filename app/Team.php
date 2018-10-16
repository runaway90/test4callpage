<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    const ERROR_TEAM_ID = "Unknowing team, please check Id";

    const TEAM_ID = 'id_team';
    const TEAM_NAME ='name';
    const TEAM_CITY ='city';
    const TEAM_DESCRIPTION ='description';

    protected $table = "team";

    protected $fillable = [
        'name',
        'city',
        'description',
    ];

    protected $dates = ['available_from', 'available_to'];

    public function employers()
    {
        return $this->hasMany(Employer::class);
    }


}
