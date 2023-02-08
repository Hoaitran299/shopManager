<?php

namespace App\Exports;

use App\Models\MstCustomer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomersExport implements FromCollection
{
    /**
     * Inject request to construct
     *
     * @param \Illuminate\Http\Request $request submitted by users
     */
    // public function __construct($addition)
    // {
    //     $this->input = $addition;
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //     $addition = $this->input;
        //     $data = MstCustomer::query();
        //     if (!empty($addition['name'])) {
        //         $data = $data->where('customer_name', 'like', '%' . $addition['name'] . '%');
        //     }
        //     if (!empty($addition['email'])) {
        //         $data = $data->where('email', 'like', '%' . $addition['email'] . '%');
        //     }
        //     if (!empty($addition['address'])) {
        //         $data = $data->where('address', 'like', '%' . $addition['address'] . '%');
        //     }
        //     if ($addition['is_active'] != "") {
        //         $data = $data->where('is_active', (int) $addition['is_active']);
        //     }
        //     $data = $data->select('customer_name','email','tel_num','address')->orderBy('customer_id', 'DESC')->get();
        //    return $data;
        return MstCustomer::all();
    }
}
