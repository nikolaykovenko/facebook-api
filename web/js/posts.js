$(function() {
    $('[data-post-id]').on('click', '[data-like]', function () {
        var button = $(this)
        button.addClass('disabled');
        
        ajaxQuery(
         '/post/add-like',
         {'post': $(this).parents('[data-post-id]').data('post-id'), 'likeType': $(this).data('like')},
         function (data) {
             button.removeClass('disabled');
             var result = $.parseJSON(data);
             if (result.status == 'ok') {
                 var likesCount = button.find('[data-likes-count]');
                 likesCount.html(parseInt(likesCount.html()) + 1);
             }
             alert(result.message);
        });
    });
});
