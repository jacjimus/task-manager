<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    
    //chedule types
    const TYPE_DYNAMIC = 'dynamic';
    const TYPE_STATIC = 'static';
    //dynamic repeat types
    const DYNAMIC_ONCE = 'once';
    const DYNAMIC_DAILY = 'daily';
    const DYNAMIC_weekly = 'weekly';
    
    //schedule status
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    protected $table = 'notification_schedules';
    
    
}
