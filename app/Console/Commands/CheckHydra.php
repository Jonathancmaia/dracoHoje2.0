<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Hydra;

class CheckHydra extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckHydra:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks hydra value.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://api.mir4global.com/wallet/prices/hydra/lastest';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = floatval(json_decode(curl_exec($ch), true)["Data"]["USDHydraRate"]);

        $hydra = new Hydra;
        $hydra->value = $response;

        if ($hydra->value != 0 || $hydra->value != null){
            $hydra->save();
            exit;
        } else {
            exit;
        }
    }
}
