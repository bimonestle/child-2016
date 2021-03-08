jQuery('#masthead').css({ background: 'red' });
jQuery('.widget-title').css({ background: 'red' });
jQuery('.widget-title:eq(0)').css({ background: 'green' });

// gt() selects element after the index/argument given.
// gt(2) means select the particular elements after the index 2 / third element
jQuery('.widget-title:gt(2)').css({ background: 'blue' });

// not() removes an item from the selection
jQuery('.widget:not(.widget_categories) .widget-text').css({ background: 'red' });

// traversing the DOM
jQuery('aside').children().find('h2').css({ background: 'brown' });

// traversing the DOM
jQuery('aside').children().has('.widget-title').css({ background: 'cadetblue' });

// Modifying Content
jQuery('#masthead .site-description').text( 'Read me on <a href="http://premium.wpmudev.org/blog/author/danielpataki">WPMU DEV</a> as well' );
jQuery('#masthead .site-description').html( 'Read me on <a href="http://premium.wpmudev.org/blog/author/danielpataki">WPMU DEV</a> as well' );

// Add Content
jQuery('#masthead .site-description').append(", I'm also on WPMU DEV");
jQuery('#masthead .site-description').prepend("Hello! Please ");

// Modifying properties and style elements
jQuery('.post .entry-title a').css({
    background: '#000000',
    color: '#ffffff',
    padding: '11px',
    borderBottom: '5px solid #F8E71C'
})

jQuery('.post .entry-title').addClass('better-entry-title')

// Modify HTML attributes
jQuery('.post:first').attr('id', 'the-first-post');

// Events in Jquery
jQuery(document).on('dblclick', '#masthead', function () {
    jQuery('#masthead .site-description').text('You have found my double click easter egg!');
});

// Toggle a widget
jQuery('.widget').prepend('<span class="toggle-widget">toggle</span>');
jQuery(document).on('click', '.toggle-widget', function () {
    console.log(this);
    jQuery(this).parent().find('*').not('.toggle-widget .widget-title').toggle();
});

(function ($) {
    // $(document).on('click', '.love-button img', function () {
    //     alert('Love is being given');
    // })
    $(document).on('click', '.love-button img', function () {
        var post_id = parseInt($(this).parents('article.post:first').attr('class').replace('post-','')[0]);
        var $number = $(this).parent().find('.number');

        $.ajax({
            url: ajaxTest.ajax_url,
            type: 'post',
            data: {
                action: 'add_love',
                post_id: post_id
            },
            success: function (response) {
                // alert("Success, the new count is " + response);
                $number.text(response);
            }
        })
    })
})(jQuery);
