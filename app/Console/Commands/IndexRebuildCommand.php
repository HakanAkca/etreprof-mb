<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use App\Contenu;
use App\Search;


class IndexRebuildCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:rebuild {id?} {--flush}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Supprime et reconstruit l\'index du moteur de recherche';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$search = new Search;

		if ($flush = $this->option('flush'))
		{
			$search->viderIndexContenu();
			$search->rebuildIndexContenu();

		}

    	if ($id = $this->argument('id'))
    	{
    		print $id;
			$contenus = Contenu::where('id', $id)->get();
		}
		else
		{
			$contenus = Contenu::whereIn('etat', ['publie'])->get();
		}

		dump(['nb_contenus' => count($contenus)]);
		//print_r($contenus);

		foreach ($contenus as $contenu)
		{
			$index = $search->indexerContenu($contenu);

			$data = $search->findContenu($contenu->id);
			dump($data);
		}
		return;

    }
}
