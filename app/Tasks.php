<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //Task access levels
    CONST PUBLIC_ACCESS = "Public";
    CONST PRIVATE_ACCESS = "Private";
    // Task priorities
    CONST PRIORITY_LOW = "Low";
    CONST PRIORITY_NORMAL = "Normal";
    CONST PRIORITY_HIGH = "High";
    // Task Status
    CONST STATUS_NEW = "New";
    CONST STATUS_ON_GOING= "On-going";
    CONST STATUS_COMPLETE = "Complete";
    CONST STATUS_DEW = "Dew";
    
    
    public $comment;
    
    
    public $attachment;
    /**
     * Get the category that task belongs.
     */
    public function category()
    {
        return $this->belongsTo('App\TaskCategories' , 'category_id');
    }
    
    /**
     * Get the user that task belongs.
     */
    public function user()
    {
        return $this->belongsTo('App\User' , 'created_by');
    }
}
