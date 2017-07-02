<?php

namespace App\Http\Controllers\Backend;

use Mail;
use Cache;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use GuzzleHttp\Client as Guzzle;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Admin Dashboard';

        $expire = Carbon::now()->addDay(1);

        $cards = Cache::remember('api.dashboard.cards', $expire, function () {
            $client = new Guzzle();
            $api_response = $client->request('GET', config('app.pingala_api_url').'/v1/cards');

            if ($api_response->getStatusCode() == 200) {
                return json_decode($api_response->getBody());
            }

            return [];
        });

        return view('pages.backend.dashboard.index', compact('title', 'cards'));
    }

    /**
     * Send the form data to Pingala email.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postContact(Request $request)
    {
        $admin = User::find(1);
        $user = auth()->user();
        $company_details = CompanyDetail::find(1);

        $data = [
            'admin' => $admin,
            'user' => $user,
            'company_details' => $company_details,
            'request' => $request->all(),
        ];
        //return $data;

        $mail = Mail::send('emails.backend.pingala.cms_contact', $data, function ($mail) use ($data) {
            $mail->from($data['user']['email'], $data['user']['name']);
            $mail->replyTo($data['user']['email'], $data['user']['name']);
            $mail->to($data['admin']['email'], $data['admin']['name']);
            $mail->subject('CMS Contact From: '.$data['company_details']['name']);
        });

        if (! $mail) {
            return back()
                ->with(
                    'error',
                    'Could not contact Pingala. Please call or email us directly.'
                );
        }

        return back()
            ->with(
                'success',
                'Your message was sent to us.
                <br>
                If you need urgent support, please call or email us directly!'
            );
    }
}
