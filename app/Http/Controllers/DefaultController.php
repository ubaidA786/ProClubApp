<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Default/Index', [
            'data' => [
                'id' => 15,
            ],
        ]);
    }

    //showmedia
    public function show(Request $request)
    {
        $isAllowed = false;
        $id = $request->session()->get('MediaAccess');
        if ($id > 0) {
            $organization = Organization::with('mediajoin')
                ->where('id', $id)
                ->first();
            if (!is_null($organization)) {
                $isAllowed = true;
            }
        }

        if ($isAllowed == true) {
            return Inertia::render('Default/ShowMedia', [
                'data' => [
                    'name' => $organization->name,
                    'url' =>
                        $organization->mediajoin == null
                            ? null
                            : $organization->mediajoin->url,
                ],
            ]);
        } else {
            return Redirect::route('passcode');
        }
    }

    public function passcode(Request $request)
    {
        return Inertia::render('Default/Passcode', [
            'data' => [
                'id' => 15,
            ],
        ]);
    }

    //validatepasscode
    public function check(Request $request)
    {
        $errorMessage = '';
        $organization = Organization::where(
            'passcode',
            $request->input('passcode')
        )->first();

        $date = date('Y-m-d');

        //passcode not matched
        if (is_null($organization)) {
            $errorMessage = 'Passcode is not correct.';
        } elseif (
            !is_null($organization->access_start_date) &&
            $organization->access_start_date > $date
        ) {
            $errorMessage =
                'You can access on/after ' . $organization->access_start_date;
        } elseif (
            !is_null($organization->access_end_date) &&
            $organization->access_end_date < $date
        ) {
            $errorMessage =
                'Your access is expired on ' . $organization->access_end_date;
        } elseif (
            !is_null($organization->ip_addresses) &&
            '' != $organization->ip_addresses
        ) {
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
            $request->session()->put('MediaAccess', 0);
            return Redirect::route('passcode')->with('error', $errorMessage);
        } else {
            //redirect to organization page if every thing is fine
            $request->session()->put('MediaAccess', $organization->id);
            return Redirect::route('showmedia')->with(
                'success',
                'Passcode is correct.'
            );
        }
    }
}
