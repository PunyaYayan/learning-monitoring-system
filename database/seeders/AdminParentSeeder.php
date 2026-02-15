<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ParentModel;

class AdminParentSeeder extends Seeder
{
    public function run(): void
    {
        $parents = User::where('role', 'ortu')->get();

        foreach ($parents as $user) {
            ParentModel::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }
    }
}
