<?php

namespace App\Imports;

use App\Schoolarship;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

class ParticipantImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $lastCode = DB::table('schoolarship')
        ->select(DB::raw('MAX(CAST(SUBSTRING(code, 1) AS UNSIGNED)) AS last_trx'))
        ->value('last_trx');

        return new Schoolarship([
            'code' => $lastCode + 1,
            'name' => $row[0],
            'school' => $row[1],
        ]);
    }
}
