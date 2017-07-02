// Animation class add remove from row
function render_the_select(row, position){


    remove_animation_box();


    var existing_section_class = row.attr('data-custom-section-class')? row.attr('data-custom-section-class') : '';
    var existing_container_class = row.attr('data-custom-container-class')? row.attr('data-custom-container-class') : '';
    var parallax_link = row.attr('data-section-parallax')? row.attr('data-section-parallax') : '';

    var outputBackgroundcolor = getBackgroundProcess(existing_section_class);

    var html ='<div id="animation_class">';
    html += outputBackgroundcolor;
    html += '<h3 class="popover_heading">Custom section Class <span>each class separate by space</span></h3><input type="text" class="custom_section_class" value="'+existing_section_class+'"/>';
    html += '<h3 class="popover_heading">Custom container Class <span>each class separate by space</span></h3><input type="text" class="custom_container_class" value="'+existing_container_class+'"/>';
    html += '<h3 class="popover_heading">Parallax Image link</h3><input type="text" class="parallax_image" value="'+parallax_link+'"/><a href="#" class="display_background_image_box2">Add image</a>';
    html +='<button id="confirm_animaiton_class">Ok</button><button id="cancel">Cancel</button></div>';


    $('body').append(html);
    $('#animation_class').css({'left': position.x - 20+'px', 'top':position.y+30+'px'});
    position.x = Math.floor(position.x) - 20;

    display_custom_image_upload2(position.x, position.y);

    $('#confirm_animaiton_class').click(function(){
        //custom section class
        var custom_section_class = $('#animation_class input.custom_section_class').val() ? $('#animation_class input.custom_section_class').val() : '';
        var custom_container_class = $('#animation_class input.custom_container_class').val();

        var selected_background_class = $('#animation_class select.background_color :selected').val();

        var parallax_image = $('#animation_class input.parallax_image').val();

        confirm_background_class(row, custom_section_class, selected_background_class, custom_container_class, parallax_image);
    });

    cancel_animation_box();

}

function confirm_background_class(row, custom_section_class, background_class, container_class, parallax_image){
    //check if custome_section_class has any background_class
    var input_section = custom_section_class.split(' ');


    var clear_section_class = '';
    var defaultClass = getDefaultClass();


    for(var i =0; i < input_section.length; i++){
        for(var j=0; j<defaultClass.length; j++){
            if(input_section[i] == defaultClass[j].classname){
                var index = input_section.indexOf(input_section[i]);
                input_section.splice(index, 1);
            }
        }
    }

    clear_section_class = input_section.join(' ');



    var all_section_class = clear_section_class + ' '+ background_class;
    var all_container_class = container_class;

    $(row).attr('data-custom-section-class', all_section_class);
    $(row).attr('data-custom-container-class', all_container_class);
    $(row).attr('data-section-parallax', parallax_image);
    $('#animation_class').remove();

}

function getDefaultClass(){
    var defaultClass = [
        // {title: 'brand-light-text', classname : 'brand-light-text'},
        // {title: 'brand-dark-text', classname : 'brand-dark-text'},
        {title: 'brand-primary-black', classname : 'brand-primary-black'},
        {title: 'brand-primary-white', classname : 'brand-primary-white'},
        {title: 'brand-primary-teal', classname : 'brand-primary-teal'},
        {title: 'brand-secondary-purple', classname : 'brand-secondary-purple'},
        {title: 'brand-secondary-teal', classname : 'brand-secondary-teal'},
        {title: 'brand-secondary-black', classname : 'brand-secondary-black'},
        {title: 'brand-secondary-darkgrey', classname : 'brand-secondary-darkgrey'},
        {title: 'brand-secondary-grey1', classname : 'brand-secondary-grey1'},
        {title: 'brand-secondary-grey2', classname : 'brand-secondary-grey2'},
        {title: 'brand-secondary-grey3', classname : 'brand-secondary-grey3'},
        {title: 'brand-tertiary-blue1', classname : 'brand-tertiary-blue1'},
        {title: 'brand-tertiary-blue2', classname : 'brand-tertiary-blue2'},
        {title: 'brand-tertiary-blue3', classname : 'brand-tertiary-blue3'},
        {title: 'brand-tertiary-iceteal', classname : 'brand-tertiary-iceteal'},
        {title: 'brand-tertiary-teal1', classname : 'brand-tertiary-teal1'},
        {title: 'brand-tertiary-teal2', classname : 'brand-tertiary-teal2'},
        {title: 'brand-tertiary-teal3', classname : 'brand-tertiary-teal3'}
    ];
    return defaultClass;
}


function getBackgroundProcess(existing_class){
    var defaultClass = getDefaultClass();

    var array_existing_class = existing_class.split(' ');

    var html = '<h3 class="popover_heading">Select section background color</h3>';

    html += '<select name="background_color" class="background_color">';
    html += '<option value="">None</option>';

    for(var i= 0; i < defaultClass.length; i++){
        html += '<option value="'+ defaultClass[i].classname+'"';
        for(var j=0; j< array_existing_class.length; j++){
            if(array_existing_class[j] == defaultClass[i].classname){
                html += ' selected';
            }else{

            }
        }
        html += '>'+ defaultClass[i].title +'</option>';
    }

    html += '</select>'


    return html;
}

function remove_animation_box(){
    $('#animation_class').remove();
}

//cancel animation box
function cancel_animation_box(){
    $('#cancel').click(function(){
        remove_animation_box();
    });
}
