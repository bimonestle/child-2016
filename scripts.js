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
