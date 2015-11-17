<?php

namespace Intspirit\UndoSeeder;

use Illuminate\Database\Seeder;

class UndoSeeder extends Seeder
{
    /**
     * Alias for running the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->up();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Undo the database seeds.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    /**
     * undo seed the given connection from the given path.
     *
     * @param  string  $class
     * @return void
     */
    public function undo($class)
    {
        $this->resolve($class)->down();

        if (isset($this->command)) {
            $this->command->getOutput()->writeln("<info>Undo seeded:</info> $class");
        }
    }
}
