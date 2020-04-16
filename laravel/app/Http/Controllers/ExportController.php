<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\User;

class ExportController extends Controller implements FromCollection, WithHeadings
{
    //
    use Exportable;
    public function collection()
    {
        $user = User::all();
        foreach ($user as $row) {
            $order[] = array(
                '0' => $row->id,
                '1' => $row->Fullname,
                '2' => $row->email,
                '3' => $row->adress,
                '4' => $row->Gender,
                '5' => $row->Tel,
                '6' => $row->Birthday,
                '7' => $row->isAdmin,
            );
        }

        return (collect($order));
    }
    public function headings(): array
    {
        return [
            'id',
            'Tên',
            'Email',
            'Địa chỉ',
            'Giới tính',
            'Số điện thoại',
            'Ngày sinh',
            'Admin',

        ];
    }
    public function export(){
     return Excel::download(new ExportController(), 'user.xlsx');
}
}
