<?php

use Models\Gaming\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badges = [];

        for ($i = 1; $i <= 6; $i++) {
            $badges[] = Badge::create([
                'name' => "Sample Badge $i",
                'slug' => "sample-badge-$i",
                'description' => "Sample badge $i description. Complete X condition to earn this!",
                'image_url' => 'img/badges/placeholder.png',
                'relevance' => 1
            ]);
        }

        $users = \Models\Auth\User::all();

        foreach ($users as $user) {
            foreach ($badges as $badge) {
                DB::table('badge_user')->insert([
                    'badge_id' => $badge->id,
                    'user_id' => $user->id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
