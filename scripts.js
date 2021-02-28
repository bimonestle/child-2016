jQuery('#masthead').css({ background: 'red' });
jQuery('.widget-title').css({ background: 'red' });
jQuery('.widget-title:eq(0)').css({ background: 'green' });

// gt() selects element after the index/argument given.
// gt(2) means select the particular elements after the index 2 / third element
jQuery('.widget-title:gt(2)').css({ background: 'blue' });

// not() removes an item from the selection
jQuery('.widget:not(.widget_categories) .widget-title').css({ background: 'red' });
