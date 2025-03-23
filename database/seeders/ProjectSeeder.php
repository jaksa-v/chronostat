<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TimeEntry;
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
            $project = Project::factory()->create([
                'name' => $projectName,
                'user_id' => 1,
            ]);

            // Create 3-7 random time entries for this project
            $numEntries = rand(3, 7);
            for ($i = 0; $i < $numEntries; $i++) {
                // Generate a random date within the past month
                $startDate = now()->subDays(rand(1, 30))->subHours(rand(1, 12));
                $duration = rand(15, 180); // Duration in minutes (15 min to 3 hours)

                // Create the time entry
                TimeEntry::factory()->create([
                    'project_id' => $project->id,
                    'user_id' => 1,
                    'start_time' => $startDate,
                    'end_time' => (clone $startDate)->addMinutes($duration),
                    'duration' => $duration,
                ]);
            }

        }
    }
}
