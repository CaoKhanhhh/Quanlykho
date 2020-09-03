<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\User;
use App\Product;
use App\Product_detail;
use App\Exports\ProductExport;
class ExportController extends Controller
{
    use Exportable;
    public function export($id,$user_id){
        return Excel::download(new ProductExport($id) ,'Danhsachsanpham.xlsx');
    }
}
