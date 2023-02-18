<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Draco;

class CheckDraco extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckDraco:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks draco value.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://api.mir4global.com/wallet/prices/draco/lastest';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = floatval(json_decode(curl_exec($ch), true)["Data"]["USDDracoRate"]);

        $draco = new Draco;
        $draco->value = $response;

        if ($draco->value != 0 || $draco->value != null){
            $draco->save();
            exit;
        } else {
            exit;
        }
    }
}
