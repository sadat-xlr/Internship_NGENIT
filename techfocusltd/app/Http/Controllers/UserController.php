<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Mail\OrderPlaced;
use App\MembershipType;
use App\Offer;
use App\Salesman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Product;
use App\Customer;
use App\Cart;
use App\Compare;
use App\Wishlist;
use App\Order;
use App\Payment;
use App\Orderdetail;
use App\Shipping;
use App\Brand;
use App\Category;
use App\Industry;
use App\Technology;
use App\Mail\VerifyMail;
use Session;

// User Controller
class UserController extends Controller
{
	// Loads cart view 
	public function cart(){
		$session_id = Session::getId();
		$carts = Cart::where('sId', $session_id)->get();
		return view('cart', [
		'carts' => $carts,
		]);
	}
	
	// Add product to cart single quantity  
	public function addCart($proId){
		$session_id = Session::getId();
		$carts = Cart::where('sId', $session_id)
			->where('product_id', $proId)
			->get();
		if (!$carts->isEmpty()){
			return redirect()->back()->with('error', 'Product exists in cart! Go to cart page to update quantity.');
		}
		
		// Create instance of Cart model & assign form value then save to database
		$cart = new Cart;
		$cart->sId = $session_id;
		$cart->quantity = 1;
		$cart->product_id = $proId;
		$cart->save();
				
		/* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
		if($cart){
			return redirect()->back()->with('success', 'Product added to cart successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not add product to cart! '); 
		}
	}
	
	// Add product to cart multiple quantity 
	public function insertCart(Request $request, $proId){
		$sId = Session::getId();
		$carts = Cart::where('sId', $sId)
			->where('product_id', $proId)
			->get();
		if (!$carts->isEmpty()){
			return redirect()->back()->with('error', 'Product exists in cart! Go to cart page to update quantity.');
		}
		
		// Create instance of Cart model & assign form value then save to database
		$cart = new Cart;
		$cart->sId = $sId;
		$cart->quantity = $request->quantity;
		$cart->product_id = $proId;
		$cart->save();
				
		/* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
		if($cart){
			return redirect()->back()->with('success', 'Product added to cart successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not add product to cart! '); 
		}
	}
	
	// Update cart  
	public function updateCart(Request $request, $cartId){
		$cart = Cart::find($cartId);
		
		$cart->quantity = $request->quantity;
		$cart->save();
				
		/* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
		if($cart){
			return redirect()->back()->with('success', 'Cart updated successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not update cart! '); 
		}
	}
	
	// Delete cart
	public function deleteCart($cartId){
		$result = Cart::find($cartId);
		$result->delete();
				
		if($result){
			return redirect()->back()->with('success', 'Cart deleted successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not delete cart! '); 
		}
	}
	
	// Loads compare view
	public function compare(){
		$compares = Compare::where('sId', Session::getId())
			->get();
		return view('compare', [
			'compares' => $compares
		]);
	}

    // Loads compareSimiliar view
    public function compareSimiliar($proId, $miniCatId){
        // Find product by subcategory
        $products = Product::where('id', $proId)->orWhere('minicategory_id', $miniCatId)->orderByDesc('id')->take(5)->get();

        return view('compareSimiliar', [
            'products' => $products
        ]);
    }
	
	// Add product to compare 
	public function addCompare($proId){
		$compares = Compare::where('sId', Session::getId())
			->where('product_id', $proId)
			->get();
		if (!$compares->isEmpty()){
			return redirect()->back()->with('error', 'This Product already exists in compare! ');
		}
		
		$product = Product::find($proId);
		
		// Create instance of compare model & assign form value then save to database
		$compare = new Compare;
		$compare->sId = Session::getId();
		$compare->product_id = $proId;
		$compare->save();
				
		/* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
		if($compare){
			return redirect()->back()->with('success', 'Product added to compare successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not add product to compare! '); 
		}
	}
	
	// Delete compare
	public function deleteCompare($compareId){
		$result = Compare::find($compareId);
		$result->delete();
				
		if($result){
			return redirect()->back()->with('success', 'Compare deleted successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not delete Compare! '); 
		}
	}
	
	// Add product to wishlist 
	public function addWishlist($proId){
		// Checks if logged in
		if (!\Session::has('ID')){
			return redirect()->back()->with('error', 'You must be logged in to add product to wishlist ! ');
		}
		
		$wishlists = Wishlist::where('customer_id', Session::get('ID'))
			->where('product_id', $proId)
			->get();
		if (!$wishlists->isEmpty()){
			return redirect()->back()->with('error', 'This Product already exists in wishlist! ');
		}
		
		$product = Product::find($proId);
		
		// Create instance of compare model & assign form value then save to database
		$wishlist = new Wishlist;
		$wishlist->customer_id = Session::get('ID');
		$wishlist->product_id = $proId;
		$wishlist->save();
				
		/* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
		if($wishlist){
			return redirect()->back()->with('success', 'Product added to wishlist successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not add product to wishlist! '); 
		}
	}
	
	// Loads wishlist view
	public function wishlist(){
		// Checks if logged in
		if (!\Session::has('ID')){
			return redirect()->back()->with('error', 'You must be logged in to see wishlist ! ');
		}
		
		$wishlists = Wishlist::where('customer_id', Session::get('ID'))
			->get();
		return view('wishlist', [
			'wishlists' => $wishlists
		]);
	}
	
	// Delete wishlist
	public function deleteWishlist($wishlistId){
		// Checks if logged in
		if (!\Session::has('ID')){
			return redirect('/login');
		}
		
		$result = Wishlist::find($wishlistId);
		$result->delete();
				
		if($result){
			return redirect()->back()->with('success', 'Wishlist deleted successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not delete wishlist! '); 
		}
	}
	
	// Loads login view
	public function login(){
		return view('login');
	}
	
	/* Authorizes the customer login process. Redirect to customer login page (if provided data is not valid) or to customer dashboard page (if provided data is valid) */
	public function loginAuthorization(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
		'email' => 'required|email',
        'password' => 'required',
		]);
		
