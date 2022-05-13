<?php

namespace App\Imports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;WithHeadingRow

class ProfilesImport implements ToModel, WithStartRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*$this->transformDate \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])Y/m/d*/ 

    public function model(array $row)
    {
        return new Profile([
            'email' => trim($row[0]),
            'prenom' => $row[1],
            'nom' => $row[2],
            'telephone' => $row[3],
            'date_debut_experience' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y/m/d'),
            'formation' => $row[5],
            'skill1' => $row[6],
            'skill2' => $row[7],
            'skill3' => $row[8],
            'skill4' => $row[9],
            'skill5' => $row[10],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }/**/

    public function uniqueBy()
    {
        return 'nom' && 'prenom';
    }
}
