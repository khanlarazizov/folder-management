<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Project;
use App\Models\Company;
use App\Models\Folder;
use App\Models\Document;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Əsas səhifə', route('home'));
});

// Home - Company
Breadcrumbs::for('company', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Şirkətlər', route('companies.index'));
});

// Home - Company - Project
Breadcrumbs::for('project', function (BreadcrumbTrail $trail, Company $company) {
    $trail->parent('company');
    $trail->push($company->name, route('companies.projects.index', $company->id));
});

// Home - Company - Project - Folder
Breadcrumbs::for('folder', function (BreadcrumbTrail $trail, Company $company, Project $project) {
    $trail->parent('project', $company);
    $trail->push($project->name, route('companies.projects.folders.index', [$company->id, $project->id]));
});

// Home - Company - Project - Folder - Document
Breadcrumbs::for('document', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder) {
    $trail->parent('folder', $company, $project);
    $trail->push($folder->name, route('companies.projects.folders.documents.index', [$company->id, $project->id, $folder->id]));
});

// Home - Company - Project - Folder - Document - Create Contract
Breadcrumbs::for('contract_create', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder) {
    $trail->parent('folder', $company, $project);
    $trail->push($folder->name, route('companies.projects.folders.documents.contracts.create', [$company->id, $project->id, $folder->id]));
});

// Home - Company - Project - Folder - Document - Create Protocol
Breadcrumbs::for('protocol_create', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder) {
    $trail->parent('folder', $company, $project);
    $trail->push($folder->name, route('companies.projects.folders.documents.protocols.create', [$company->id, $project->id, $folder->id]));
});

// Home - Company - Project - Folder - Document - Create Contract Addition
Breadcrumbs::for('contract_addition_create', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder) {
    $trail->parent('folder', $company, $project);
    $trail->push($folder->name, route('companies.projects.folders.documents.contract-additions.create', [$company->id, $project->id, $folder->id]));
});

// Home - Company - Project - Folder - Document - Create Delivery Statement
Breadcrumbs::for('delivery_statement_create', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder) {
    $trail->parent('folder', $company, $project);
    $trail->push($folder->name, route('companies.projects.folders.documents.delivery-statements.create', [$company->id, $project->id, $folder->id]));
});

// Home - Company - Project - Folder - Document - Edit Contract
Breadcrumbs::for('contract_edit', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder, Document $document) {
    $trail->parent('document', $company, $project, $folder);
    $trail->push($document->number, route('companies.projects.folders.documents.contracts.edit', [$company->id, $project->id, $folder->id, $document->id]));
});

// Home - Company - Project - Folder - Document - Edit Contract Addition
Breadcrumbs::for('contract_addition_edit', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder, Document $document) {
    $trail->parent('document', $company, $project, $folder);
    $trail->push($document->number, route('companies.projects.folders.documents.contract-additions.edit', [$company->id, $project->id, $folder->id, $document->id]));
});

// Home - Company - Project - Folder - Document - Edit Protocol
Breadcrumbs::for('protocol_edit', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder, Document $document) {
    $trail->parent('document', $company, $project, $folder);
    $trail->push($document->number, route('companies.projects.folders.documents.protocols.edit', [$company->id, $project->id, $folder->id, $document->id]));
});

// Home - Company - Project - Folder - Document - Edit Delivery Statement
Breadcrumbs::for('delivery_statement_edit', function (BreadcrumbTrail $trail, Company $company, Project $project, Folder $folder, Document $document) {
    $trail->parent('document', $company, $project, $folder);
    $trail->push($document->number, route('companies.projects.folders.documents.delivery-statements.edit', [$company->id, $project->id, $folder->id, $document->id]));
});

// Home - Tag
Breadcrumbs::for('tag', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Açar sözlər', route('tags.index'));
});

// Home - User
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('İstifadəçilər', route('users.index'));
});
