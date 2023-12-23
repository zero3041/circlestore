<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class AdminTaxController extends Controller
{
    public function getTax()
    {
        $tax = Tax::Paginate(10);
        return view('admin.pages.tax')->with('tax', $tax);
    }

    public function addTax()
    {
        return view('admin.pages.editTax');
    }

    public function editTax($id)
    {
        $tax = Tax::find($id);
        if ($tax != null) {
            $tax = $tax->toArray();
        }
        return view('admin.pages.editTax')->with('tax', $tax);
    }

    public function postAddTax(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'value' => 'required|integer'
        ], [
            'name.required' => 'Vui lòng nhập tên thuế',
            'value.required' => 'Vui lòng nhập giá trị thuế',
            'name.max' => 'Tên thuế không được dài quá 100 kí tự',
            'value.integer' => 'Giá trị phần trăm thuế phải là số nguyên',
        ]);
        $tax = new Tax;
        $tax->name = $request->name;
        $tax->value = $request->value;
        $tax->save();
        return redirect()->route('adminTax');
    }

    public function postEditTax(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'value' => 'required|integer'
        ], [
            'name.required' => 'Vui lòng nhập tên thuế',
            'value.required' => 'Vui lòng nhập giá trị thuế',
            'name.max' => 'Tên thuế không được dài quá 100 kí tự',
            'value.integer' => 'Giá trị phần trăm thuế phải là số nguyên',
        ]);
        $tax = Tax::find($id);
        if ($tax != null) {
            $tax->name = $request->name;
            $tax->value = $request->value;
            $tax->save();
        }

        return redirect()->route('adminTax');
    }

    public function deleteTax(Request $request, $id)
    {
        $tax = Tax::find($id);
        if ($tax != null) {
            $tax->delete();
        }
        return redirect()->route('adminTax');
    }
}
