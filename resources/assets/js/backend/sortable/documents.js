$(function() {
    $('#document_sort_source, #document_sort_dest')
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
        $('#document_sort_dest').find('li').each(function () {
            ids.push($(this).data('id'));
        })
        $('#document_sort_order').val(ids.join());
    }

    $('#document_sort_dest')
        .on("sortreceive", function (event, ui) {
            callback(event, ui);
        })
        .on("sortstop", function (event, ui) {
            callback(event, ui);
        });
})
