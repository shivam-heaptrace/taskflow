<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return TaskResource::collection(
            $request->user()
                ->tasks()
                ->latest()
                ->paginate(20)
        );
    }

    public function store(StoreTaskRequest $request): TaskResource
    {
        $task = $request->user()->tasks()
            ->create($request->validated());

        return new TaskResource($task);
    }

    public function update(
        UpdateTaskRequest $request,
        Task $task
    ): TaskResource {
        abort_unless(
            $task->user_id === $request->user()->id,
            404
        );

        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task)
    {
        abort_unless(
            $task->user_id === $request->user()->id,
            404
        );

        $task->delete();

        return response()->noContent();
    }
}
