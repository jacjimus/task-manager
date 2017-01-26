<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyTasksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        SELECT t.assignee, CONCAT(u.first_name, ' ', u.last_name) as fullname, 
 (SELECT COUNT(id) FROM tasks  WHERE status = 'On-going' AND assignee = t.assignee AND created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK) ) as status_ongoing_task,  
(SELECT COUNT(id) FROM tasks  WHERE (status = 'New' OR status = 'On-going') AND assignee = t.assignee AND created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK) ) as status_assigned_tasks,
(SELECT COUNT(id) FROM tasks  WHERE status = 'Completed' AND assignee = t.assignee AND created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK) ) as status_completed_tasks,
(SELECT COUNT(id) FROM tasks  WHERE status != 'Completed' AND due_date < now() AND assignee = t.assignee AND created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK) ) as status_due_tasks

 from tasks t 
LEFT JOIN  users u ON   u.id = t.assignee 
group by t.assignee , u.first_name, u.last_name  
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
