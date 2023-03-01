<?php

namespace App\Http\Controllers;

use App\Models\Hydra;
use App\Http\Requests\StoreHydraRequest;

class HydraController extends Controller
{
    public function __Construct (Hydra $hydra){
        $this->Hydra = $hydra;
    }

    function getHydraDaily(){
        return $this->Hydra->whereRaw('`created_at` > (NOW() - INTERVAL 1 DAY)')->get();
    }

    function getHydraWeekly(){
        return $this->Hydra->whereRaw('`created_at` > (NOW() - INTERVAL 7 DAY)')->get();
    }

    function getHydraMonthly(){
        return $this->Hydra->whereRaw('`created_at` > (NOW() - INTERVAL 30 DAY)')->get();
    }

    function getHydraAll(){
        return $this->Hydra->all();
    }
}
