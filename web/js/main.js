function ajaxDefaultResponse(data) {
    var result = $.parseJSON(data);
    alert(result.message);

    if (result.status == 'ok') {
    }
}

function ajaxQuery(url, data, response) {
    if (!response) {
        response = ajaxDefaultResponse;
    }

    return $.get(url, data, response);
}


$(function () {
    $('body').on('submit', 'form[data-ajax-form]', function (e) {
        e.preventDefault();
        var form = $(this);

        form.fadeTo(200, .6);
        $.ajax({
            type: 'get',
            url: form.attr('action'),
            'data': form.serialize(),
            'success': function (data) {
                var result = $.parseJSON(data), callback = form.attr('data-ajax-form-response'), fn = window[callback];
                
                if (typeof fn === 'function') {
                    fn(result, form);
                } else {
                    form.fadeTo(200, 1);
                    ajaxDefaultResponse(data);
                }
            }
        });

        return false;
    });
});
