<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'callbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['task', 'activity_history'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
