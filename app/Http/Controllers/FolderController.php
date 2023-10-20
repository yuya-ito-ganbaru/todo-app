<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    //
    public function showCreateForm() {
        return view('folders/create');
    }

    public function create(CreateFolder $request) {
        $folder = new Folder;
        //タイトルに入力値を入れる
        $folder->title = $request->title;
        //データベースに保存
        //$folder->save();
        $folder = Auth::user()->folders()->save($folder);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
