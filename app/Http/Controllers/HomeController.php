<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order_Items;
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
        $purchases = Order_Items::latest()->where('user_id', $this->guard()->user()->id)->paginate(10);
        return view('home.dashboard', compact('purchases'));
    }

    public function profile()
    {
        $customer = $this->guard()->user();
        return view('home.profile', compact('customer'));
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
