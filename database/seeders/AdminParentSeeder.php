<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParentModel;

class AdminParentSeeder extends Seeder
{
    public function run(): void
    {
        ParentModel::create([
            'user_id' => 5,
            'name' => 'Bapaknya Tegar',
            'email' => 'tegar@ar.com',
        ]);

        ParentModel::create([
            'user_id' => 7,
            'name' => 'Bapaknya Apip',
            'email' => null,
        ]);
    }
}
