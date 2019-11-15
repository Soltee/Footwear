<?php

namespace App\Http\Controllers\Administrator;

use App\Products;
use App\Customer;
use App\Categories;
use App\Administrator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function __construct()
    {
     	$this->middleware('auth:administrator');
    }

    public function index()
    {
        $products = Products::latest()->paginate(3);
        $customers = Customer::latest()->paginate(3);
    	$categories = Categories::latest()->paginate(3);
    	return view('administrator.dashboard', compact('products' ,'customers', 'categories'));
    }

    public function profile(){
        $administrator = Auth::guard('administrator')->user();
        return view('administrator.profile', compact('administrator'));
    }

    public function update(Administrator $administrator, Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
         // dd($request->all());
       if($request->hasFile('avatar')){
            $this->validate($request, [
                'avatar' => ['image']
            ]);
            $avatarUrl = $request->file('avatar')->store('administrator', 'public');
            $avatarPath = ['avatar' => $avatarUrl];
        }

        auth()->user()->update(array_merge([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ], $avatarPath ?? []));

        return redirect()->route('administrator-profile')->with('success', 'Profile updated.');
    }
}
