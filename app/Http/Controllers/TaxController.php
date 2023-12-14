<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(){
        $taxes = Tax::where('year', "2080/81")->get();
        $classData = [
            'single' => [],
            'couple' => [],
        ];

        foreach ($taxes as $tax) {
            $classData[$tax->status][] = $tax;
        }
        // dd($classData);

        return view('admin.tax', compact('classData','taxes'));

    }

    public function indexEmp(){
        $taxes = Tax::where('year', "2080/81")->get();
        $classData = [
            'single' => [],
            'couple' => [],
        ];

        foreach ($taxes as $tax) {
            $classData[$tax->status][] = $tax;
        }

        return view('employee.tax', compact('classData','taxes'));

    }

    public function update($year,$next,$status){
        $taxes = Tax::where('year', $year."/".$next)->where('status',$status)->get();
        $count = $taxes->count();

        return view('admin.tax_entry', compact('taxes','count'));

    }


    
    public function show(){
        return view('admin.tax_entry');
    }
    public function store(Request $request){
        $year = $request->input('year');
        $incomes = $request->input('income');
        $taxRates = $request->input('tax_rate');
        $status = $request->input('status');

        // Loop through the arrays and insert data into the database
        foreach ($incomes as $key => $income) {
            Tax::create([
                'status' => $status,
                'year' => $year,
                'income' => $income,
                'tax_rate' => $taxRates[$key],
            ]);
        }

        return redirect()->back()->with('success', 'Tax Slab stored');

    }

    public function updateTax(Request $request){
        $year = $request->input('year');
        $incomes = $request->input('income');
        $taxRates = $request->input('tax_rate');
        $status = $request->input('status');

        Tax::where(['year' => $year, 'status' => $status])->delete();

        // Loop through the arrays and insert data into the database
        foreach ($incomes as $key => $income) {
            Tax::create([
                'status' => $status,
                'year' => $year,
                'income' => $income,
                'tax_rate' => $taxRates[$key],
            ]);
        }
        // dd($request->all());


        return redirect()->back()->with('success', 'Tax Slab updated');

    }

}

