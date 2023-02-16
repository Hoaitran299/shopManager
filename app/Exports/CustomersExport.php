<?php

namespace App\Exports;

use App\Models\MstCustomer;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class CustomersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
{
    use Exportable;
    /**
     * Inject request to construct
     *
     * @param \Illuminate\Http\Request $request submitted by users
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Returns headers for report
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Tên khách hàng',
            'Email',
            'TelNum',
            "Địa chỉ",
        ];
    }

    /**
    * @var MstCustomer $customer
    */
    public function map($customer): array
    {
        return [
            $customer->customer_name,
            $customer->email,
            $customer->tel_num,
            $customer->address,
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {       
            $data = $this->data;
            if(empty($data)){
                $data = MstCustomer::query()->select('customer_name','email','tel_num','address')->orderBy('customer_id', 'DESC')->get();
            }
        ;
           return $data;
    }
	/**
	 * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
	 * @return mixed
	 */
	public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet) {
	}
}
