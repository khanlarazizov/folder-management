<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Lib\Repositories\Interfaces\ICompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public $company;

    public function __construct(ICompanyRepository $company)
    {
        $this->company = $company;
    }

    public function index(Request $request)
    {
        $companies = $this->company->getAllCompanies($request);

        return view('folders.company.index', compact('companies'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $this->company->createCompany($request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function edit($id)
    {
        $company = $this->company->getCompanyById($id);
        return response()->json($company);
    }

    public function update($id, UpdateCompanyRequest $request)
    {
        $this->company->updateCompany($id, $request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $this->company->deleteCompany($id);
    }

}
