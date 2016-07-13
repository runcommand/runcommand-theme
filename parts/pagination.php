<?php

$bignum = 999999999;
$query = $GLOBALS['wp_query'];
$base_link = str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) );
$max_num_pages = $query->max_num_pages;
$current_page = max( 1, $query->get( 'paged' ) );
$prev_page_label = '&lsaquo; Previous';
$next_page_label = 'Next &rsaquo;';
$args = array(
	'base'          => $base_link,
	'format'        => '',
	'current'       => $current_page,
	'total'         => $max_num_pages,
	'prev_text'     => $prev_page_label,
	'next_text'     => $next_page_label,
	'type'          => 'array',
	'end_size'      => 1,
	'mid_size'      => 2
);

if ( $max_num_pages <= 1 ) {
	return;
}

$pagination_links = paginate_links( $args );

if ( ! empty( $pagination_links ) ) {

	if ( 1 === $current_page ) {
		array_unshift( $pagination_links, '<span class="prev page-numbers">' . esc_html( $prev_page_label ) . '</span>' );
	} else if ( $current_page >= $max_num_pages ) {
		array_push( $pagination_links, '<span class="next page-numbers">' . esc_html( $next_page_label ) . '</span>' );
	}

	echo '<nav class="pagination-centered">';

		echo '<div class="row">';

		echo '<ul class="pagination columns">';
		foreach ( $pagination_links as $paginated_link ) {
			echo '<li>' . $paginated_link . '</li>';
		}
		echo '</ul>';

		echo '</div>';

	echo '</nav>';
}
