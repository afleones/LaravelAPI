<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunCommands extends Command
{
    protected $signature = 'db:configure';

    protected $description = 'Instalar Base de datos con datos de prueba...';

    public function handle()
    {
        // Array de comandos que deseas ejecutar
        $commands = [
            'migrate',
            'db:seed',
        ];

        foreach ($commands as $command) {
            $this->line("Executing command: {$command}");
            $this->callSilent($command); // Ejecuta el comando sin mostrar la salida en la consola
        }

        $this->info('Base de datos ' . env('DB_DATABASE') . ' configurada correctamente');
    }
}
