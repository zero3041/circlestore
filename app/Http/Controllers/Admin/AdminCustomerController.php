<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function getCustomer()
    {
        $customer = Customer::all();
        foreach ($customer as $key => $value) {
            if ($value['active'] == true) {
                $customer[$key]['active'] = '<span class="badge bg-success">Kích hoạt</span>';
            } else {
                $customer[$key]['active'] = '<span class="badge bg-danger">Đang khóa</span>';
            }
        }
        return view('admin.pages.customer')->with('customer', $customer);
    }
    public function addCustomer()
    {
        $country = Country::all();
        if($country != null){
            $country = $country->toArray();
        }
        return view('admin.pages.editCustomer')->with('country',$country);
    }
    public function editCustomer($id)
    {
        $customer = Customer::find($id);
        $country = Country::all();
        if($country != null && $customer !=null){
            $country = $country->toArray();
            $customer= $customer->toArray();
        }
        return view('admin.pages.editCustomer')->with(['web'=>$customer, 'country'=>$country]);
    }
    public function postAddCustomer(Request $request)
    {
        $this->registerCustomer($request, $check = 'admin');
        return redirect()->route('adminCustomer');
    }
    public function postEditCustomer(Request $request, $id)
    {
        $this->saveEditCustomer($request, $id, $check = 'admin');
        return redirect()->route('adminCustomer');
    }
    public function deleteCustomer(Request $request, $id)
    {
        $customer = Customer::find($id);
        if($customer!=null){
            $customer->delete();
        }
        return redirect()->route('adminCustomer');
    }
}
