<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\User;
class ExportController extends Controller implements FromCollection, WithHeadings
{
    use Exportable;
    public function collection()
    {
       $user_exports=User::where('role','=',2)->get();
        foreach ($user_exports as $u){
            if($u->gender ==1 ){
                $u->gender ='Nam';
            }
            if($u->gender ==2 ){
                $u->gender = 'Nữ';
            }
        }
       foreach ($user_exports as $key => $row){
           $user_export[] = array(
                   '0' => $key+1,
                   '1' => $row->id,
                   '2' => $row->name,
                   '3' => $row->date_of_births,
                   '4' => $row->gender,
                   '5' => $row->email,
           );
       }
        return (collect($user_export));
    }

    public function headings(): array
    {
        return [
            'Stt',
            'Id',
            'Tên',
            'Ngày sinh',
            'Giới tính',
            'Email'
        ];
    }
    public function export(){
        return Excel::download(new ExportController(),'Danhsachquankho.xlsx');
    }
}
