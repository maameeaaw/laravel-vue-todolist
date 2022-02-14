<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'task',
        'task_status',
        'created_at'
    ];

    public function fetchTask()
    {
        try {
            $dataList = $this->select('*')->where('task_status', '=', 'doing')->get();
            return  $dataList;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }

    public function taskComplete()
    {
        try {
            $dataList = $this->select('*')->where('task_status', '=', 'done')->get();
            return  $dataList;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }

    public function showTask($id)
    {
        try {
            $data = $this->select('*')->where("id", "=", $id)->get();
            return $data;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }

    public function addTask($request)
    {
        try {
            $data = $this->insert([
                "task" => $request['task'],
                "task_status" => 'doing',
                "created_at" => Carbon::now()
            ]);
            return $data;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }

    public function updateTask($request, $id)
    {
        try {
            $this->where('id', $id)->update([
                "task" => $request['task']
            ]);
            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }

    public function doneTask($id)
    {
        try {
            $this->where('id', $id)->update([
                "task_status" => 'done'
            ]);
            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }

    public function deleteTask($id)
    {
        try {
            $this->where('id', $id)->delete();
            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }
}
