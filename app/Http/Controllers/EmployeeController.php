<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::get();
        return view('employees.create', compact('companies'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_id' => 'required'
        ], [
            'company_id.required' => 'The Company field is required!',
            'phone.required' => 'The Phone Number is required!',
            'email.required' => 'The Email field is required!',
            'lname.required' => 'The Last Name field is required!',
            'fname.required' => 'The First Name field is required!',
        ]);

        if ($validator->fails()) {
            return $validator->getMessageBag();
        }

        $employee = new Employee();
        $employee->first_name = $request->fname;
        $employee->last_name = $request->lname;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company_id;
        $employee->save();

        return response()->json([
            'status' => true,
            'message' => 'Add Employee Successfully',
        ]);
    }

    public function delete(Request $request){
        if ($request->ajax()) {
            $employee = Employee::where('id',$request->id)->delete();
            if($employee){
                return response()->json([
                    'status' => true,
                    'message' => 'Deleted Employee Successfully',
                ]);
            }
        }
    }

    public function edit($id){
        $employee = Employee::find($id);
        $companies = Company::all();
        return view('employees.edit', compact('employee','companies'));
    }

    public function update(Request $request){
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'company_id' => 'required'
            ], [
                'company_id.required' => 'The Company field is required!',
                'phone.required' => 'The Phone Number is required!',
                'email.required' => 'The Email field is required!',
                'lname.required' => 'The Last Name field is required!',
                'fname.required' => 'The First Name field is required!',
            ]);

            if ($validator->fails()) {
                return $validator->getMessageBag();
            }

            $employee = Employee::where("id", $request->id)
            ->update([
                "first_name" => $request->fname,
                "last_name" => $request->lname,
                "email" => $request->email,
                "phone" => $request->phone,
                "company_id" => $request->company_id,
            ]);

            if($employee){
                return response()->json([
                    'status' => true,
                    'message' => 'Update Employee Successfully',
                ]);
            }
        }
    }


}
