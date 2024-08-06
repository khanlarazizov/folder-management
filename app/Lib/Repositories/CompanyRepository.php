<?php

namespace App\Lib\Repositories;

use App\Lib\Repositories\Interfaces\ICompanyRepository;
use App\Models\Company;

class CompanyRepository implements ICompanyRepository
{
    public function getAllCompanies($data)
    {
        $companies = Company::with('projects')
            ->name($data['name'])
            ->paginate(5);
        return $companies;
    }

    public function getCompanyById($id)
    {
        return Company::find($id);
    }

    public function createCompany($data)
    {
        return Company::create($data);
    }

    public function updateCompany($id, $data)
    {
        return Company::find($id)->update($data);
    }

    public function deleteCompany($id)
    {
        Company::find($id)->delete();
    }
}

