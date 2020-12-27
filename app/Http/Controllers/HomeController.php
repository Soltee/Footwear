<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order_Item;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases    = Order_Item::latest();
        $paginate     = $purchases
                        ->where('customer_id', $this->guard()->user()->id)
                        ->with([
                            'product' => function($query)
                                {
                                    $query->select('id','name', 
                                    'slug', 'imageUrl');
                                },
                            'order' => function($query)
                                {
                                    $query->select('id', 'first_name');
                                },
                            ])
                        ->paginate(10);
        $items        = $paginate->items();
        // dd($items);
        $first        = $paginate->firstItem();
        $last         = $paginate->lastItem();
        $total        = $paginate->total();
        $has_previous = $paginate->previousPageUrl();
        $has_next     = $paginate->nextPageUrl();
        $new          = Order::where('customer_id', $this->guard()->user()->id)
                            ->where('completed', true)->count();
        // dd($total);
        // dd($items[0]->product);
        return view('home.dashboard', compact('items', 'first', 'last', 'total', 'has_previous', 'new','has_next'));
    }

    public function profile()
    {
        $customer = $this->guard()->user();
        $new      = Order::where('customer_id', $customer->id)
                            ->where('completed', true)->count();
        return view('home.profile', compact('customer', 'new'));
    }

    public function profilePic(Request $request){
        $this->validate($request, [
            'avatar' => ['image']
        ]);
        $avatarUrl = $request->file('avatar')->store('customers', 'public');
        // dd($avatarUrl);
        $this->guard()->user()->update([
            'avatar' => $avatarUrl
        ]);
        return redirect()->back()->with('success', 'Profile picture updated.');

    }
    public function updateProfile(Request $request, Customer $customer)
    {
        // dd($customer->email);
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // dd($request->all());
        
        $this->guard()->user()->update(array_merge([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]));

        return redirect()->back()->with('success', 'Profile updated.');
    }


    protected function guard(){
        return Auth::guard('customer');
    }
}
