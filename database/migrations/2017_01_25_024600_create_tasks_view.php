<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        SELECT t.id,t.description, t.category_id, c.name as category, t.notif_depts, t.notif_users, 
t.notif_users_status, t.notif_dept_status,t.`status`,t.created_at, t.due_date, t.access_level,
 t.priority, t.assignee, (SELECT CONCAT(u.first_name , ' ', u.last_name)  WHERE u.id = t.assignee) as assignee_name,  
 t.created_by, (SELECT CONCAT(v.first_name , ' ', v.last_name)  WHERE v.id = t.created_by) as creator_name,
 d.id as assignee_department_id, d.name as assignee_department ,e.id as creator_department_id, e.name as creator_department
 from tasks t 
LEFT JOIN  users u ON   u.id = t.assignee 
LEFT JOIN users v ON v.id = t.created_by 
LEFT JOIN departments d ON u.dept = d.id
LEFT JOIN departments e ON v.dept = e.id
LEFT JOIN task_categories c ON t.category_id = c.id 
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
