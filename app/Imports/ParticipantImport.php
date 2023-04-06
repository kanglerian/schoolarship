<?php

namespace App\Imports;

use App\Schoolarship;
use Maatwebsite\Excel\Concerns\ToModel;

class ParticipantImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Schoolarship([
            'code' => $row[0],
            'name' => $row[1],
            'school' => $row[2],
        ]);
    }
}
