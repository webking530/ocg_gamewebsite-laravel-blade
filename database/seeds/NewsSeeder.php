<?php

use Models\News\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::create([
            'name' => 'News number one',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ',
            'order' => 1,
            'date_from' => \Carbon\Carbon::now(),
            'date_to' => \Carbon\Carbon::now()->addMonth(),
        ]);

        News::create([
            'name' => 'News number two',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ',
            'order' => 2,
            'date_from' => \Carbon\Carbon::now(),
            'date_to' => \Carbon\Carbon::now()->addMonth(),
        ]);
    }
}
