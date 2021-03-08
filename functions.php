<?php
add_action('wp_enqueue_scripts', 'twentysixteen_child_assets');
function twentysixteen_child_assets() {
    wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri().'/style.css');
    wp_enqueue_script('script', get_stylesheet_directory_uri().'/scripts.js', array('jquery'), '1.0.0', true);

    // The result of this will be an object named ajaxTest ,
    // which will contain the array given in the final parameter as properties.
    // To grab the value of ajax_url we can use ajaxTest.ajax_url in our JavaScript.
    wp_localize_script('script', 'ajaxTest', array('ajax_url' => admin_url('admin-ajax.php')));
}
function twentysixteen_entry_meta() {
    if ( 'post' === get_post_type() ) {
        $author_avatar_size = apply_filters( 'twentysixteen_author_avatar_size', 49 );
        printf(
            '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
            get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
            _x( 'Author', 'Used before post author name.', 'twentysixteen' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            get_the_author()
        );
    }

    if ( in_array( get_post_type(), array( 'post', 'attachment' ), true ) ) {
        twentysixteen_entry_date();
    }

    $format = get_post_format();
    if ( current_theme_supports( 'post-formats', $format ) ) {
        printf(
            '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
            sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'twentysixteen' ) ),
            esc_url( get_post_format_link( $format ) ),
            get_post_format_string( $format )
        );
    }

    if ( 'post' === get_post_type() ) {
        twentysixteen_entry_taxonomies();
    }

    if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        /* translators: %s: Post title. */
        comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'twentysixteen' ), get_the_title() ) );
        echo '</span>';

        $love = get_post_meta( get_the_ID(), 'show_some_love', true);
        $love = (empty($love)) ? 0 : $love;
        echo '<span class="love-button"> <img width="28" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSI0MHB4IiBpZD0iTGF5ZXJfMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDAgNDA7IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA0MCA0MCIgd2lkdGg9IjQwcHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik0xOS45NzkwMDAxLDkuMTk1MzAwMSAgQzI1LjYzOTIwMDItMS44ODY3LDM4LjUxMTY5OTcsMy4zOTU5OTk5LDM3Ljk0OTE5OTcsMTMuMzAyN0MzNy4zNjM4LDIzLjYxNjE5OTUsMjIuODc0NTAwMywyNy4xNzM3OTk1LDE5Ljk3OTAwMDEsMzQuOTgxODk5MyAgQzE3LjA4MzAwMDIsMjYuOTc5MDAwMSwyLjc4OTU5OTksMjMuODExNTAwNSwyLjAwODMwMDEsMTMuMzAyN0MxLjI3MzksMy40MDc3MDAxLDE0LjkzNTk5OTktMS45MzEyLDE5Ljk3OTAwMDEsOS4xOTUzMDAxeiIgc3R5bGU9ImZpbGwtcnVsZTpldmVub2RkO2NsaXAtcnVsZTpldmVub2RkO2ZpbGw6I0ZGNTk0RjsiLz48L3N2Zz4="><span class="number">' . $love . '</span></span>';
    }
}

add_action('wp_ajax_add_love', 'ajax_test_add_love');
add_action('wp_ajax_nopriv_add_love', 'ajax_test_add_love');
function ajax_test_add_love() {
    $love = get_post_meta($_POST['post_id'], 'show_some_love', true);
    $love = (empty($love)) ? 0 : $love;
    $love++;

    update_post_meta($_POST['post_id'], 'show_some_love', $love);
    echo $love;
    die();
}