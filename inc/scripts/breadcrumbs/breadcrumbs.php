<?php
/*
Plugin Name: Simple Breadcrumb Navigation
Plugin URI: http://www.kriesi.at/archives/wordpress-plugin-simple-breadcrumb-navigation
Description: A simple and very lightweight breadcrumb navigation that covers nested pages and categories
Version: 1
Author: Christian "Kriesi" Budschedl
Author URI: http://www.kriesi.at/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class simple_breadcrumb {
    var $options;
    
    function simple_breadcrumb() {
            $this->options = array(//change this array if you want another output scheme
            'before' => '<span class="breadarrow"> ',
            'after' => ' </span>',
            'delimiter' => '&rarr;'
        );
        $markup = $this->options['before'] . $this->options['delimiter'] . $this->options['after'];
        global $post;
        echo '<div class="sixteen columns"><a href="' . get_bloginfo('url') . '">';
        //bloginfo('name');
        esc_html_e('Home', 'udesign');
        echo "</a>";
        if (!is_front_page()) {
            echo $markup;
        }
        $output = $this->simple_breadcrumb_case($post);
        echo "<span class='current_crumb'>";
        if (is_page() || is_single()) {
            the_title();
        } else {
            echo $output;
        }
        echo " </span></div>";
    }

    function simple_breadcrumb_case($der_post) {
        global $post;
        $markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
        if (is_page()){
            if($der_post->post_parent) {
                $my_query = get_post($der_post->post_parent);			 
                $this->simple_breadcrumb_case($my_query);
                $link = '<a href="';
                $link .= get_permalink($my_query->ID);
                $link .= '">';
                $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
                echo $link;
            }
            return;			 	
        }
        if(is_single()){
            $category = get_the_category();
            if (is_attachment()){
                $my_query = get_post($der_post->post_parent);			 
                $category = get_the_category($my_query->ID);
                if( $category != null ) {
                $ID = $category[0]->cat_ID;
                echo get_category_parents($ID, TRUE, $markup, FALSE );
                }
                previous_post_link("%link $markup");

            } elseif ( get_post_type( $post ) == 'post' ) {
                $ID = $category[0]->cat_ID;
                $this->get_category_parents_for_breadcrumbs( $ID, TRUE, $markup, FALSE );

            } else { // custom types
				$post_type = get_post_type( $post->ID );
				$taxonomies = get_object_taxonomies( $post_type , 'names' );
				
				foreach ( $taxonomies as $taxonomy ) {
					$term_links = array();
					$terms = get_the_terms( $id, $taxonomy );

					if ( is_wp_error( $terms ) )
						return $terms;

					if ( $terms ) {
						foreach ( $terms as $term ) {
							$link = get_term_link( $term, $taxonomy );
							if ( is_wp_error( $link ) )
								return $link;
							echo "<a href='".$link."'>".$term->name."</a>".$markup;
						}
					}
				}
				// echo ucwords( get_post_type( $post ) ) . $markup;
            }
            return;
        }
        if(is_category()){
            $category = get_the_category(); 
            $i = $category[0]->cat_ID;
            $parent = $category[0]->category_parent;

            if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
                echo get_category_parents($parent, TRUE, $markup, FALSE);
            }
            return single_cat_title('',FALSE);
        }
        if (is_tax()) { // taxonomy
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            echo $term->name;
        }
        if(is_author()){
            $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
            return esc_html__('Author: ', 'udesign').$curauth->nickname;
        }
        if(is_tag()){ return esc_html__('Tag: ', 'udesign').single_tag_title('',FALSE); }
        if(is_404()){ return esc_html__('404 - Page not Found', 'udesign'); }
        if(is_search()){ return esc_html__('Search', 'udesign'); }
        if(is_year()){ return get_the_time('Y'); }
        if(is_month()){
            $k_year = get_the_time('Y');
            echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
            return get_the_time('F');
        }
        if(is_day() || is_time()){
            $k_year = get_the_time('Y');
            $k_month = get_the_time('m');
            $k_month_display = get_the_time('F');
            echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
            echo "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;
            return get_the_time('jS (l)'); 
        }
    }

	function test_post_is_in_descendant_category( $cats, $_post = null )
	{
	    foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
		return true;
	    }
	    return false;
	}

	function post_is_in_category_or_descendants( $cats, $_post = null )
	{
	    if( in_category( $cats, $_post = null ) || $this->test_post_is_in_descendant_category( $cats, $_post = null ) ) {
		return true;
	    }
	    return false;
	}

	function get_category_parents_for_breadcrumbs( $id, $link = false, $separator = '/' ) {
		global $udesign_options, $portfolio_pages_array;
		$portfolio_cats_array = explode( ',', $udesign_options['portfolio_categories'] );
		if ( $this->post_is_in_category_or_descendants($portfolio_cats_array) ) { // if the current post belongs to any Porfolio category
		    foreach ( $portfolio_pages_array as $portfolio_page_obj ) {
			$port_page_ID = $portfolio_page_obj->ID;
			if ( $this->post_is_in_category_or_descendants( $udesign_options['portfolio_cat_for_page_'.$port_page_ID] ) ) {
			    echo get_category_parents_for_portfolio_page( $id, $link, $separator, FALSE , $port_page_ID );
			    break;
			}
		    }
		} else { // if the current category is a regular blog category
		    echo get_category_parents( $id, $link, $separator, FALSE );
		}
	}
}