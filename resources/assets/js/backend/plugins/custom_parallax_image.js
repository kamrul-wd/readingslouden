// Image upload box

function display_custom_image_upload2(posX, posY){

    //do ajax request first and then put all url inthere





}

function render_all_media2(data, posX, posY, element){
    var html = '<div class="ge_custom_edit_box"';
    html += ' style="left:'+posX+'px; top:'+posY+'px"';
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

    update_selected_image2(element);
    return false;

}

function update_selected_image2(element){
    $('.ge_custom_edit_box .ge_custom_add_image_content img').click(function(e){
        var link = $(this).attr('src');

        var target_element = $(element).parent().find('hidden');
        var target_img = $(element).parent().find('img');

        $(target_element).val(link);
        $(target_img).attr('src',link);

        $('.ge_custom_edit_box').remove();

    });
}