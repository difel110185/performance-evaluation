<?php

namespace App\Http\Controllers;

use App\Http\ServerErrorResponse;
use App\Http\SuccessResponse;
use App\Http\ValidationErrorResponse;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrganizationController extends Controller
{
    protected $validationRules = [
        'name' => 'required'
    ];

    public function index()
    {
        return new SuccessResponse('', ['organizations' => Organization::all()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $this->validate(request(), $this->validationRules);

            $org = Organization::create(request(['name']));

            $data = [ 'organization' => $org];

            return new SuccessResponse('Organization created successfully', $data);
        }
        catch (ValidationException $e){
            return new ValidationErrorResponse($e);
        }
        catch (\Exception $e){
            return new ServerErrorResponse($e);
        }
    }

    public function show(Organization $organization)
    {
        try {
            $data = [ 'organization' => $organization];

            return new SuccessResponse('', $data);
        }
        catch (\Exception $e){
            return new ServerErrorResponse($e);
        }
    }

    public function edit(Organization $organization)
    {
        //
    }

    public function update(Request $request, Organization $organization)
    {
        try {
            $this->validate(request(), $this->validationRules);

            $organization->fill(request(['name']));

            $organization->save();

            $data = [ 'organization' => $organization];

            return new SuccessResponse('Organization updated successfully', $data);
        }
        catch (ValidationException $e){
            return new ValidationErrorResponse($e);
        }
        catch (\Exception $e){
            return new ServerErrorResponse($e);
        }
    }

    public function destroy(Organization $organization)
    {
        try {
            $organization->delete();

            return new SuccessResponse('Organization deleted successfully');
        }
        catch (\Exception $e){
            return new ServerErrorResponse($e);
        }
    }
}
