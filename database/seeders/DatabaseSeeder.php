<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Jiri;
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

        User::factory()->create([
            'name' => 'Ambre Briol',
            'email' => 'ambre.briol@gmail.com',
            'password' => password_hash('123456789', PASSWORD_BCRYPT),
        ]);

        User::factory(10)->create();
        Jiri::factory(10)->create();
        Jiri::factory()->create()->where('jiris.user_id' === 1);

        Contact::factory(10)->create();
    }
}
