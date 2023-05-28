<?php

namespace App\Http\Controllers;
use App\Models\Draco;

use App\Http\Requests\StoreDracoRequest;

class DracoController extends Controller
{
    public function __Construct (Draco $draco){
        $this->Draco = $draco;
    }

    private function compressData ($interval) {

        $interval = $interval;
        
        if ($interval === null){
            $query = $this->Draco->query();
            $count = $query->count();
            $interval = max(1, ceil($count / 48));
        } else {
            $query = $this->Draco->whereRaw('`created_at` > (NOW() - INTERVAL ' . $interval . ' DAY)');
            $count = $query->count();
        }

        if ($count > $interval) {
            $groupedData = $query->selectRaw('FLOOR((row_num + 1) / ?) AS group_number, AVG(value) as average_value, MIN(created_at) as min_created_at', [$interval])
                ->fromSub(function ($query) use ($interval) {
                    $query->select('value', $this->Draco->raw('CAST(`created_at` AS DATETIME) AS created_at'), $this->Draco->raw('(@row_num:=@row_num + 1) AS row_num'))
                        ->from('dracos')
                        ->crossJoin($this->Draco->raw('(SELECT @row_num:=0) AS rn'))
                        ->whereRaw('`created_at` > (NOW() - INTERVAL ' . $interval . ' DAY)')
                        ->orderBy('created_at');
                }, 'sub')
                ->groupBy('group_number')
                ->get();

            // Formatação dos dados no formato desejado
            $formattedData = $groupedData->map(function ($item) {
                return [
                    'value' => $item->average_value,
                    'created_at' => date('Y-m-d\TH:i:s.v\Z', strtotime($item->min_created_at)),
                    'updated_at' => date('Y-m-d\TH:i:s.v\Z', strtotime($item->min_created_at))
                ];
            });

            return $formattedData;
        } else {
            return $query->get();
        }
    }

    function getDracoDaily(){
        return $this->Draco->whereRaw('`created_at` > (NOW() - INTERVAL 1 DAY)')->get();
    }

    function getDracoWeekly(){
        return $this->compressData(7);
    }

    function getDracoMonthly(){
        return $this->compressData(30);
    }

    function getDracoAll(){
        return $this->compressData(null);
    }
}
