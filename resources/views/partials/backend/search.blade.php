<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pt-3">
    {!! Form::open(['route' => 'admin.search', 'method' => 'GET', 'id' => 'site-search']) !!}
        <div class="input-group">
            <input type="search" name="q" class="form-control btn-default-outline" placeholder="Search Site Content...">

            <span class="input-group-btn">
                <button class="btn btn-pingala" type="submit"><i class="fa fa-search"></i></button>
            </span><!-- /.input-group-btn -->
        </div><!-- /.input-group -->
    {!! Form::close() !!}
</div><!-- /.col -->