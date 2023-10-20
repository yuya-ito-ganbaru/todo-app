<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Folder;
use App\Models\User;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
            Folder::create([
                'title' => $title,
                'user_id' => $user->id,
            ]);
        }
    }
}