		// Checks if the account is activated
		$customer = Customer::where('email', $request->email)
		->where('status', '0')
		->first();
		if($customer){
			return redirect()->back()->with('error', 'Your E-mail is not verified! Please check your E-mail & click on the link in the mail to activate your account. Thank you.');
		}
		
		// Authorizes customer
		$user = Customer::where('email', $request->email)
		->where('password', md5($request->password))
		->first();
		
		if($user){
			Session::put('ID', $user->id);
			Session::put('name', $user->customerName);
			return redirect('/my-account');
			// return redirect()->back();

		}else{ 
			return redirect()->back()->with('error', 'Invalid E-mail or Password or both ! ');
		}
	}
	
	// Register a new user & redirect back with success message
	public function register(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
		]);

		// Checks if the email exists 
		$cmrCheck = Customer::where('email', $request->email)->get();
		if(!$cmrCheck->isEmpty()){
			return redirect()->back()->with('error', 'This E-mail already exists! Please try with a different E-mail.');
		}

        // Get the id of prime membership type
        $membership_type = MembershipType::select('id')->where('membership_type', '0')->get()->toArray();
		
		// Create instance of Customer model & assign form value then save to database
		$customer = new Customer;
		$customer->email = $request->email;
		$customer->password = md5($request->password);
        $customer->membership_type_id = $membership_type[0]['id'];
		$customer->token = str_random(40);
		$customer->save();
 
        Mail::to($customer->email)->send(new VerifyMail($customer));
		
		/* Checks if data is saved to database. If so, redirect back with success message. Otherwise, redirect back with error message */
		if($customer){
			Session::put('register_mail', $customer->email);
			return redirect()->back()->with('success', 'Congratulations! You have successfully registered. Please check your E-mail & click Verify to activate your account. Thank you.');
		}else{
			return redirect()->back()->with('error', 'Registration failed!');
		}
	}

	public function resendVerifyMail($email){

		// Checks if the email exists 
		$cmrCheck = Customer::where('email', $email)->first();
		
		if($cmrCheck){
			if($cmrCheck->status == 1){
				return redirect()->back()->with('error', 'Your account already active');
			}

			Mail::to($cmrCheck->email)->send(new VerifyMail($cmrCheck));
			return redirect()->back()->with('success', 'Verification mail send again');
		}
		else{
			return redirect()->back()->with('error', 'Do registration again.');
		}
		
	}
	public function resendVerifyMailPost(Request $request){

		// Checks if the email exists 
		$cmrCheck = Customer::where('email', $request->email)->first();
		
		if($cmrCheck){
			if($cmrCheck->status == 1){
				return redirect()->back()->with('error', 'Your account already active');
			}

			Mail::to($cmrCheck->email)->send(new VerifyMail($cmrCheck));
			return redirect()->back()->with('success', 'Verification mail send again');
		}
		else{
			return redirect()->back()->with('error', 'Do registration again.');
		}
		
	}
	
	public function verifyUser($token)
    {
        $verifyUser = Customer::where('token', $token)->first();
        if(isset($verifyUser)){
            if(!$verifyUser->status) {
                $verifyUser->status = 1;
                $verifyUser->save();
				$status = "Your e-mail is verified. You can now login.";
				Session::put('register_mail', Null);
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/client-login')->with('error', "Sorry your email cannot be identified.");
        }
 
        return redirect('/client-login')->with('success', $status);
    }
	
	// Destroy the Session & Redirect to login page
	public function cmrLogout(){
		$result = Compare::where('sId', Session::getId())->delete();
		Session::put('ID', NULL);
		Session::put('Name', NULL);
		
		return redirect('/login');
	}
	
	// Loads myAccount view
	public function myAccount(){
		// Checks if logged in
		if (!\Session::has('ID')){
			return redirect('/login');
		}

		// Get the customer
        $client = Customer::find(Session::get('ID'));

        // Get salesmen
        $salesmen= Salesman::all();

        // Get offer products
        $offers = Offer::where('valid_until', '>=', Carbon::now())->get()->sortByDesc('id');

        // Get deal products
        $deals = Deal::where('valid_until', '>=', Carbon::now())->get()->sortByDesc('id');
		
		return view('myAccount', [
			'client' => $client,
			'offers' => $offers,
			'deals' => $deals,
			'salesmen' => $salesmen
		]);
	}

	// Delete order
	public function deleteOrder($orderId){
		// Checks if logged in
		if (!\Session::has('ID')){
			return redirect('/login');
		}
		
		$result = Orderdetail::find($orderId);
		$result->delete();
				
		if($result){
			return redirect()->back()->with('success', 'Order deleted successfully. ');
		}else{
			return redirect()->back()->with('error', 'Could not delete order! '); 
		}
	}
	
	// Loads checkout view
	public function checkout(){
		$session_id = Session::getId();
		$carts = Cart::where('sId', $session_id)
			->get();
		if ($carts->isEmpty()){
			return redirect()->back()->with('error', 'Your cart is empty! Please purchase product to checkout.');
		}
		
		// Checks if logged in
		if (\Session::has('ID')){
			return view('cmrCheckout', [
			'carts' => $carts
			]);
		}
		
		return view('checkout', [
			'carts' => $carts
		]);
	}
	
	// Place order & place shipping address if checked
	public function cmrOrder(Request $request){

		// return response()->json($request);
		// Checks if logged in
		if (!\Session::has('ID')){
			return redirect('/login');
		}

        // Checks if the email exists
        $client = Customer::find(Session::get('ID'));

        if(!isset($request->checkedorder)){
            return redirect()->back()->with('error', 'Please agree with the terms and conditions.');
        }

        if(isset($request->shipping)){
            // Validate form data
            $validatedData = $this->validate($request, [
                'country2' => 'required',
                'address3' => 'required',
                'towncity2' => 'required',
                'statecountry2' => 'required',
                'postcode2' => 'required',
            ]);

            // Create instance of Shipping model & assign form value then save to database
            $shipping = new Shipping;
            $shipping->address = $request->address3;
            $shipping->town = $request->towncity2;
            $shipping->country = $request->country2;
            $shipping->division = $request->statecountry2;
            $shipping->postcode = $request->postcode2;
            $shipping->save();
        }

        // Get cart product
        $session_id = Session::getId();
        $carts = Cart::where('sId', $session_id)
            ->get();
        $ids = Cart::where('sId', $session_id)->get(['id']);

        // Create instance of Payment model & assign form value then save to database
        $payment = new Payment;
        $payment->paymentMethod = $request->paymentMethod;

        // Check payment method
        if ($request->paymentMethod == 0){
            // Validate form data
            $validatedData = $this->validate($request, [
                'bkash_number' => 'required',
                'bkash_transaction_id' => 'required',
            ]);

            $payment->accNo = $request->bkash_number;
            $payment->tranId = $request->bkash_transaction_id;
            $payment->bank_name = 'BRAC Bank';
        }elseif ($request->paymentMethod == 1){
            // Validate form data
            $validatedData = $this->validate($request, [
                'rocket_number' => 'required',
                'rocket_transaction_id' => 'required',
            ]);

            $payment->accNo = $request->rocket_number;
            $payment->tranId = $request->rocket_transaction_id;
            $payment->bank_name = 'Dutch-Bangla Bank';
        }elseif ($request->paymentMethod == 2){
            // Validate form data
            $validatedData = $this->validate($request, [
                'bacs_acc_name' => 'required',
                'bacs_acc_no' => 'required',
                'bacs_bank_name' => 'required',
                'bacs_transaction_id' => 'required',
                'bacs_bank_deposit' => 'required|image|max:25',
            ]);

            $payment->acc_name = $request->bacs_acc_name;
            $payment->accNo = $request->bacs_acc_no;
            $payment->bank_name = $request->bacs_bank_name;
            $payment->tranId = $request->bacs_transaction_id;

            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('bacs_bank_deposit')){
                // Get file name with extension
                $fileNameWithExt = $request->file('bacs_bank_deposit')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('bacs_bank_deposit')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('bacs_bank_deposit')->storeAs('public/images/client/payment', $fileNameToStore);
                $payment->deposit = $fileNameToStore;
            }
        }elseif ($request->paymentMethod == 3){
            // Validate form data
            $validatedData = $this->validate($request, [
                'cps_bank_deposit' => 'required|image|max:25',
            ]);

            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('cps_bank_deposit')){
                // Get file name with extension
                $fileNameWithExt = $request->file('cps_bank_deposit')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('cps_bank_deposit')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('cps_bank_deposit')->storeAs('public/images/client/payment', $fileNameToStore);
                $payment->deposit = $fileNameToStore;
            }
        }

        $payment->save();

        // Create instance of Order model & assign form value then save to database
        $order = new Order;
        $order->customer_id = Session::get('ID');
        $order->payment_id = $payment->id;
        if (isset($shipping)){
            $order->shipping_id = $shipping->id;
        }
        $order->save();

        foreach($carts as $cart){
            // Create instance of OrderDetails model & assign form value then save to database
            $orderDetails = new Orderdetail;
            $orderDetails->quantity = $cart->quantity;
            $orderDetails->product_id = $cart->product_id;
            $orderDetails->order_id = $order->id;
            $orderDetails->save();
        }

        Cart::destroy($ids->toArray());
        Session::put('coupon_id', null);

        // Send order details to client by E-mail
        Mail::to($client->email)->send(new OrderPlaced($order));

        return view('order', [
            'order' => $order
        ]);
	}
	
	// Place order & register user if checked & place shipping address if checked
	public function order(Request $request){
		
		
		
		// Validate form data 
		$validatedData = $this->validate($request, [
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'city' => 'required',
        'division' => 'required',
        'postcode' => 'required',
        'password' => 'required',
		]);
		
		// Checks if the email exists 
		$cmrCheck = Customer::where('email', $request->email)->get();
		if(!$cmrCheck->isEmpty()){
			return redirect()->back()->with('error', 'This E-mail already exists! Please login to checkout or try with a different E-mail.');
		}
		
		if(!isset($request->checkedorder)){
			return redirect()->back()->with('error', 'Please agree with the terms and conditions.');
		}

        if(isset($request->shipping)){
            // Validate form data
            $validatedData = $this->validate($request, [
                'country2' => 'required',
                'address3' => 'required',
                'towncity2' => 'required',
                'statecountry2' => 'required',
                'postcode2' => 'required',
            ]);

            // Create instance of Shipping model & assign form value then save to database
            $shipping = new Shipping;
            $shipping->address = $request->address3;
            $shipping->town = $request->towncity2;
            $shipping->country = $request->country2;
            $shipping->division = $request->statecountry2;
            $shipping->postcode = $request->postcode2;
            $shipping->save();
        }

        // Get the id of prime membership type
        $membership_type = MembershipType::where('membership_type', '0')->get(['id']);
		
		// Create instance of Customer model & assign form value then save to database
		$customer = new Customer;
		$customer->customerName = $request->firstname." ".$request->lastname;
		$customer->address = $request->address;
		$customer->city = $request->city;
		$customer->company = $request->company;
		$customer->country = $request->country;
		$customer->division = $request->division;
		$customer->zipCode = $request->postcode;
		$customer->phone = $request->phone;
		$customer->email = $request->email;
        $customer->membership_type_id = $membership_type[0]->id;
		$customer->password = md5($request->password);
		$customer->token = str_random(40);
			
		// Get cart product
		$session_id = Session::getId();
		$carts = Cart::where('sId', $session_id)
			->get();
		$ids = Cart::where('sId', $session_id)->get(['id']);

        // Create instance of Payment model & assign form value then save to database
        $payment = new Payment;
        $payment->paymentMethod = $request->paymentMethod;

        // Check payment method
        if ($request->paymentMethod == 0){
            // Validate form data
            $validatedData = $this->validate($request, [
                'bkash_number' => 'required',
                'bkash_transaction_id' => 'required',
            ]);

            $payment->accNo = $request->bkash_number;
            $payment->tranId = $request->bkash_transaction_id;
            $payment->bank_name = 'BRAC Bank';
        }elseif ($request->paymentMethod == 1){
            // Validate form data
            $validatedData = $this->validate($request, [
                'rocket_number' => 'required',
                'rocket_transaction_id' => 'required',
            ]);

            $payment->accNo = $request->rocket_number;
            $payment->tranId = $request->rocket_transaction_id;
            $payment->bank_name = 'Dutch-Bangla Bank';
        }elseif ($request->paymentMethod == 2){
            // Validate form data
            $validatedData = $this->validate($request, [
                'bacs_acc_name' => 'required',
                'bacs_acc_no' => 'required',
                'bacs_bank_name' => 'required',
                'bacs_transaction_id' => 'required',
                'bacs_bank_deposit' => 'required|image|max:25',
            ]);

            $payment->acc_name = $request->bacs_acc_name;
            $payment->accNo = $request->bacs_acc_no;
            $payment->bank_name = $request->bacs_bank_name;
            $payment->tranId = $request->bacs_transaction_id;

            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('bacs_bank_deposit')){
                // Get file name with extension
                $fileNameWithExt = $request->file('bacs_bank_deposit')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('bacs_bank_deposit')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('bacs_bank_deposit')->storeAs('public/images/client/payment', $fileNameToStore);
                $payment->deposit = $fileNameToStore;
            }
        }elseif ($request->paymentMethod == 3){
            // Validate form data
            $validatedData = $this->validate($request, [
                'cps_bank_deposit' => 'required|image|max:25',
            ]);

            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('cps_bank_deposit')){
                // Get file name with extension
                $fileNameWithExt = $request->file('cps_bank_deposit')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('cps_bank_deposit')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('cps_bank_deposit')->storeAs('public/images/client/payment', $fileNameToStore);
                $payment->deposit = $fileNameToStore;
            }
        }

        $payment->save();
		$customer->save();

        // Create instance of Order model & assign form value then save to database
        $order = new Order;
        $order->customer_id = $customer->id;
        $order->payment_id = $payment->id;
        if (isset($shipping)){
            $order->shipping_id = $shipping->id;
        }
        $order->save();

        foreach($carts as $cart){
            // Create instance of OrderDetails model & assign form value then save to database
            $orderDetails = new Orderdetail;
            $orderDetails->quantity = $cart->quantity;
            $orderDetails->product_id = $cart->product_id;
            $orderDetails->order_id = $order->id;
            $orderDetails->save();
        }

        Cart::destroy($ids->toArray());
        Session::put('coupon_id', null);

        Mail::to($customer->email)->send(new VerifyMail($customer));

        // Send order details to client by E-mail
        Mail::to($customer->email)->send(new OrderPlaced($order));

        return view('order', [
            'order' => $order
        ]);
	}
}
