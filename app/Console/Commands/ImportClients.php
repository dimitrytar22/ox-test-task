<?php

namespace App\Console\Commands;

use App\Http\Services\ClientsAPIService;
use App\Http\Services\ClientService;
use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Console\Command;

class ImportClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import clients and their orders from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo ClientService::importClients() ? "Imported successfully" : "Import Error";
    }
}
