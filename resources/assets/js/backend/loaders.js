$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var Pingala = {
        // To get the correct viewport width based on  http://andylangton.co.uk/articles/javascript/get-viewport-size-javascript/
        getViewPort: function () {
            var e = window,
                a = 'inner';
            if (!('innerWidth' in window)) {
                a = 'client';
                e = document.documentElement || document.body;
            }

            return {
                width: e[a + 'Width'],
                height: e[a + 'Height']
            };
        }
    }

    var content = $('.page-content');
    var available_height = Pingala.getViewPort().height - $('.pingala-footer').outerHeight() - $('.main-header').outerHeight() - $('.sub-header').outerHeight();

    if (content.height() < available_height) {
        content.attr('style', 'min-height:' + available_height + 'px');
    }

    $('[data-toggle="tooltip"]').tooltip()

    // Sortable
    $('tbody#is_sortable').sortable({
        containment: '#page-table',
        handle: '.re-order',
        tolerance: 'pointer',
        placeholder: 'ui-state-highlight',
        opacity: 0.55,
        update: function (e, ui) {
            //$('#content .update_message').show();

            // send reorder request
            var id = $(ui.item).data('page-id');
            var left_sibling_id = $(ui.item).prev().data('page-id');

            // if left_sibling_id is undefined, must be next to home page
            if (!left_sibling_id) {
                left_sibling_id = 'parent';
            }

            if (left_sibling_id) {
                $.post('/admin/pages/ajax/re-order', {
                        id: id,
                        left_sibling_id: left_sibling_id
                    },
                    function (data) {
                        //$('#content .update_message').fadeOut(400, 0);
                    }
                );
            }

        }
    });

    // Toggle Active
    $('.toggle-active').click(function (e) {
        e.preventDefault()

        var icon = this;
        var page_id = $(this).closest('tr').data('page-id')

        $.ajax({
            type: 'POST',
            cache: false,
            url: '/admin/pages/ajax/toggle-active',
            data: {
                id: page_id,
            },
            success: function (data) {
                if (data.state == '1') {
                    $(icon).toggleClass('fa-toggle-off')
                    $(icon).addClass('fa-toggle-on text-success')
                } else {
                    $(icon).removeClass('fa-toggle-on text-success')
                    $(icon).toggleClass('fa-toggle-off')
                }
            },
            error: function (xml, status, error) {
                alert('error')
            },
            always: function () {
                $('.error-message').fadeOut(400, 0)
            }
        })
    })

