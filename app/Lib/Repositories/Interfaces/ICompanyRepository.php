<?php

namespace App\Lib\Repositories\Interfaces;


interface ICompanyRepository
{
    public function getAllCompanies($data);

    public function getCompanyById($id);

    public function createCompany($data);

    public function updateCompany($id, $data);

    public function deleteCompany($id);
}


