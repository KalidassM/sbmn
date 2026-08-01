<?php

namespace Database\Seeders;

use App\Models\CommitteeMember;
use App\Models\Event;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            User::factory()->make(['name' => 'Test User'])->toArray() + ['password' => bcrypt('password')]
        );

        // The real committee login used by site/index.html's "Committee Login" button.
        // firstOrCreate keeps this safe to run on every deploy (NIXPACKS_BUILD_CMD).
        User::firstOrCreate(
            ['email' => 'committee@sbmn.local'],
            ['name' => 'Committee', 'password' => 'sbmn@2026']
        );

        // Demo notices/events/committee-members are only useful for local development -
        // skip them in production so real visitors don't see placeholder content.
        if (app()->environment('production')) {
            return;
        }

        if (Notice::count() === 0) {
            Notice::create(['title' => 'Annual General Body Meeting', 'body' => 'All member households are invited to the AGM at the Community Hall. Agenda includes budget review and committee elections.', 'date' => now()->toDateString(), 'pinned' => true]);
            Notice::create(['title' => 'Street light repair completed', 'body' => 'Faulty street lights on 4th Cross have been repaired by the municipal team following our request.', 'date' => now()->subDays(3)->toDateString(), 'pinned' => false]);
        }

        if (Event::count() === 0) {
            Event::create(['title' => 'Community Pongal Celebration', 'date' => now()->addDays(21)->toDateString(), 'venue' => 'Association Community Hall', 'desc' => 'Cultural programme, games, and a community feast for all residents.']);
            Event::create(['title' => 'Street Clean-up Drive', 'date' => now()->addDays(10)->toDateString(), 'venue' => 'Main Road & 3rd Cross', 'desc' => 'Volunteers welcome. Gloves and bags will be provided.']);
        }

        if (CommitteeMember::count() === 0) {
            CommitteeMember::create(['name' => 'President', 'role' => 'President']);
            CommitteeMember::create(['name' => 'Secretary', 'role' => 'Secretary']);
            CommitteeMember::create(['name' => 'Treasurer', 'role' => 'Treasurer']);
            CommitteeMember::create(['name' => 'Joint Secretary', 'role' => 'Joint Secretary']);
        }
    }
}
