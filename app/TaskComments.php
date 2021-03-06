<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComments extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_comments';
    
    
    public function user()
    {
        return $this->belongsTo('App\User' , 'created_by');
    }
}
