<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\cart;
use App\Models\friend;
use App\Models\bookmark;
use App\Models\Order;
use App\Models\MyCourses;
use App\Models\Coupon;




use App\Models\User;
use App\Models\PDFGen;

use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;





class PdfController extends Controller
{
    public function generatePdf(){
        $data = ' Weclome';
        $pdf = Pdf::loadView('billing_invoice', compact('data'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice.pdf');
    
    }
    public function downloadPdf(){

        return view('voucher');
    
    }
}
