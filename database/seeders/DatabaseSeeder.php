<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'Ambre Briol',
            'email' => 'ambre.briol@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
        ]);

        Jiri::factory(10)
            ->for($user)
            ->create();

        Contact::factory(10)
            ->for($user)
            ->create();

        Project::factory(10)->create();
    }
}
