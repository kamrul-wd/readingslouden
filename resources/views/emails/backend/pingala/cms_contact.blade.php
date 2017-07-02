Hello {{ $admin['name'] }},

<p>This is a message from {{ $user['name'] }} from {{ $company_details['name'] }} via the contact form on their CMS dashboard.</p>

<p>{!! strip_tags(nl2br($request['message']), '<br>') !!}</p>