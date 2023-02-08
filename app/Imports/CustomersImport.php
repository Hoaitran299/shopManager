<?php

namespace App\Imports;

use App\Models\MstCustomer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MstCustomer([
            'name'     => $row[0],
            'email'    => $row[1], 
            'tel_num' => $row[2], 
            'address' => $row[3],
        ]);
    }
}
