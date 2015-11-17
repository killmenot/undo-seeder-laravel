<?php

namespace Intspirit\UndoSeeder\Console\Seeds;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Database\ConnectionResolverInterface as Resolver;

class SeedUndoCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:seed-undo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Undo seed records in the database';

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface
     */
    protected $resolver;

    /**
     * Create a new database seed command instance.
     *
     * @param  \Illuminate\Database\ConnectionResolverInterface  $resolver
     * @return void
     */
    public function __construct(Resolver $resolver)
    {
        parent::__construct();

        $this->resolver = $resolver;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (! $this->confirmToProceed()) {
            return;
        }

        $this->resolver->setDefaultConnection($this->getDatabase());

        $this->getSeeder()->undo();
    }

    /**
     * Get a seeder instance from the container.
     *
     * @return \Intspirit\UndoSeeder\UndoSeeder
     */
    protected function getSeeder()
    {
        $class = $this->laravel->make($this->input->getOption('class'));

        return $class->setContainer($this->laravel)->setCommand($this);
    }

    /**
     * Get the name of the database connection to use.
     *
     * @return string
     */
    protected function getDatabase()
    {
        $database = $this->input->getOption('database');

        return $database ?: $this->laravel['config']['database.default'];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder', 'DatabaseSeeder'],

            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to undo seed'],

            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
        ];
    }
}
