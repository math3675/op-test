<?php // Opening PHP tag - nothing should be before this, not even whitespace
// Custom Function to Include
function my_favicon_link() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />' . "\n";
}
add_action( 'wp_head', 'my_favicon_link' );