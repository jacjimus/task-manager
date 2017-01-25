<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send(Request $request){
    $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('tasks@cytonn.com', 'Task Manager');
            $message->subject($subject);
            $message->to('chrisn@scotch.io');

        });

        return response()->json(['message' => 'Request completed']);
            
}
}
