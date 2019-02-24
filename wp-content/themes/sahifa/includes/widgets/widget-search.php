<?php
add_action( 'widgets_init', 'tie_search_widget' );
function tie_search_widget() {
	register_widget( 'tie_search' );
}
class tie_search extends WP_Widget {
	function tie_search() {
		$widget_ops = array( 'classname' => 'search'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'search-widget' );
		$this->WP_Widget( 'search-widget',theme_name .' - 搜索框', $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) { ?>
	<div class="search-widget">
		<form method="get" id="searchform" action="<?php echo home_url() ; ?>/">
			<input type="text" id="s" name="s" value="<?php _e( '输入搜索内容，然后回车' , 'tie' ) ?>" onfocus="if (this.value == '<?php _e( '输入搜索内容，然后回车' , 'tie' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( '输入搜索内容，然后回车' , 'tie' ) ?>';}"  />
		</form>
	</div><!-- .search-widget /-->		
<?php
	}
}
?>