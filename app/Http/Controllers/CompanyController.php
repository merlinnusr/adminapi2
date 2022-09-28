<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\UploadImageService;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ok('Companies', Company::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $fileName = (new UploadImageService)->do($request->file('logo'), 'images/');
        $data['logo'] = $fileName;
        $createdCompany = Company::create($data);
        if (empty($createdCompany)) {
            throw new \Exception('Cannot create new company');
        }

        return ok('Created company', $createdCompany);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return ok('Company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        isset($data['name']) ? $company->name = $data['name'] : null;

        isset($data['logo'])
        ?
        $company->logo = (new UploadImageService)->do($request->file('logo'), 'images/')
        : null;

        isset($data['email']) ? $company->email = $data['email'] : null;
        isset($data['website']) ? $company->website = $data['website'] : null;
        $updatedCompany = $company->save();
        if (empty($updatedCompany)) {
            throw new \Exception('Cannot update company');
        }

        return ok('Company has been updated', $company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return ok('Company has been deleted', $company);
    }
}
