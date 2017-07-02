<div class="service">
    <div class="jumps">
        <div class="container">
            @foreach($items as $wraper)
                <div class="row">
                    @foreach($wraper as $item)
                        <!-- Jump 1 -->
                        <div class="col-xs-12 col-sm-4 jump">
                            <div class="inner" style="background-image:url('{{$item['images']['low_resolution']['url']}}');">
                                <a href="#" class="instagram-modal" data-id="{{$item['id']}}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="modal">
    <!-- Modal content -->
    <div class="modal-content container" id="instagramModal">
        <div class="inner">
            <span class="close">&times;</span>
            <div class="js-carousel-1 owl-carousel owl-theme">
                <div class="item"></div>
            </div>

            <div class="modal-text">
            </div>
            <div class="link"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var instragram_items = {!! json_encode($main_item) !!}
    console.log(item);
</script>