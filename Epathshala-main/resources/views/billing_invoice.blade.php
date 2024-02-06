<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\MyCourses;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

$user = session('user'); // Get the logged-in user
$userId = $user['id'];
$userEmail = $user['email'];
$allCoupon= Coupon::where('user_id',$userId)->get();
$orderList = Order::where('user_id',$userId)->get();

$orderAll = Order::where('user_id',$userId)->first();
$offer = 0;
foreach($allCoupon as $item)
         {
          $temp= Offer::where('coupon_code',$item['coupon_code'])->first();
          $offer = $offer + $temp['amount'];

         }

$total = 0;

foreach($orderList as $ord)
         {
          $temp= Product::where('id',$ord['product_id'])->first();
          $total = $total + $temp['price'];

         }

$dt = new DateTime();
if (isset($orderAll)) {
    $addr = $orderAll['address'];
} else {
    $addr = "Dhaka";
}

?>


<style>

* {font-family: 'Roboto', sans-serif;line-height: 26px;font-size: 15px}
    .custom--table {width: 100%;color: inherit;vertical-align: top;font-weight: 400;border-collapse: collapse;border-bottom: 2px solid #ddd;margin-top: 0;}
    .table-title{font-size: 18px;font-weight: 600;line-height: 32px;margin-bottom: 10px}
    .custom--table thead {font-weight: 700;background: inherit;color: inherit;font-size: 16px;font-weight: 500}
    .custom--table tbody {border-top: 0;overflow: hidden;border-radius: 10px;}
    .custom--table thead tr {border-top: 2px solid #ddd;border-bottom: 2px solid #ddd;text-align: left}
    .custom--table thead tr th {border-top: 2px solid #ddd;border-bottom: 2px solid #ddd;text-align: left;font-size: 16px;padding: 10px 0}
    .custom--table tbody tr {vertical-align: top;}
    .custom--table tbody tr td {font-size: 14px;line-height: 18px vertical-align:top 10}
    .custom--table tbody tr td:last-child{padding-bottom: 10px;}
    .custom--table tbody tr td .data-span {font-size: 14px;font-weight: 500;line-height: 18px;}
    .custom--table tbody .table_footer_row {border-top: 2px solid #ddd;margin-bottom: 10px !important;padding-bottom: 10px !important}
    /* invoice area */
    .invoice-area {padding: 10px 0}
    .invoice-wrapper {max-width: 650px;margin: 0 auto;box-shadow: 0 0 10px #f3f3f3;padding: 0px;}
    .invoice-header {margin-bottom: 40px;}
    .invoice-flex-contents {display: flex;align-items: center;justify-content: space-between;gap: 24px;flex-wrap: wrap;}
    .invoice-title {font-size: 25px;font-weight: 700}
    .invoice-details {margin-top: 20px}
    .invoice-details-flex {display: flex;align-items: flex-start;justify-content: space-between;gap: 24px;flex-wrap: wrap;}
    .invoice-details-title {font-size: 18px;font-weight: 700;line-height: 32px;color: #333;margin: 0;padding: 0}
    .invoice-single-details {padding:10px}
    .details-list {margin: 0;padding: 0;list-style: none;margin-top: 10px;}
    .details-list .list {font-size: 14px;font-weight: 400;line-height: 18px;color: #666;margin: 0;padding: 0;transition: all .3s;}
    .details-list .list strong {font-size: 14px;font-weight: 500;line-height: 18px;color: #666;margin: 0;padding: 0;transition: all .3s}
    .details-list .list a {display: inline-block;color: #666;transition: all .3s;text-decoration: none;margin: 0;line-height: 18px}
    .item-description {margin-top: 10px;padding:10px;}
    .products-item {text-align: left}
    .invoice-total-count .list-single {display: flex;align-items: center;gap: 30px;font-size: 16px;line-height: 28px}
    .invoice-subtotal {border-bottom: 2px solid #ddd;padding-bottom: 15px}
    .invoice-total {padding-top: 10px}
    .invoice-flex-footer {display: flex;align-items: flex-start;justify-content: space-between;flex-wrap: wrap;gap: 30px;}
    .single-footer-item {flex: 1}
    .single-footer {display: flex;align-items: center;gap: 10px}
    .single-footer .icon {display: flex;align-items: center;justify-content: center;height: 30px;width: 30px;font-size: 16px;background-color: #000e8f;color: #fff}
    </style>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Billing Invoice - Webjourney</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
</head>
<body>

<!-- Invoice area Starts -->
<div class="invoice-area">
    <div class="invoice-wrapper">
        <div class="invoice-header">
            <h1 class="invoice-title" style="text-align:center;">Invoice E-Pathshala</h1>
            <hr>
        </div>
        <div class="invoice-details">
            <div class="invoice-details-flex">
                <div class="invoice-single-details">
                    <h2 class="invoice-details-title">Bill To:</h2>
                    <ul class="details-list">
                        <li class="list">{{$user['name']}}</li>
                        <li class="list"> <a href="#">{{$userEmail}} </a> </li>
                        <li class="list"> <a href="#">{{$user['phone']}}</a> </li>
                    </ul>
                </div>
                <div class="invoice-single-details">
                    <h4 class="invoice-details-title">Ship To:</h4>
                    <ul class="details-list">
                        <li class="list"> <strong>City: </strong>{{$addr}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="item-description">
            <h5 class="table-title">Payment Summery</h5>
            <table class="custom--table">
                <!-- For Loop Here -->
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Total</th>
                </tr>
                </thead>
                @foreach ($orderList as $item)
                    <?php
                        $productAll = Product::where('id', $item['product_id'])->first(); // Use first() instead of get()
                    ?>

                    <tbody>
                <tr>
                    <th>{{$productAll['name']}}</th>
                    <th>{{$productAll['price']}}</th>
                </tr>
                    </tbody>

                    @endforeach
                    <br>
              
                    <tr class="table_footer_row">
                    <td colspan="3"><strong>Coupon Dicount</strong></td>
                    <td><strong>${{$offer}}</strong></td>
                </tr>
                
                <tr class="table_footer_row">
                    <td colspan="3"><strong>Package Fee</strong></td>
                    <td><strong>${{$total-$offer}}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="item-description">
            <div class="table-responsive">
                <h5 class="table-title">Orders Details</h5>
                <table class="custom--table">
                    <thead class="head-bg">
                    <tr>
                        <th>Buyer Details</th>
                        <th>Date & Schedule</th>
                        <th>Amount Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="data-span">Name:</span>{{$user['name']}}<br>
                            <span class="data-span">Email:</span>{{$userEmail}} <br>
                            <span class="data-span">Phone: </span>{{$user['phone']}} <br>
                            <span class="data-span">Address:</span>{{$addr}}
                        </td>
                        <td>
                            {{$dt->format('Y-m-d H:i:s')}}
                        </td>
                        <td>
                            <span class="data-span"> Package Fee:</span>{{$total-$offer}} <br>
                            <span class="data-span"> Sub Total:</span>${{$total-$offer}} <br>
                            <span class="data-span"> Tax: </span>$0 <br>
                            <span class="data-span"> Total:</span>${{$total-$offer}} <br>
                            <span class="data-span">Payment Status: </span>Complete
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <footer>
            <h3 style="text-align: center">
                Copyright @2023
            </h3>
        </footer>

    </div>
</div>
<?php
 Order::where('user_id',$userId)->delete();
 redirect('/');
 ?>

<!-- Invoice area end -->

</body>

</html>

