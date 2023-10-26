jQuery(document).ready(function () {

    let page = 4;
    let $loadMoreButton = jQuery('#loadmore');

    $loadMoreButton.on('click', function () {
        var max_pages = jQuery(this).data("page_id");

        $.ajax({

            url: ajax_posts.ajaxurl,
            type: 'POST',

            data: {
                action: 'load_more_posts',
                page: page,
            },

            success: function (response) {

                if (response) {

                    if (parseInt(max_pages) + 1 == page) {
                        // $('#loadmore').css({ backgroundColor: '#999' }).html('No more posts').attr('disabled', true);
                        $('#loadmore').hide();
                    }
                    jQuery('.blogs-details').append(response);

                }
            }
        });

        page++;
    });
});