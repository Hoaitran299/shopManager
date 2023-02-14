<?php

namespace App\Imports;

use App\Models\MstCustomer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomersImport implements ToModel,SkipsEmptyRows, ShouldQueue, WithChunkReading, WithValidation, WithHeadings, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MstCustomer([
            'customer_name'     => $row[0],
            'email'    => $row[1], 
            'tel_num' => $row[2], 
            'address' => $row[3], 
        ]);
    }

    /**
     * giới hạn số lượng truy vấn
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 200;
    }
    /**
     * This will read the spreadsheet in chunks and keep the memory usage under control.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 200;
    }

    /**
     * Write code on Method
     *
     */
    public function headings(): array
    {
        return ["Tên khách hàng", "Email", "TelNum","Địa chỉ"];
    }

    /**
     * @return int
     */
    public function startRow(): int
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
            '0' => 'required|min:5|max:50',
            '1' => 'required|max:150|email:rfc,dns',
            '2' => 'required|regex:/^([0-9]*)$/|min:10|max:12',
            '3' => 'required|max:100',
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
            "0.max" => trans('name.max'),

            "1.required" => trans('email.required'),
            "1.email" => trans('email.email'),
            "1.exists" => trans('email.exists'),
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
