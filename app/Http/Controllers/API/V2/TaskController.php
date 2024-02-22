<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $data = [
            'user_id' => $request->userId,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'status' => $request->status == 'active' ? true : false,
            'priority' => $request->priority,
            'start_time' => $request->startTime,
            'end_time' => $request->endTime,
        ];

        try{
            $result = Task::create($data);
        } catch(Exception $e){
            Log::error($e->getMessage());
        }

        
        
        return response($result, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->data);

        return response($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try{
            $task->delete();
            
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response('Internal Server Error', 500);
        }
        return response('Success', 200);
    }
}
