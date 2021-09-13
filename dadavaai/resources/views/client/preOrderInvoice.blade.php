@php
    $paid_amount = 0;
    
    foreach($preorder->preorderPayments as $preorderPayment)
    {
        $paid_amount += $preorderPayment->payment->amount;
    }

    $paid_amount += $preorder->payment->amount;

@endphp


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!------ Include the above in your HEAD tag ---------->
		<style>
		body {
			background: grey;
			margin-top: 120px;
			margin-bottom: 120px;
			}
		</style>
</head>
<body>

		
		
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row p-3">
                            <div class="col-md-6">
                                <img src="http://127.0.0.1:8000/client/img/logo/dadavaai.png" width="300" height="60">
                            </div>
    
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1"></p>
                                <p class="text-muted">www.dadavaai.com </p>
                                <a class="btn btn-primary" href="" onclick="window.print();">Print</a>
                            </div>
                        </div>
    
                        <hr class="">
    
                        <div class="row pb-5 p-5">
                            <div class="col-md-4">
                                <p class="font-weight-bold mb-4">Client Information</p>
                                <p class="mb-1">{{$preorder->client->clientName}}</p>
                                <p class="mb-1">{{$preorder->client->address}}</p>
                                <p class="mb-1">{{$preorder->client->town}}, {{$preorder->client->division}}-{{$preorder->client->zipCode}}, {{$preorder->client->country}}</p>
                                <p class="mb-1">Phone: {{$preorder->client->phone}}</p>
                                <p class="mb-1">Email: {{$preorder->client->email}}</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <p class="font-weight-bold mb-4">Shipping Address</p>
                                <p class="mb-1">{{$preorder->client->shipping->name}}</p>
                                <p class="mb-1">{{$preorder->client->shipping->address}}</p>
                                <p class="mb-1">{{$preorder->client->shipping->town}}, {{$preorder->client->shipping->division}}-{{$preorder->client->shipping->zipCode}}, {{$preorder->client->shipping->country}}</p>
                                <p class="mb-1">Phone: {{$preorder->client->shipping->phone}}</p>
                                <p class="mb-1">Email: {{$preorder->client->shipping->email}}</p>
                            </div>

                            <div class="col-md-4 text-right">
                                <p class="font-weight-bold mb-4">Payment Details</p>
                                <p class="mb-1"><span class="text-muted">Invoice: </span>  #{{$preorder->id}}</p>
                                <p class="mb-1"><span class="text-muted">Date: </span> {{$preorder->created_at}}</p>
                                <p class="mb-1"><span class="text-muted">Payment From: </span> {{$preorder->payment->tran_id}}</p>
                                <p class="mb-1"><span class="text-muted">Paid Amount: </span> {{$paid_amount}}</p>
                                <p class="mb-1"> <strong class="fsz-18"><span class=" text-muted"> Due: </span> {{$preorder->totalAmount - $paid_amount}} </strong></p>
                            </div>
                        </div>
    
                        <div class="row p-5">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-uppercase small font-weight-bold">Id</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Sku</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @php
                                        $price = $total_price = $cart_subtotal = 0;
                                        $shipping = 100;
                                        $vatTax = 7.5;
                                        $currentTime = \Carbon\Carbon::now()->format('d-m-Y');

                                        $product = $prebook->product;
                                        $salePrice = $product->regularPrice;

                                        if ($product->discount){
                                            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                $proPrice = $salePrice-(($salePrice*($product->deal->discount_value + $product->discount))/100);
                                            
                                            else
                                                $proPrice = $salePrice-(($salePrice*$product->discount)/100);
                                        }
                                        else{
                                            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                $proPrice = $salePrice-(($salePrice*$product->deal->discount_value)/100);
                                            else
                                                $proPrice = $product->regularPrice;
                                        }
                                    @endphp

                                    
                                        <tr>
                                            <td>1</td>
                                            <td >{{$product->productName}}</td>
                                            <td>{{$product->sku}}</td>
                                            <td>{{substr(strip_tags($product->shortDescription), 0, 52)}}...</td>
                                            <td ><b class="amount">Tk {{number_format($proPrice, 2)}}</b></td>
                                        </tr>
                                        @php
                                            $unitPrice = $proPrice;
                                            $price += $unitPrice;
                                            $discount = $prebook->prebook_discount;
                                        @endphp
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-right" colspan="4">Sub Total:</th>
                                            <td><b class="blk-clr">Tk {{$price}}</b></td>
                                        </tr>
                                        @if($discount != null)
                                            <tr>
                                                <th class="text-right" colspan="4">Discount:</th>
                                                <td>Tk {{number_format($discount, 2)}}</td>
                                            </tr>
                                        @endif

                                        <tr class="cart-discount">
                                            <th class="text-right" colspan="4">Shipping Charge :</th>
                                            <td><b class="blk-clr">Tk {{$shipping}}</b></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th class="text-right" colspan="4">VAT ({{$vatTax}}%):</th>
                                            <td>
                                                <b class="blk-clr">Tk {{$price* ($vatTax/100)}}</b>
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white order-total">
                                            <th class="text-right" colspan="4">Order Total</th>
                                            <td><b class="amount">Tk {{$preorder->totalAmount}}</b> </td>
                                        </tr>
                                        <tr class="bg-dark text-white order-total">
                                            <th class="text-right" colspan="4">Due</th>
                                            <td><b class="amount">Tk {{number_format(($preorder->totalAmount)-$paid_amount, 2)}}</b> </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div style="float: right">
                                    <form action="{{url('pre-order-remaining-payment')}}" method="post">
                                        <div class="btn-group">
                                            @if ($paid_amount < $preorder->totalAmount)
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="preorder_id" value="{{$preorder->id}}">
                                                    <button class="btn btn-danger" type="submit">
                                                        Pay Now
                                                    </button>
                                                
                                            @elseif( $paid_amount == $preorder->totalAmount)
                                                <a class="btn btn-success" href="#">
                                                    payment complete
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <hr class="">
                        <div class="row p-3">
                            <div class="col-md-6 text-left">
                                <p class="text-muted">dadavaai, 89/2, West Panthapath,Dhaka </p>
                            </div>
    
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1"></p>
                                <p class="text-muted">(+880) 1971424220 |  sales@dadavaai.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://dadavaai.com">dadavaai.com</a></div>
    
    </div>
</body>
</html>
