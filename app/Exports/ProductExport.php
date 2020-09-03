<?php

namespace App\Exports;

use App\Product_detail;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ProductExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id){
        $this->id=$id;
    }
    public function collection()
    {
        $product=Product_detail::where('id_stock','=',$this->id)
            ->join('product','id_product','=','product.id')
            ->orderBy('product.id','asc')
            ->select('product.id','product.name','product_detail.number','product.price','product_detail.status')->get();
        foreach($product as $p){
            if($p->status ==1 ){
                $p->status = 'Còn hàng';
            }
            else{
                $p->status ='Hết hàng';
            }
        }

//        if($product[0]->status ==0 ){
//            $product[0]->status = 2;
//        }
        return $product;
    }
    public function headings(): array{
        return ['ID','Sản phẩm','Số lượng','Giá bán','Trạng thái'];
    }
}
