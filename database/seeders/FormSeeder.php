<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\User;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Create a sample form for each user
            Form::create([
                'user_id' => $user->id,
                'form_data' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => '555-0123',
                    'address' => '123 Test Street',
                    'city' => 'Test City',
                    'state' => 'TC',
                    'zip' => '12345',
                ],
                'status' => 'draft',
                'change_history' => [],
                'notes' => 'Sample form for testing',
            ]);

            // Create a submitted form
            Form::create([
                'user_id' => $user->id,
                'form_data' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => '555-0456',
                    'address' => '456 Main Avenue',
                    'city' => 'Another City',
                    'state' => 'AC',
                    'zip' => '54321',
                ],
                'status' => 'submitted',
                'change_history' => [
                    [
                        'timestamp' => now()->subHours(2)->toIso8601String(),
                        'data' => ['first_name' => $user->name],
                        'description' => 'Initial submission',
                        'previous_status' => 'draft',
                    ],
                ],
                'notes' => 'Submitted form example',
            ]);
        }
    }
}
