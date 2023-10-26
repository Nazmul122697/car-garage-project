<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade as Share;

class ShareController extends Controller
{
    public function share(Request $request)
    {
        $url = route('customer.certificate.view', $request->application_id);
        switch ($request->platform) {
            case 'facebook':
                $share = Share::page($url)->facebook();
                $generatedUrls = $share->getRawLinks();
                return redirect($generatedUrls);
                break;
            case 'whatsapp':
                $share = Share::page($url)->whatsapp();
                $generatedUrls = $share->getRawLinks();
                return redirect($generatedUrls);
                break;
            case 'email':
                $subject = 'Check out this page';
                $body = 'Hi, I wanted to share this page with you: ' . $url; // Customize the email body as needed
                $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&su=' . urlencode($subject) . '&body=' . urlencode($body);
                return redirect($gmailUrl);
                break;
            case 'linkedin':
                $share = Share::page($url)->linkedin('certificate');
                $generatedUrls = $share->getRawLinks();
                return redirect($generatedUrls);
                break;

            default:
                notify()->error('Invalid link', 'Error');
                return redirect()->back();
                break;
        }
    }
}
