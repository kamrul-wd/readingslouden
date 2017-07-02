@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>

        <strong>Success!</strong> {!! session()->get('success') !!}
    </div><!-- /.alert -->
@endif
@if (session()->has('message'))
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>

        <strong>Heads up!</strong> {!! session()->get('message') !!}
    </div><!-- /.alert -->
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>

        <strong>Error!</strong> {!! session()->get('error') !!}
    </div><!-- /.alert -->
@endif