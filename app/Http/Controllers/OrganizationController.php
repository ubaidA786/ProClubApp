<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    public function index()
    {
        $paginate = Request::only('paginate')
            ? Request::only('paginate')['paginate']
            : null;
        return Inertia::render('Organization/Index', [
            'filters' => Request::all('search', 'sort_by', 'sort_direction'),
            'organizations' => Organization::filter(
                Request::only('search', 'sort_by', 'sort_direction')
            )
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
        return Inertia::render('Organization/Create');
    }

    public function store()
    {
        $form = Request::validate([
            'name' => ['required', 'max:50'],
            'city' => ['max:20'],
            'state' => ['max:20'],
            'zip' => ['max:20'],
            'access_start_date' => ['date_format:Y-m-d'],
            'access_end_date' => [
                'date_format:Y-m-d',
                'after_or_equal:start_date',
            ],
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
                'access_start_date' => ['date_format:Y-m-d'],
                'access_end_date' => [
                    'date_format:Y-m-d',
                    'after_or_equal:start_date',
                ],
                'website' => ['max:255'],
                'ip_addresses' => ['max:255'],
                'passcode' => ['max:255'],
                'description' => ['max:255'],
                'media_id' => ['numeric'],
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

    public function check()
    {
        $errorMessage = '';
        $organization = Organization::where(
            'passcode',
            Request::input('passcode')
        )->first();
        //passcode not matched
        if (is_null($organization)) {
            $errorMessage = 'Passcode is not correct.';
        } else {
            //check ip
            $ip_addresses = $organization->ip_addresses;
            $result = '';
            if ($ip_addresses != '') {
                if (stristr($ip_addresses, ',')) {
                    $ipAddresses = explode(',', $ip_addresses);
                } else {
                    $ipAddresses = [$ip_addresses];
                }
                if (is_array($ipAddresses) && count($ipAddresses) > 0) {
                    foreach ($ipAddresses as $ipAddress) {
                        $ipAddress = trim($ipAddress);
                        if (
                            !stristr($ipAddress, '/') &&
                            $_SERVER['REMOTE_ADDR'] == $ipAddress
                        ) {
                            $result = 'approved';
                            break;
                        } /* elseif (
                        validateIpAddressIsInWhitelist(
                            $ipAddress,
                            $_SERVER['REMOTE_ADDR']
                        )
                    ) {
                        $result = 'approved';
                    } */
                    }
                } else {
                    $errorMessage =
                        'Please contact your Administrator because the IP Address Range is not in the correct format.';
                }

                if ($result !== 'approved') {
                    // // Record the user information in case we need to retreive this later.
                    // $activity = new ActivityLog();
                    // $activity->add([
                    //     'activityLogType' => 'videoview',
                    //     'activityLogOrganizationId' =>
                    //         $organization->organizationId,
                    //     'activityLogNotes' => 'Blocked IP Address',
                    // ]);
                    $errorMessage =
                        'Your IP Address is not in the approved range to view this organization.';
                }
            } else {
                $errorMessage = 'Whitelist IPs are not provided';
            }
        }

        //if error then redirect to passcode screen with error message
        if ($errorMessage != '') {
            Request::session()->put('organizationAccess', false);
            return Redirect::route('default')->with('success', $errorMessage);
        } else {
            //redirect to organization page if every thing is fine
            Request::session()->put('organizationAccess', true);
            return Redirect::route('default')->with(
                'success',
                'Passcode is correct.'
            );
        }
    }
}
