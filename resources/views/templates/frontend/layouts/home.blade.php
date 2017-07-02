@extends('layouts.frontend.master')

@section('home')
    @if(isset($banners) && $banners)
        {!! $banners !!}
    @endif

    <!-- Content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    {!! $content !!}
                </div>

                <div class="col-12 col-lg-5 services">
                    <div class="inner">
                        <h2>What we Offer</h2>
                        <a href="#">Insurance Loss Specialists</a>
                        <a href="#" class="alt">Commercial Construction Services</a>
                        <a href="#">Domestic Construction Services</a>
                        <a href="#" class="alt">Supply and Logistics</a>
                        <a href="#">Mechanical &amp; Electrical Supplier</a>
                        <a href="#" class="alt">Utilities Provider</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews -->
    <section class="reviews">
        <div class="container">
            <div class="row">

                <h2 class="col-12">What do our customers say?</h2>

                <!-- First -->
                <div class="col-12 col-lg-4 item">
                    <div class="inner">
                        <h3>{{ $home_content->box1->heading ? $home_content->box1->heading : 'Heading' }}</h3>
                        <h4>{{ $home_content->box1->heading ? $home_content->box1->subheading : 'Sub Heading' }}</h4>
                        <p>{{ $home_content->box1->heading ? $home_content->box1->content : 'some content' }}</p>
                    </div>
                    <a href="{{ $home_content->box1->heading ? $home_content->box1->link : '/contact' }}">Read More</a>
                </div>

                <!-- Second -->
                <div class="col-12 col-lg-4 item">
                    <div class="inner">
                        <h3>{{ $home_content->box2->heading ? $home_content->box2->heading : 'Heading' }}</h3>
                        <h4>{{ $home_content->box2->subheading ? $home_content->box2->subheading : 'Sub Heading' }}</h4>
                        <p>{{ $home_content->box2->content ? $home_content->box2->content : 'Content' }}</p>
                    </div>
                    <a href="{{ $home_content->box2->link ? $home_content->box2->link : '/contact' }}">Read More</a>
                </div>

                <!-- Third -->
                <div class="col-12 col-lg-4 item">
                    <div class="inner">
                        <h3>{{ $home_content->box3->heading ? $home_content->box2->heading : 'Heading' }}</h3>
                        <h4>{{ $home_content->box3->subheading ? $home_content->box2->subheading : 'Sub Heading' }}</h4>
                        <p>{{ $home_content->box3->content ? $home_content->box2->content : 'Content' }}</p>
                    </div>
                    <a href="{{ $home_content->box3->link ? $home_content->box2->link : '/contact' }}">Read More</a>
                </div>

            </div>
        </div>
    </section>

    <!-- Partners -->
    <section class="partners">
        <div class="container">
            <div class="row">

                <!-- First -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 logo-outer">
                    <img src="{{ $home_content->images->image1 ? $home_content->images->image1 : 'public/img/partners/ukas.png' }}" alt="We're UKAS Approved" class="img-fluid" />
                </div>

                <!-- Second -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 logo-outer">
                    <img src="{{ $home_content->images->image2 ? $home_content->images->image2 : 'public/img/partners/nfb.png' }}" alt="We're UKAS Approved" class="img-fluid" />
                </div>

                <!-- Third -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 logo-outer">
                    <img src="{{ $home_content->images->image3 ? $home_content->images->image3 : 'public/img/partners/gas-safe.png' }} " alt="We're UKAS Approved" class="img-fluid" />
                </div>

                <!-- Fourth -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 logo-outer">
                    <img src="{{ $home_content->images->image4 ? $home_content->images->image4 :'public/img/partners/chas.png' }}" alt="We're UKAS Approved" class="img-fluid" />
                </div>

                <!-- Fifth -->
                <div class="col-6 col-sm-4 col-md-3 offset-md-3 offset-lg-0 col-lg-2 logo-outer">
                    <img src="{{ $home_content->images->image5 ? $home_content->images->image5 : 'public/img/partners/construction-online.png' }}" alt="We're UKAS Approved" class="img-fluid" />
                </div>

                <!-- Sixth -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 logo-outer">
                    <img src="{{ $home_content->images->image6 ? $home_content->images->image6 : 'public/img/partners/nic-eic.png' }} " alt="We're UKAS Approved" class="img-fluid" />
                </div>

            </div>
        </div>
    </section>
@stop