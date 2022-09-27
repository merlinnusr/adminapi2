<?php

namespace App\Http\Controllers;

use App\Models\CompanyEmployee;
use App\Http\Requests\StoreCompanyEmployeeRequest;
use App\Http\Requests\UpdateCompanyEmployeeRequest;

class CompanyEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ok('Relation between company and employee', CompanyEmployee::paginate(15) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyEmployeeRequest $request)
    {
        $data = $request->validated();
        $companyEmployeeCreated = CompanyEmployee::create([
            'company_id' => $data['company_id'],
            'employee_id' => $data['employee_id'],
        ]);
        return ok('Created a relation between company and employee', $companyEmployeeCreated );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyEmployee  $companyEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyEmployee $companyEmployee)
    {
        return ok('Relation between company and employee', $companyEmployee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyEmployeeRequest  $request
     * @param  \App\Models\CompanyEmployee  $companyEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyEmployeeRequest $request, CompanyEmployee $companyEmployee)
    {
        $data = $request->validated();
        $companyEmployeeUpdated = tap($companyEmployee)->update([
            'company_id' => $data['company_id'],
            'employee_id' => $data['employee_id'],
        ]);
        return ok('Relation between company and employee has been updated', $companyEmployeeUpdated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyEmployee  $companyEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyEmployee $companyEmployee)
    {
        $companyEmployee->delete();
        return ok('Relation between company and employee has been deleted', $companyEmployee);
    }
}
