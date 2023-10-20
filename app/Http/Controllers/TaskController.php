<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Folder $folder) {

        //ログインユーザーフォルダの全件取得
        $folders = Auth::user()->folders()->get();

        //選択したフォルダのタスクデータを取得する
        $tasks = $folder->tasks()->get();

        return view('tasks/index', [
            'folders'=>$folders,
            'current_folder_id'=>$folder->id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder) {

        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }
    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request) {
        //$current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task) {
        //$task = Task::find($task_id);

        $this->checkRelation($folder, $task);
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }
    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, Task $task, EditTask $request) {
        $this->checkRelation($folder, $task);
        //dd($_POST);
        // 1
        //$task = Task::find($task_id);
        // 2
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();
        // 3
        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task) {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
