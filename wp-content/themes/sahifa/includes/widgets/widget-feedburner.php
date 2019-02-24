<?php
add_action( 'widgets_init', 'tie_feedburner_widget_box' );
function tie_feedburner_widget_box() {
	register_widget( 'tie_feedburner_widget' );
}
class tie_feedburner_widget extends WP_Widget {

	function tie_feedburner_widget() {
		$widget_ops = array( 'classname' => 'widget-feedburner' , 'description' => '通过电子邮件订阅feedburner' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget-feedburner' );
		$this->WP_Widget( 'widget-feedburner',theme_name .' - Feedburner 小工具 ', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		if( function_exists('icl_t') )  $text_code = icl_t( theme_name , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
		$feedburner = $instance['feedburner'];
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title;
		echo '<div class="widget-feedburner-counter">
		<p>'.do_shortcode( $text_code ).'</p>' ; ?>
		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input class="feedburner-email" type="text" name="email" value="<?php _e( '输入你的电子邮箱地址' , 'tie') ; ?>" onfocus="if (this.value == '<?php _e( '输入你的电子邮箱地址' , 'tie') ; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( '输入您的电子邮件地址' , 'tie') ; ?>';}">
			<input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
			<input type="hidden" name="loc" value="en_US">			
			<input class="feedburner-subscribe" type="submit" name="submit" value="<?php _e( '订阅' , 'tie') ; ?>"> 
		</form>
		</div>
		<?php
		echo $after_widget;			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text_code'] = $new_instance['text_code'] ;
		$instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
		
		if (function_exists('icl_register_string')) {
			icl_register_string( theme_name , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'FeedBurner Widget' , 'tie') , 'text_code' => __( 'Subscribe to our email newsletter.' , 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">标题 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">上述电子邮件文本输入字段 : <small>( 支持 : Html & 简码 )</small> </label>
			<textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php if( !empty($instance['text_code']) )  echo $instance['text_code']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner' ); ?>">Feedburner ID : </label>
			<input id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php if( !empty($instance['feedburner']) )  echo $instance['feedburner']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}
?>