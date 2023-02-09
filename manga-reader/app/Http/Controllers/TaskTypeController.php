<?php

namespace App\Http\Controllers;

use App\Services\TaskTypeService;
use Illuminate\Http\Request;

class TaskTypeController extends Controller
{
    //
    protected $taskTypeService;
    public function __construct(TaskTypeService $taskTypeService)
    {
        $this->taskTypeService = $taskTypeService;
    }

    public function index()
    {
        return response()->json($this->taskTypeService->index());
    }

    public function create(Request $request)
    {
        $taskType = $this->taskTypeService->create($request);
        $taskType->name = 'Test';

        return response()->json($taskType);
    }

    public function updateTaskType($id, Request $request)
    {
        $taskType = $this->taskTypeService->updateTaskType($id, $request);
        return response()->json($taskType);
    }

    public function delete($id)
    {
        return $this->taskTypeService->delete($id);
    }
}
