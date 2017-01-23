<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskCategories extends Model
{
    
    protected $fillable = ['name', 'dept_id', 'created_by'];

     /**
     * Get the department that user belongs.
     */
    public function user()
    {
        return $this->belongsTo('App\User' , 'created_by');
    }
}
