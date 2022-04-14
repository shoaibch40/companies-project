<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'website' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,svg|dimensions:min_width=100,min_height=100',
        ], [
            'name.required' => 'The Company Name is required!',
            'email.required' => 'The Email field is required!',
            'website.required' => 'The Website field is required!',
            'file.required' => 'The File field is required!',
        ]);

        if ($validator->fails()) {
            return $validator->getMessageBag();
        }

        $company = new Company();



        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        $company->save();

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $imageName = $company->id.'.jpg';
            $path = $request->file('file')->storeAs('/company_logo/', $imageName, 'public');
            Company::where('id',$company->id)->update(['logo'=>$imageName]);
        }

        $company_name = $request->name;
        $email = $request->email;
        $website = $request->website;

        $data = array('name'=>$company_name,'email'=>$email,'website'=>$website);

        $employees = Employee::get();

        foreach ($employees as $employee) {
            $employee_email = $employee->email;
            Mail::send('mail.mail', $data, function($message) use ($company,$company_name,$employee_email) {
                $message->to($employee_email);
                $message->from('developer.devsspace@gmail.com', 'testing');
                $message->subject($company_name);
            });
        }



        return response()->json([
            'status' => true,
            'message' => 'Add Company Successfully',
        ]);
    }

    public function delete(Request $request){
        if ($request->ajax()) {
            $company = Company::where('id',$request->id)->delete();
            if($company){
                return response()->json([
                    'status' => true,
                    'message' => 'Deleted Employee Successfully',
                ]);
            }
        }
    }

    public function edit($id){
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request){
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'website' => 'required',
                'file' => 'dimensions:min_width=100,min_height=100',
            ], [
                'name.required' => 'The Company Name is required!',
                'email.required' => 'The Email field is required!',
                'website.required' => 'The Website field is required!',
            ]);

            if ($validator->fails()) {
                return $validator->getMessageBag();
            }

            $company = Company::find($request->id);

            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();
                $path = $request->file('file')->storeAs('/company_logo/', $imageName, 'public');
                $company->logo = $imageName;
            }

            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;

            $company->update();

            return response()->json([
                'status' => true,
                'message' => 'Update Company Successfully',
            ]);
        }
    }

}
