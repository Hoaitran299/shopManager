<?php

namespace App\Imports;

use App\Models\MstCustomer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\ImportFailed;

class CustomersImport implements ToModel,SkipsEmptyRows, ShouldQueue, WithChunkReading, WithValidation, SkipsOnFailure, WithHeadingRow
{
    use Importable, SkipsFailures;
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

    /**
     * chèn hàng loạt
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 200;
    }

    public function chunkSize(): int
    {
        return 200;
    }

    /**
     * Start from row 2, avoid header
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 2;
    }

    /**
     * Validate row input
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '0' => 'required|min:5',
            '1' => 'required|max:255|email:rfc,dns|unique:mst_customer,email',
            '2' => 'required|regex:/^([0-9]*)$/|min:10|max:12',
            '3' => 'required|max:255',
        ];
    }
    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return ['0' => 'customer_name'];
        return ['1' => 'email'];
        return ['2' => 'tel_num'];
        return ['3' => 'address'];
    }
    /**
     * Custom message
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            "0.required" => trans('CustomerRequired'),
            "0.min" => trans('CustomerMinlength'),

            "1.required" => trans('email.required'),
            "1.email" => trans('email.email'),
            "1.exists" => trans('email.exists'),
            "1.unique" => trans('email.unique'),
            "1.max" =>trans('email.max'),

            "2.required" => trans('tel_num.required'),
            "2.regex" => trans('tel_num.regex'),
            "2.min" => trans('tel_num.regex'),
            "2.max" => trans('tel_num.regex'),

            "3.required" => trans('address.required'),
            "3.max" => trans('address.max'),
        ];
    }
}
