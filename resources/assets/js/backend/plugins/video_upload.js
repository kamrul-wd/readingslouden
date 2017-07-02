function ge_custom_video_upload(editor, event, video_object){

    var posX = event.pageX;
    var posY = event.pageY;



    var html = '<div id="video_edit_box" class="video_edit_box" ';
    html += ' style="left:'+(posX - 400)+'px; top:'+posY+'px"';
    html +='><h2>Edit video</h2>';
    html +='<div class="ge_video_group"><label>Title</label><input type="text" name="video_title" value="'+video_object.title+'" class="videoTitle"/></div>';
    html +='<div class="ge_video_group"><label>Your background url</label><input type="text" name="video_background_url" value="'+video_object.backgroundUrl+'" class="backgroundUrl"/> <div class="add_background_box"><a href="#" class="display_background_image_box">Add image</a></div><div style="clear:both"></div></div>';
    html +='<div class="ge_video_group"><label>Image Alt text</label><input type="text" name="img_alt_text" value="'+video_object.altText+'" class="altText"/></div>';
    // html +='<div class="ge_video_group"><label>Img class</label><input type="text" name="img_class" value="'+video_object.imgClass+'" class="img_class"/></div>';
    // html +='<div class="ge_video_group"><label>Icon url</label><input type="text" name="icon_url" value="'+video_object.iconUrl+'" class="icon_url"/></div>';
    // html +='<div class="ge_video_group"><label>Icon class</label><input type="text" name="icon_class" value="'+video_object.iconClass+'" class="icon_class"/></div>';
    html +='<div class="ge_video_group"><label>Youtube Video url</label><input type="text" name="video_url" value="'+video_object.videoUrl+'" class="video_url"/></div>';
    // html +='<div class="ge_video_group"><label>Video class</label><input type="text" name="video_class" value="'+video_object.videoClass+'" class="video_class"/></div>';
    html += '<div class="video_button_group"><button class="ge_video_button_ok">Ok</button><button class="ge_video_button_cancel">Cancel</button></div>';

    html += '</div>';

    $('body').append(html);

    confirm_video_edit(editor, posY);
    close_video_edit();

    // Display image upload box
    display_custom_image_upload(posX, posY);


}



function fillUpObject(){
    var title = $('#video_edit_box input.videoTitle').val();
    var backgroundUrl = $('#video_edit_box input.backgroundUrl').val();
    var altText = $('#video_edit_box input.altText').val();
    // var imgClass = $('#video_edit_box input.img_class').val();
    // var iconUrl = $('#video_edit_box input.icon_url').val();
    // var iconClass = $('#video_edit_box input.icon_class').val();
    var videoUrl = $('#video_edit_box input.video_url').val();
    // var videoClass = $('#video_edit_box input.video_class').val();

    var object = get_video_object();

    object.title = title;
    object.backgroundUrl = backgroundUrl;
    object.altText = altText;
    // object.imgClass = imgClass;
    // object.iconUrl = iconUrl;
    // object.iconClass = iconClass;
    object.videoUrl = videoUrl;
    // object.videoClass = videoClass;

    return object;

}

function confirm_video_edit(editor, posy){
    $('#video_edit_box .ge_video_button_ok').click(function(){
        var object = fillUpObject();

        var clone_obj = $.extend({}, object);
        delete clone_obj.title;

        var obj_string = JSON.stringify(clone_obj);
        var html = create_video_element(object, obj_string, posy);

        $('#video_edit_box').remove();
        editor.setContent(html);
        disable_modal_open();
    });
}

function disable_modal_open(){
    $('#myGrid .row .video_content img').click(function(e){
        return false;
    });
}
function close_video_edit(){
    $('#video_edit_box .ge_video_button_cancel').click(function(){
        $('#video_edit_box').remove();
    });
}

function get_video_object() {
    return {
        title: 'Your title',
        backgroundUrl: '/assets/img/default/internal-hero.jpg',
        altText :'Alt text',
        imgClass:'Image class',
        iconUrl:'/assets/img/default/homepage-play-button.png',
        iconClass:'Icon Class',
        videoUrl: 'https://www.youtube.com/embed/vcKAKul9E1s',
        videoClass:'Video Class',
        geClass: ''
    }
}



function create_video_element(video_obj, video_obj_string, posy){
    $html = '<div contenteditable="false">';
    $html +='<div class="video_content" data-video-option=\''+video_obj_string+'\'>';

    var id = Math.floor((Math.random() * posy) + 1);

    //video edit
    $html += '<h2>'+video_obj.title+'</h2>';
    $html += '<div class="video-placeholder" style="background-image:url(';
    $html += "'";
    $html += video_obj.backgroundUrl
    $html += "');";
    $html += '">';
    $html += '<img data-toggle="modal" data-target="#videoModal_'+id+'" class="'+video_obj.iconClass+'" src="'+video_obj.iconUrl+'" alt="'+video_obj.altText+'" /></div>';


    $html += '<div class="modal" id="videoModal_'+id+'" tabindex="-1" role="dialog" aria-labelledby="video-modal" aria-hidden="true">';
    $html += '<div class="embed-responsive embed-responsive-4by3 the-video">';
    $html += '<div class="embed-responsive-item hidden-md-up"><iframe '+video_obj.videoClass+'" src="'+video_obj.videoUrl+'" frameborder="0" allowfullscreen></iframe></div>';
    $html += '</div><div class="hidden-sm-down"><iframe class="hidden-sm-down '+video_obj.videoClass+'" src="'+video_obj.videoUrl+'" width="620" height="470" frameborder="0"></iframe></div>';
    $html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    $html += '<span aria-hidden="true">&times;</span></button></div></div></div>';
    return $html;
}



// Image upload box

function display_custom_image_upload(posX, posY){

    //do ajax request first and then put all url inthere

    $('#video_edit_box .add_background_box a').click(function(){
        $.ajax({
            type: 'GET',
            cache: false,
            url: '/admin/media/json/all',
            success: function (data) {
                render_all_media(data, posX, posY);
            },
            error: function (xml, status, error) {
                console.log(error);
            },
            always: function () {
            }
        });
        return false;
    });



}

function render_all_media(data, posX, posY){
    var html = '<div class="ge_custom_edit_box"';
    html += ' style="left:'+(posX - 400)+'px; top:'+posY+'px"';
    html += '><h2>Select image</h2>';
    html += '<div class="ge_custom_add_image_content">';
    if(data.length > 0){
        for(var i=0; i< data.length; i++){
            html += '<img src="/uploads/images/'+data[i].filename+'"/>'
        }
    }else{
        html += '<h2>No media found</h2>'
    }
    html += '</div>';
    html += '</div>';

    $('body').append(html);

    update_selected_image();
    return false;

}

function update_selected_image(){
    $('.ge_custom_edit_box .ge_custom_add_image_content img').click(function(e){
        var link = $(this).attr('src');

        $('#video_edit_box input.backgroundUrl').val(link);

        $('.ge_custom_edit_box').remove();

    });
}

