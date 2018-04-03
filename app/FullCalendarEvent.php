<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FullCalendarEvent extends Model
{
	/**
	  *[$table description] 
	  * @var string
	  */ 
    protected $table = 'full_calendar_events';
    /**
     * fillable description
     * @var type
     */
    protected $fillable = ['title', 'start', 'end', 'color'];
    //protected $hidden = ['id'];
}