//     if (typeof tinymce !== 'undefined' && tinymce) {
//         $('#content-full').gridEditor({
//             new_row_layouts: [[12], [6, 6], [4, 4, 4], [4, 8], [8, 4]],
//             content_types: ['tinymce'],
//             source_textarea: $('textarea#content-html'),
//             tinymce: {
//                 config: {
//                     extended_valid_elements:"*[*]",
//                     image_dimensions: false,
//                     entity_encoding: "raw",
//                     valid_children : "+body[style], +style[type]",
//                     apply_source_formatting : false,                //added option
//                     verify_html : false,
//
//                     on: {
//                         instanceReady: function(evt) {
//                             var instance = this;
//                         }
//                     },
//                     height: 500,
//                     plugins: [
//                         "advlist autolink lists link image charmap print preview anchor",
//                         "searchreplace visualblocks code fullscreen",
//                         "insertdatetime media table contextmenu paste imagetools"
//                     ],
//                     toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | addvideobox | code",
//                     image_class_list: [
//                         {title: 'None', value: ''},
//                         {title: 'Thumbnail', value: 'img-thumbnail'},
//                         {title: 'Responsive', value: 'img-fluid'},
//                         {title: 'Rounded', value: 'rounded'},
//                         {title: 'Responsive Rounded', value: 'img-fluid rounded'},
//                         {title: 'Responsive Thumbnail', value: 'img-thumbnail rounded'}
//                     ],
//
//                     setup: function (editor) {
//                         editor.on('init', function(args) {
//                             editor = args.target;
//
//                             editor.on('NodeChange', function(e) {
//                                 if (e && e.element.nodeName.toLowerCase() == 'img') {
//                                     width = e.element.width;
//                                     height = e.element.height;
//                                     tinyMCE.DOM.setAttribs(e.element, {'width': null, 'height': null});
// //                            tinyMCE.DOM.setAttribs(e.element,
// //                                {'style': 'width:' + 0 + '; height:' + 0 + ';'});
// //                                     console.log(width +'px '+ height+ 'px');
//                                 }
//
//                             });
//                         });
//
//
//
//                         // Add upload video content button
//                         editor.addButton('addvideobox', {
//                             text: '',
//                             icon: 'media',
//                             onclick: function (event) {
//                                 $('#video_edit_box').remove();
//                                 var offset = event;
//
//                                 var content = $(editor.getContent());
//                                 var htmlContent = $('.video_content', content);
//                                 var data_option = $(htmlContent).data('video-option');
//                                 var video_object = '';
//                                 // console.log(data_option);
//
//                                 if(typeof data_option != 'undefined'){
//                                     var title = $(content).find('h2').html();
//                                     video_object = data_option;
//                                     video_object.title = title;
//
//                                 }else{
//                                     video_object = get_video_object();
//                                 }
//
//
// //                                    editor.setContent(html);
//                                 $('#mygrid .content_none_editable').removeAttr('data-id');
//
//                                 // get video upload box
//                                 ge_custom_video_upload(editor, event, video_object);
//                             }
//                         });
//                     },
//                     file_browser_callback : function(field_name, url, type, win){
//                         if (type == 'file') {
//                             var filebrowser = "/admin/media/doc-inline/";
//                         }
//
//                         // Provide image and alt text for the image dialog
//                         if (type == 'image') {
//                             var filebrowser = "/admin/media/image-inline/";
//                         }
//
//                         tinymce.activeEditor.windowManager.open({
//                             title : "File Browser",
//                             width : 800,
//                             height : 400,
//                             url : filebrowser
//                         }, {
//                             window : win,
//                             input : field_name
//                         });
//
//                         return false;
//                     }
//
//                 }
//             },
//
//             //add animatie class button
//             row_tools: [
//                 {
//                     title: 'Set Wrapper Class',
//                     iconClass: 'fa fa-columns',
//                     on: {
//                         click: function(event) {
//                             var element = $(this).offset();
//                             var position = {x: element.left, y: element.top};
//                             var row = $(this).closest('.row');
//                             render_the_container_wrapper_class(row, position);
// //                            $(this).closest('.row').css('background-image', 'url(http://placekitten.com/g/300/300)');
//                         }
//                     }
//                 },
//                 {
//                     title: 'Set section container Class',
//                     iconClass: 'fa fa-lastfm',
//                     on: {
//                         click: function(event) {
//                             var element = $(this).offset();
//                             var position = {x: element.left, y: element.top};
//                             var row = $(this).closest('.row');
//                             render_the_select(row, position);
//                             //                            $(this).closest('.row').css('background-image', 'url(http://placekitten.com/g/300/300)');
//                         }
//                     }
//                 },
//                 {
//                     title: 'Set Animation Class',
//                     iconClass: 'fa fa-magic',
//                     on: {
//                         click: function(event) {
//                             var element = $(this).offset();
//                             var position = {x: element.left, y: element.top};
//                             var row = $(this).closest('.row');
//                             render_the_animation_class(row, position);
// //                            $(this).closest('.row').css('background-image', 'url(http://placekitten.com/g/300/300)');
//                         }
//                     }
//                 }
//             ],
//             col_tools:[
//
//             ]
//         });
//
//
//         // Animation class change
//
//         function render_the_animation_class(row, position){
//             remove_animation_box();
//
//
//             var default_class = [
//                 {title: 'None', class : ''},
//                 {title: 'Fade in', class : 'fadeIn'},
//                 {title: 'Slide up', class : 'slideInUp'},
//                 {title: 'Zoom in', class : 'zoomIn'},
//                 {title: 'Light speed in', class : 'lightSpeedIn'}
//             ];
//
//
//             var class_string = row.attr('data-animation-class');
//             if(typeof(class_string) == "undefined"){
//                 class_string = '';
//             }
//
//             var existing_class = class_string.split(' '); //this variable give you array of existing element
//
//
//
//
//
//
//             var html ='<div id="animation_class"><h3>Animation Class</h3><select name="animation">';
//             for(var i=0; i < default_class.length; i++){
//                 html += '<option value="'+default_class[i].class+'"';
//
//                 //get selecte option for this element
//                 for(var j=0; j < existing_class.length; j++){
//                     if(existing_class[j] == default_class[i].class){
//                         html += ' selected'
//                     }
//                 }
//
//
//                 html += '>'+default_class[i].title+'</option>';
//             }
//             html += '</select>';
//             html +='<button id="confirm_animaiton_class">Ok</button><button id="cancel">Cancel</button></div>';
//
//
//             $('body').append(html);
//             $('#animation_class').css({'left': position.x - 20+'px', 'top':position.y+30+'px'});
//
//             $('#confirm_animaiton_class').click(function(){
//                 var all_class = $('#animation_class select :selected').val();
//                 confirm_animation_class(row, all_class);
//             });
//
//             cancel_animation_box();
//         }
//         function confirm_animation_class(row, all_class){
//
//             $(row).attr('data-animation-class', all_class);
//
//             remove_animation_box();
//
//         }// End animation class setting section
//
//
//
//
//         //Container class change
//         function render_the_container_wrapper_class(row, position){
//
//             remove_animation_box();
//
//             var existing_container_wrapper_class = row.data('custom-wrapper-class')? row.data('custom-wrapper-class') : '';
//
//
//             var html ='<div id="animation_class">';
//             html += '<h3 class="popover_heading">Container wrapper Class <span>each class separate by space</span></h3><input type="text" class="custom_wrapper_class" value="'+existing_container_wrapper_class+'"/>';
//             html +='<button id="confirm_animaiton_class">Ok</button><button id="cancel">Cancel</button></div>';
//
//
//             $('body').append(html);
//             $('#animation_class').css({'left': position.x - 20+'px', 'top':position.y+30+'px'});
//
//             $('#confirm_animaiton_class').click(function(){
//                 var custom_container_wrapper_class = $('#animation_class input.custom_wrapper_class').val();
//                 confirm_container_class(row, custom_container_wrapper_class);
//             });
//
//             cancel_animation_box();
//         }
//
//         function confirm_container_class(row, custom_container_wrapper_class){
//             $(row).attr('data-custom-wrapper-class', custom_container_wrapper_class);
//             remove_animation_box();
//
//         }
//
//         function confirm_animation(row, custom_section_class, custom_container_class){
//             $(row).attr('data-custom-section-class', custom_section_class);
//             $(row).attr('data-custom-container-class', custom_container_class);
//
//             remove_animation_box();
//
//         }
//
//         function remove_animation_box(){
//             $('#animation_class').remove();
//         }
//
//         //cancel animation box
//         function cancel_animation_box(){
//             $('#cancel').click(function(){
//                 remove_animation_box();
//             });
//         }
//         //End animation class add remove from row
//
//
//         $('#submit-form-page').submit(function(e){
//             var textarea = $('#content-html');
//             var html = $('#content-full').gridEditor('getHtml');
//             textarea.val(html);
//         });
//     }

    // Page options tabs
    $('#page-option-tabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    // Image Picker
    $('select.image-picker').imagepicker({
        hide_select: true,
        show_label: true
    })

    // Masonry
    var container = $('select.image-picker.js-masonry').next('ul.thumbnails');
    container.imagesLoaded(function () {
        container.masonry({
            itemSelector: 'li'
        })
    })

    // Delete submit
    $('#delete-image').click(function (e) {
        e.preventDefault()
        $('#delete-form').submit()
    })

    // Edit image/media modal
    $('#edit-image').click(function () {
        if($('#image-select option').is(':selected')) {
            $('#image-select option:selected', function () {
                $('#edit-img-wrapper').append('<h4>Image Preview</h4><img class="img-fluid img-rounded" src="' + $('#image-select option:selected').data('img-src') + '">')
            })
        } else {
            alert('Please select an image to edit.')
            return false;
        }
    })

    $('#view-image').click(function () {
        if($('#image-select option').is(':selected')) {
            $('#image-select option:selected', function () {
                $('#view-img-wrapper').append('<h4>Image Preview</h4><img class="img-fluid img-rounded" src="' + $('#image-select option:selected').data('img-src') + '">')
            })
        } else {
            alert('Please select an image to edit.')
            return false;
        }
    })

    $('#viewPopupForImage').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var preset_image_id = button.data('img-id')
        var preset_image_url = button.parent().data('img-src')
        var preset_image_label = button.data('img-label')
        var preset_image_filename = button.data('img-filename')
        var preset_image_size = button.data('img-size')
        var preset_image_dimensions = button.data('img-dimensions').replace(',', 'x')
        var preset_uploaded_date = button.data('uploaded-date')

        var is_banner = button.data('is-banner')
        var preset_banner_heading = button.data('banner-heading')
        var preset_banner_text = button.data('banner-text')
        var preset_banner_link = button.data('banner-link')

        if (preset_image_id) {
            var modal = $(this)
            modal.find('#view-media-id').val(preset_image_id)
            $('#view-img-wrapper').append('<div><img class="img-fluid img-rounded" src="' + preset_image_url + '"></div>')
            $('#view-img-label').html('<div class="form-group"><label class="form-control-label">Image Label</label><input type="text" class="form-control" value="' + preset_image_label + '" readonly></div>')
            $('#view-img-filename').html('<div class="form-group"><label class="form-control-label">Image Filename</label><input type="text" class="form-control" value="' + preset_image_filename + '" readonly></div>')
            $('#view-img-size').html('<div class="form-group"><label class="form-control-label">Image Size</label><input type="text" class="form-control" value="' + preset_image_size + '" readonly></div>')
            $('#view-img-dimensions').html('<div class="form-group"><label class="form-control-label">Image Dimensions</label><input type="text" class="form-control" value="' + preset_image_dimensions +'" readonly></div>')
            $('#view-uploaded-date').html('<div class="form-group"><label class="form-control-label">Image Upload Date</label><input type="text" class="form-control" value="' + preset_uploaded_date +'" readonly></div>')

            if (is_banner) {
                $('#view-banner-heading').html('<label class="form-control-label">Banner Heading</label><input type="text" class="form-control" value="' + preset_banner_heading +'" readonly>')
                $('#view-banner-text').html('<label class="form-control-label">Banner Text</label><input type="text" class="form-control" value="' + preset_banner_text +'" readonly>')
                $('#view-banner-link').html('<label class="form-control-label">Banner Link</label><input type="text" class="form-control" value="' + preset_banner_link +'" readonly>')
            }
        } else {
            $('#view-media-id').val($('#image-select option:selected').data('view-img-id'))
        }
    }).on('hidden.bs.modal', function () {
        $('#view-img-wrapper').empty()
    })

    $('#editPopupForBanner').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var preset_image_id = button.data('img-id')
        var preset_image_label = button.data('img-label')
        var preset_banner_heading = button.data('banner-heading')
        var preset_banner_text = button.data('banner-text')
        var preset_banner_link = button.data('banner-link')
        var preset_banner_preset = button.data('img-preset')

        var modal = $(this)
        modal.find('#edit-banner-id').val(preset_image_id)
        modal.find('#edit-banner-label').val(preset_image_label)
        modal.find('#edit-banner-heading').val(preset_banner_heading)
        modal.find('#edit-banner-text').val(preset_banner_text)
        modal.find('#edit-banner-link').val(preset_banner_link)
        modal.find('#edit-banner-preset').val(preset_banner_preset)
    }).on('hidden.bs.modal', function () {
        $('#edit-banner-id').empty()
        $('#edit-banner-label').empty()
        $('#edit-banner-heading').empty()
        $('#edit-banner-text').empty()
        $('#edit-banner-link').empty()
        $('#edit-banner-preset').empty()
    })

    $('#editPopupForImage').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var preset_image_id = button.data('img-id')
        var preset_image_label = button.data('img-label')

        if (preset_image_label) {
            var modal = $(this)
            modal.find('#edit-media-id').val(preset_image_id)
            modal.find('#edit-media-label').val(preset_image_label)
        } else {
            $('#edit-media-id').val($('#image-select option:selected').data('img-id'))
            $('#edit-media-label').val($('#image-select option:selected').data('image-label'))
        }
    }).on('hidden.bs.modal', function () {
        $('#edit-img-wrapper').empty()
        $('#edit-media-label').empty()
    })

    $('#edit-banner-button').click(function (e) {
        e.preventDefault()

        $('#edit-banner-form').submit()
    })

    $('#edit-media-button').click(function (e) {
        e.preventDefault()

        $('#edit-media-form').submit()
    })

    // Cropper
    // put img path into src attribute for cropper
    $('#crop-image').click(function () {
        if($('#image-select option').is(':selected')) {
            $('#image-select option:selected', function () {
                $('#crop-img-wrapper').append('<div><img class="crop-img" src="' + $('#image-select option:selected').data('full-src') + '"></div>')
            })
        } else {
            alert('Please select an image to crop.')
            return false;
        }
    })

    var $image = $('#crop-img-wrapper img');
    var cropBoxData;

    $('#cropperPopup').on('shown.bs.modal', function () {
        var $image = $('#crop-img-wrapper img');

        $image.cropper({
            viewMode: 2,
            autoCropArea: 0.5,
            responsive: true,
            scalable: true,
            zoomable: false,
            dragMode: 'none',
            built: function () {
                $image.cropper('setCropBoxData', cropBoxData)
            }
        })

        $('#crop-image-id')
            .val($('#image-select option:selected').data('img-id'))

        $('#change-cropper').on('change', function (e) {
            $image.cropper('destroy')

            var width = parseInt($(this).find(':selected').data('width'))
            var height = parseInt($(this).find(':selected').data('height'))
            var cropper = parseInt($(this).find(':selected').data('cropper'))

            if (width > 0 && height > 0) {
                $image.cropper({
                    viewMode: 1,
                    zoomable: false,
                    dragMode: 'none',
                    aspectRatio: width / height,
                    cropBoxResizable: true,
                })
            } else {
                var newData

                $image.cropper({
                    viewMode: 1,
                    zoomable: false,
                    dragMode: 'none',
                    built: function () {
                        $image.cropper('setCropBoxData', newData)
                    }
                })
            }
        })

        $image.on('crop.cropper', function (e) {
            var data = $image.cropper('getData', true);
            var cropData = {
                'x_axis': data.x,
                'y_axis': data.y,
                'height': data.height,
                'width': data.width,
            }

            $('#crop-x-axis').val(cropData.x_axis)
            $('#crop-y-axis').val(cropData.y_axis)
            $('#crop-width').val(cropData.width)
            $('#crop-height').val(cropData.height)
        })
    }).on('hidden.bs.modal', function () {
        cropBoxData = $image.cropper('getCropBoxData')
        $image.cropper('destroy')

        $('#crop-img-wrapper').empty()
    })

    $('.accordion-presets').on('show.bs.collapse', function (e) {
        $(e.target).prev('.panel-heading').find('i.accordion-icon').toggleClass('fa-caret-up fa-caret-down', 200, 'easeOutSine')
    }).on('hide.bs.collapse', function (e) {
        $(e.target).prev('.panel-heading').find('i.accordion-icon').toggleClass('fa-caret-down fa-caret-up', 200, 'easeOutSine')
    })

    $('#crop-image-button').click(function (e) {
        e.preventDefault()
        $('#crop-image-form').submit()
    })

    if (! $('.slug-source').val()) {
        $('.slug-gen').slugify('.slug-source')
    }

    $('#excerpt').maxCharWarning()

})
