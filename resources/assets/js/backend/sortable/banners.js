$(function() {
    $('#banner_sort_source, #banner_sort_dest')
        .sortable({
            connectWith: '.droppable',
            over: function (event, ui) {
                $(ui.placeholder).parent().css({'border': '2px solid #aaa'})
            },
            out: function (event, ui) {
                $(ui.placeholder).parent().css({'border': ''})
            },
            stop: function (event, ui) {
                $(ui.item).parent().css({'border': ''})
            },
        })
        .disableSelection();

    var callback = function (event, ui) {
        var ids = [];
        $('#banner_sort_dest').find('li').each(function () {
            ids.push($(this).data('id'));
        })
        $('#banner_sort_order').val(ids.join());
    }

    $('#banner_sort_dest')
        .on("sortreceive", function (event, ui) {
            callback(event, ui);
        })
        .on("sortstop", function (event, ui) {
            callback(event, ui);
        });
})
