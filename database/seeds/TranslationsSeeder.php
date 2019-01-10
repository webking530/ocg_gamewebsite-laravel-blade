<?php

use Illuminate\Database\Seeder;
use Models\Translation\TranslationManager;

class TranslationsSeeder extends Seeder
{
    /**
     * @type TranslationManager
     */
    private $manager;

    /**
     * TranslationsSeeder constructor.
     */
    public function __construct(TranslationManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = $this->manager->importTranslations(false)->importedCount();

        echo "Imported: $count translation entries";
    }
}
