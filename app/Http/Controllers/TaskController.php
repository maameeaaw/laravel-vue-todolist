<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->apiResponseCode = 200;
        $this->apiResponseData = null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskList = $this->task->fetchTask();
        if ($taskList) {
            $this->apiResponseData['data'] = $taskList;
        } else {
            $this->apiResponseCode = 500;
            $this->apiResponseData['error'] = ['message' => "Error from fetch Task list"];
        }
        return response()->json($this->apiResponseData,  $this->apiResponseCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $taskItem = $this->task->addTask($request->all());
        if ($taskItem) {
            $this->apiResponseData['data'] = $taskItem;
        } else {
            $this->apiResponseCode = 500;
            $this->apiResponseData['error'] = ['message' => "Error from fetch Task list"];
        }
        return response()->json($this->apiResponseData,  $this->apiResponseCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $taskItem = $this->task->showTask($id);
        if ($taskItem) {
            $this->apiResponseData['data'] = $taskItem;
        } else {
            $this->apiResponseCode = 500;
            $this->apiResponseData['error'] = ['message' => "Error from fetch Task list"];
        }
        return response()->json($this->apiResponseData,  $this->apiResponseCode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $taskItem = $this->task->updateTask($request->all(), $id);

        if ($taskItem) {
            $this->apiResponseData['data'] = $taskItem;
        } else {
            $this->apiResponseCode = 500;
            $this->apiResponseData['error'] = ['message' => "Error from fetch Task list"];
        }
        return response()->json($this->apiResponseData,  $this->apiResponseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taskItem = $this->task->deleteTask($id);

        if ($taskItem) {
            $this->apiResponseData['data'] = $taskItem;
        } else {
            $this->apiResponseCode = 500;
            $this->apiResponseData['error'] = ['message' => "Error from fetch Task list"];
        }
        return response()->json($this->apiResponseData,  $this->apiResponseCode);
    }

    public function done($id)
    {
        $taskItem = $this->task->doneTask($id);

        if ($taskItem) {
            $this->apiResponseData['data'] = $taskItem;
        } else {
            $this->apiResponseCode = 500;
            $this->apiResponseData['error'] = ['message' => "Error from fetch Task list"];
        }
        return response()->json($this->apiResponseData,  $this->apiResponseCode);
    }

    public function doneList()
    {
        $taskList = $this->task->taskComplete();
        if ($taskList) {
            $this->apiResponseData['data'] = $taskList;
        } else {
            $this->apiResponseCode = 500;
            $this->apiResponseData['error'] = ['message' => "Error from doneList Task list"];
        }
        return response()->json($this->apiResponseData,  $this->apiResponseCode);
    }
}
