<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        //ログインユーザーを取得
        $user = Auth::user();
        //ログインユーザーに紐づくフォルダを一つ取得する
        $folder = $user->folders()->first();

        //一つもフォルダがなければホームページにレスポンス
        if (is_null($folder)) {
            return view('home');
        }
        //フォルダがあればタスク一覧にリダイレクト
        return redirect()->route('tasks.index', ['folder' => $folder->id]);

    }
}
