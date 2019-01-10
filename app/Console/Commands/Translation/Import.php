<?php

namespace App\Console\Commands\Translation;

use Illuminate\Console\Command;
use InvalidArgumentException;
use Models\Translation\TranslationManager;

class Import extends Command
{

    protected static $allowedModes = ['all', 'implicit'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation:import {mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the translation from the PHP lang resources to the database.';

    /**
     * @type TranslationManager
     */
    private $manager;


    /**
     * @param TranslationManager $manager
     */
    public function __construct(TranslationManager $manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function handle()
    {

        $mode = strtolower($this->argument('mode'));
        if (! in_array($mode, static::$allowedModes)) {
            throw new InvalidArgumentException("Supported Modes are: " . implode(", ", static::$allowedModes));
        }

        $this->comment('Please Wait...');
        $this->info(
            'Importing Done. ' .
            $this->manager->importTranslations($mode == 'implicit')->importedCount() .
            ' entries have been imported!'
        );
    }

}
