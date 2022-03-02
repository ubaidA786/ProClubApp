<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    public function index()
    {
        /* $paginate = Request::only('paginate')
            ? Request::only('paginate')['paginate']
            : null; */
        $organization = Organization::filter(
            Request::only('search', 'sort_by', 'sort_direction')
        );
        return Inertia::render('Organization/Index', [
            'filters' => Request::all('search', 'sort_by', 'sort_direction'),
            'organizations' => $organization
                ->paginate(10)
                ->withQueryString()
                ->through(
                    fn($organization) => [
                        'id' => $organization->id,
                        'name' => $organization->name,
                        'passcode' => $organization->passcode,
                        'organization_id' => $organization->organization_id,
                        'status' => $organization->status,
                    ]
                ),
        ]);
    }

    public function create()
    {
        return Inertia::render('Organization/Create', [
            'media' => Media::orderBy('title', 'asc')
                ->get()
                ->map->only('id', 'title'),
            'statusList' => [
                ['id' => 1, 'name' => 'Active'],
                ['id' => 0, 'name' => 'Inactive'],
            ],
        ]);
    }

    public function store()
    {
        $form = Request::validate([
            'name' => ['required', 'max:50'],
            'city' => ['max:20'],
            'state' => ['max:20'],
            'zip' => ['max:20'],
            'access_start_date' => ['nullable'],
            'access_end_date' => ['nullable'],
            'website' => ['max:255'],
            'ip_addresses' => ['max:255'],
            'passcode' => ['max:255', 'unique:organizations'],
            'description' => ['max:255'],
            'media_id' => ['nullable', 'numeric'],
        ]);

        Organization::create($form);

        return Redirect::route('organizations')->with(
            'success',
            'Organization created.'
        );
    }

    public function edit(Organization $organization)
    {
        return Inertia::render('Organization/Edit', [
            'organization' => [
                'id' => $organization->id,
                'name' => $organization->name,
                'address_1' => $organization->address_1,
                'address_2' => $organization->address_2,
                'city' => $organization->city,
                'state' => $organization->state,
                'zip' => $organization->zip,
                'website' => $organization->website,
                'access_start_date' => $organization->access_start_date,
                'access_end_date' => $organization->access_end_date,
                'website' => $organization->website,
                'ip_addresses' => $organization->ip_addresses,
                'passcode' => $organization->passcode,
                'description' => $organization->description,
                'media_id' => $organization->media_id,
                'status' => $organization->status,
            ],
            'statusList' => [
                ['id' => 1, 'name' => 'Active'],
                ['id' => 0, 'name' => 'Inactive'],
            ],
            'media' => Media::orderBy('title', 'asc')
                ->get()
                ->map->only('id', 'title'),
        ]);
    }

    public function update(Organization $organization)
    {
        $organization->update(
            Request::validate([
                'name' => ['required', 'max:50'],
                'address_1' => ['max:255'],
                'address_2' => ['max:255'],
                'city' => ['max:20'],
                'state' => ['max:20'],
                'zip' => ['max:20'],
                'website' => ['max:255'],
                'access_start_date' => ['nullable'],
                'access_end_date' => ['nullable'],
                'website' => ['max:255'],
                'ip_addresses' => ['max:255'],
                'passcode' => [
                    'max:255',
                    Rule::unique('organizations')->ignore($organization->id),
                ],
                'description' => ['max:255'],
                'media_id' => ['nullable', 'numeric'],
                'status' => ['required', 'numeric'],
            ])
        );

        return Redirect::route('organizations')->with(
            'success',
            'Organization updated.'
        );
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::route('organizations')->with(
            'success',
            'Organization deleted.'
        );
    }

    public function restore(Organization $organization)
    {
        $organization->restore();

        return Redirect::route('organizations')->with(
            'success',
            'Organization restored.'
        );
    }
}
