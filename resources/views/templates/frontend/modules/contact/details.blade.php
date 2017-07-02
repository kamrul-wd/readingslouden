@foreach($contact_details as $details)
    {{$details->company_name}}<br>
    {{$details->company_address}}
@endforeach
