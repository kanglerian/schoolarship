<?php

namespace App\Exports;

use App\Schoolarship;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParticipantExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Schoolarship::where('status',true)->get();
    }
}
