<?php

namespace App\Imports;

use App\Models\Skill;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SkillsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Skill([
            'skill' => $row[0],
        ]);
    }
    
    public function startRow(): int
    {
        return 2;
    }
}
