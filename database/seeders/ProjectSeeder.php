<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = ['Work', 'Fitness', 'Household', 'Family'];

        foreach ($projects as $projectName) {
            Project::factory()->create([
                'name' => $projectName,
                'user_id' => 1,
            ]);
        }
    }
}
