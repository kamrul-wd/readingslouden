<div class="card-block pt-0">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Box one content
                </div>
                <div class="card-block">
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box1][heading]', 'Heading', array()) !!}
                        {!! Form::text('extra_content[box1][heading]', isset($home_content->box1->heading) ? $home_content->box1->heading: '' , array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box1][subheading]', 'Sub Heading', array()) !!}
                        {!! Form::text('extra_content[box1][subheading]', isset($home_content->box1->heading) ? $home_content->box1->subheading : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('extra_content[box1][content]', 'Content', array()) !!}
                        {!! Form::textarea('extra_content[box1][content]', isset($home_content->box1->subheading) ? $home_content->box1->content : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box1][link]', 'Link', array()) !!}
                        {!! Form::text('extra_content[box1][link]', isset($home_content->box1->link) ? $home_content->box1->link : '', array('class' => 'form-control input-group-sm')) !!}
                    </div>
                </div>
            </div><!-- Card -->
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    Box two content
                </div>
                <div class="card-block">
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box2][heading]', 'Heading', array()) !!}
                        {!! Form::text('extra_content[box2][heading]', isset($home_content->box2->heading) ? $home_content->box2->heading : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box2][subheading]', 'Sub Heading', array()) !!}
                        {!! Form::text('extra_content[box2][subheading]', isset($home_content->box2->subheading) ? $home_content->box2->subheading : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('extra_content[box2][content]', 'Content', array()) !!}
                        {!! Form::textarea('extra_content[box2][content]', isset($home_content->box2->content) ? $home_content->box2->content : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box2][link]', 'Link', array()) !!}
                        {!! Form::text('extra_content[box2][link]', isset($home_content->box2->link) ? $home_content->box2->link : '', array('class' => 'form-control input-group-sm')) !!}
                    </div>
                </div>
            </div><!-- Card -->
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    Box three content
                </div>
                <div class="card-block">
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box3][heading]', 'Heading', array()) !!}
                        {!! Form::text('extra_content[box3][heading]', isset($home_content->box3->heading) ? $home_content->box3->heading : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box3][subheading]', 'Sub Heading', array()) !!}
                        {!! Form::text('extra_content[box3][subheading]', isset($home_content->box3->subheading) ? $home_content->box3->subheading : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('extra_content[box3][content]', 'Content', array()) !!}
                        {!! Form::textarea('extra_content[box3][content]', isset($home_content->box3->content) ? $home_content->box3->content : '', array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group input-group-sm">
                        {!! Form::label('extra_content[box3][link]', 'Link', array()) !!}
                        {!! Form::text('extra_content[box3][link]', isset($home_content->box3->link) ? $home_content->box3->link : '', array('class' => 'form-control input-group-sm')) !!}
                    </div>
                </div>
            </div><!-- Card -->
        </div>
    </div>
</div>


<div class="card-block pt-0">
    <div class="row">
        <div class="col-2">
            <div class="extra_content_img">
                {!! Form::hidden('extra_content[images][image1]', isset($home_content->images->image1) ? $home_content->images->image1 : '', array('class'   => 'hidden')) !!}
                <img src="{{ isset($home_content->images->image1) ? $home_content->images->image1 : '' }}" class="img-fluid mb-2"/>
                <a href="#" class="btn btn-secondary btn-sm btn-block">Image upload</a>
            </div>
        </div>

        <div class="col-2">
            <div class="extra_content_img">
                {!! Form::hidden('extra_content[images][image2]', isset($home_content->images->image2) ? $home_content->images->image2 : '', array('class'   => 'hidden')) !!}
                <img src="{{ isset($home_content->images->image2) ? $home_content->images->image2 : '' }}" class="img-fluid mb-2"/>
                <a href="#" class="btn btn-secondary btn-sm btn-block">Image upload</a>
            </div>
        </div>

        <div class="col-2">
            <div class="extra_content_img">
                {!! Form::hidden('extra_content[images][image3]', isset($home_content->images->image3) ? $home_content->images->image3 : '', array('class'   => 'hidden')) !!}
                <img src="{{ isset($home_content->images->image3) ? $home_content->images->image3 : '' }}" class="img-fluid mb-2"/>
                <a href="#" class="btn btn-secondary btn-sm btn-block">Image upload</a>
            </div>
        </div>

        <div class="col-2">
            <div class="extra_content_img">
                {!! Form::hidden('extra_content[images][image4]', isset($home_content->images->image4) ? $home_content->images->image4 : '', array('class'   => 'hidden')) !!}
                <img src="{{ isset($home_content->images->image4) ? $home_content->images->image4 : '' }}" class="img-fluid mb-2"/>
                <a href="#" class="btn btn-secondary btn-sm btn-block">Image upload</a>
            </div>
        </div>

        <div class="col-2">
            <div class="extra_content_img">
                {!! Form::hidden('extra_content[images][image5]', isset($home_content->images->image5) ? $home_content->images->image5 : '', array('class'   => 'hidden')) !!}
                <img src="{{ isset($home_content->images->image5) ? $home_content->images->image5 : '' }}" class="img-fluid mb-2"/>
                <a href="#" class="btn btn-secondary btn-sm btn-block">Image upload</a>
            </div>
        </div>

        <div class="col-2">
            <div class="extra_content_img">
                {!! Form::hidden('extra_content[images][image6]', isset($home_content->images->image6) ? $home_content->images->image6 : '', array('class'   => 'hidden')) !!}
                <img src="{{ isset($home_content->images->image6) ? $home_content->images->image6 : '' }}" class="img-fluid mb-2"/>
                <a href="#" class="btn btn-secondary btn-sm btn-block">Image upload</a>
            </div>
        </div>

    </div>
</div>
