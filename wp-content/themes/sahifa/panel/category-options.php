<?php

add_action ( 'edit_category_form_fields', 'tie_category_fields');
function tie_category_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
	$cat_option = get_option('tie_cat_'.$t_id);

	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');

	$sidebars = tie_get_option( 'sidebars' ) ;
	$new_sidebars = array(''=> 'Default');
	
	if (class_exists('Woocommerce'))
		$new_sidebars ['shop-widget-area'] = __( '商城 -WooCommerce页面', 'tie' ) ;
		
	if($sidebars){
		foreach ($sidebars as $sidebar) {
		$new_sidebars[$sidebar] = $sidebar;
		}
	}
		
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	$cat_slider = array();
	$cat_slider[''] = 'Disabled';
	$cat_slider['recent'] = 'Recent Posts';
	$cat_slider['random'] = 'Random Posts';

	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$cat_slider[get_the_ID()] = get_the_title();
	}
?>
<tr class="form-field">
	<td colspan="2">
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/panel/images/empty.png'});
			});
			
			//To Fix WPML Bug
			jQuery( window ).load(function($) {
				var logo_settings = jQuery('input[name=logo_setting_save]').val();
					jQuery("#logo_setting-item input").each(function(){	
					if( jQuery(this).val() == logo_settings ) jQuery(this).attr('checked','checked');
			});
		 });
		</script>
		<div class="tiepanel-item">
			<h3><?php echo theme_name ?> - Category Settings</h3>
			<?php
				tie_cat_options(
					array(	"name" => "Mega 菜单",
							"id" => "cat_mega_menu",
							"cat" => $t_id ,
							"extra_text" => '显示最新文章到主导航，Mega 菜单当前热门菜单形式。' ,
							"type" => "checkbox"));
							
				tie_cat_options(				
					array(	"name" => '自定义侧边栏',
							"id" => "cat_sidebar",
							"type" => "select",
							"cat" => $t_id ,
							"options" => $new_sidebars ));
							
				tie_cat_options(				
					array(	"name" => '自定义幻灯片',
							"id" => "cat_slider",
							"type" => "select",
							"cat" => $t_id ,
							"options" => $cat_slider )); 	
			?>
		</div>	
		
		<div class="tiepanel-item">
			<h3><?php echo theme_name ?> - Category Logo</h3>
			<?php
				tie_cat_options(
					array(	"name" => "自定义logo",
							"id" => "cat_custom_logo",
							"cat" => $t_id ,
							"type" => "checkbox"));
							
				tie_cat_options(
					array( 	"name" => "Logo 设置",
							"id" => "logo_setting",
							"type" => "radio",
							"cat" => $t_id ,
							"options" => array( "logo"=>"自定义logo图像" ,
												"title"=>"显示分类标题" )));
				?>
				<input type="hidden" name="logo_setting_save" value="<?php echo $cat_option['logo_setting'];?>" />
				<?php
				tie_cat_options(
					array(	"name" => "自定义logo图片",
							"id" => "logo",
							"cat" => $t_id ,
							"type" => "upload"));
					
				tie_cat_options(
					array(	"name" => "logo图像（视网膜版@2X）",
							"id" => "logo_retina",
							"type" => "upload",
							"cat" => $t_id ,
							"extra_text" => '请选择一个图像文件的视网膜版本的logo。应该2倍大小的主要logo。')); 			
					
				tie_cat_options(
					array(	"name" => "视网膜logo的标准logo宽度",
							"id" => "logo_retina_width",
							"type" => "short-text",
							"cat" => $t_id ,
							"extra_text" => '如果视网膜logo是上传的,请输入标准的logo(1 x)版本宽度,不要进入视网膜logo宽度。')); 			

				tie_cat_options(
					array(	"name" => "视网膜logo的标准logo高度",
							"id" => "logo_retina_height",
							"type" => "short-text",
							"cat" => $t_id ,
							"extra_text" => '如果视网膜logo是上传的,请输入标准的logo(1 x)版本的高度,不进入视网膜logo高度。')); 			
								
								
				tie_cat_options(
					array(	"name" => "Logo 上边距",
							"id" => "logo_margin",
							"type" => "slider",
							"cat" => $t_id ,
							"unit" => "px",
							"max" => 100,
							"min" => 0 ));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3><?php echo theme_name ?> - 分类风格 </h3>
			<?php
				tie_cat_options(				
					array(	"name" => "主色调",
							"id" => "cat_color",
							"cat" => $t_id ,
							"type" => "color" ));
								
				tie_cat_options(
					array(	"name" => "背景",
							"id" => "cat_background",
							"cat" => $t_id ,
							"type" => "background"));
								
				tie_cat_options(
					array(	"name" => "全屏幕背景",
							"id" => "cat_background_full",
							"cat" => $t_id ,
							"type" => "checkbox"));
				?>
		</div>
				
	</td>
</tr>
<?php
}


// save extra category extra fields hook
add_action ( 'edited_category', 'tie_save_extra_category_fileds');
   // save extra category extra fields callback function
function tie_save_extra_category_fileds( $term_id ) {
	$t_id = $term_id;
	update_option( "tie_cat_$t_id", $_POST["tie_cat"] );
}




function tie_cat_options($value){
	global $options_fonts;
?>
	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
	$cat_option = get_option('tie_cat_'.$value['cat']);
	
	switch ( $value['type'] ) {

		case 'checkbox':
			if( !empty($cat_option[$value['id']]) ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input class="on-of" type="checkbox" name="tie_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;
		
		case 'radio': 
		?>
			<div style="float:left; width: 295px;">
				<?php foreach ($value['options'] as $key => $option) {?>
				<label style="display:block; margin-bottom:8px;"><input  <?php if( !empty($cat_option[$value['id']]) ) checked($cat_option[$value['id']] , $key); ?> id="<?php echo $value['id'] ?>" name="tie_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>"> <?php echo $option; ?></label>
				<?php } ?>
			</div>
		<?php
		break;
		
		case 'select':
		?>
			<select name="tie_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( !empty( $cat_option[$value['id']] ) && ( $cat_option[$value['id']] == $key) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		case 'upload':
		?>
				<input id="<?php echo $value['id']; ?>" class="img-path" type="text" size="56" style="direction:ltr; text-laign:left" name="tie_cat[<?php echo $value['id']; ?>]" value="<?php if( !empty($cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="上传" />
					
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( empty( $cat_option[$value['id']] ) ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']] ; else echo get_template_directory_uri().'/panel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
		<?php
		break;

		case 'slider':
		?>
				<div id="<?php echo $value['id']; ?>-slider"></div>
				<input type="text" id="<?php echo $value['id']; ?>" value="<?php if( !empty( $cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" name="tie_cat[<?php echo $value['id']; ?>]" style="width:50px;" /> <?php echo $value['unit']; ?>
				<script>
				  jQuery(document).ready(function() {
					jQuery("#<?php echo $value['id']; ?>-slider").slider({
						range: "min",
						min: <?php echo $value['min']; ?>,
						max: <?php echo $value['max']; ?>,
						value: <?php if( $cat_option[$value['id']] ) echo $cat_option[$value['id']]; else echo 0; ?>,

						slide: function(event, ui) {
						jQuery('#<?php echo $value['id']; ?>').attr('value', ui.value );
						}
					});
				  });
				</script>
		<?php
		break;
		
		
		case 'background':
	?>
				<input id="<?php echo $value['id']; ?>-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="tie_cat[<?php echo $value['id']; ?>][img]" value="<?php if( !empty($cat_option[$value['id']]['img']) ) echo $cat_option[$value['id']]['img']; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="Upload" />
					
				<div style="margin-top:15px; clear:both">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>"></div></div>
					<input style="width:80px; margin-right:5px;"  name="tie_cat[<?php echo $value['id']; ?>][color]" id="<?php  echo $value['id']; ?>color" type="text" value="<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>" />
					
					<select name="tie_cat[<?php echo $value['id']; ?>][repeat]" id="<?php echo $value['id']; ?>[repeat]" style="width:96px;">
						<option value="" <?php if ( empty ($cat_option[$value['id']]['repeat']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="repeat" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>平铺</option>
						<option value="no-repeat" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>no-repeat不平铺</option>
						<option value="repeat-x" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>repeat-x水平平铺</option>
						<option value="repeat-y" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>repeat-y垂直平铺</option>
					</select>

					<select name="tie_cat[<?php echo $value['id']; ?>][attachment]" id="<?php echo $value['id']; ?>[attachment]" style="width:96px;">
						<option value="" <?php if ( empty( $cat_option[$value['id']]['attachment']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="fixed" <?php if ( !empty($cat_option[$value['id']]['attachment']) && $cat_option[$value['id']]['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>固定</option>
						<option value="scroll" <?php if ( !empty($cat_option[$value['id']]['attachment']) && $cat_option[$value['id']]['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>滚动</option>
					</select>
					
					<select name="tie_cat[<?php echo $value['id']; ?>][hor]" id="<?php echo $value['id']; ?>[hor]" style="width:96px;">
						<option value="" <?php if ( empty($cat_option[$value['id']]['hor']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="left" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>左对齐</option>
						<option value="right" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor']  == 'right') { echo ' selected="selected"' ; } ?>>右对齐</option>
						<option value="center" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor'] == 'center') { echo ' selected="selected"' ; } ?>>居中对齐</option>
					</select>
					
					<select name="tie_cat[<?php echo $value['id']; ?>][ver]" id="<?php echo $value['id']; ?>[ver]" style="width:100px;">
						<option value="" <?php if ( empty($cat_option[$value['id']]['ver'] )) { echo ' selected="selected"' ; } ?>></option>
						<option value="top" <?php if ( !empty($cat_option[$value['id']]['ver']) &&  $cat_option[$value['id']]['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>顶部</option>
						<option value="center" <?php if ( !empty($cat_option[$value['id']]['ver']) && $cat_option[$value['id']]['ver'] == 'center') { echo ' selected="selected"' ; } ?>>居中</option>
						<option value="bottom" <?php if ( !empty($cat_option[$value['id']]['ver']) && $cat_option[$value['id']]['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>底部</option>

					</select>
				</div>
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( empty($cat_option[$value['id']]['img'])  ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $cat_option[$value['id']]['img']) ) echo $cat_option[$value['id']]['img'] ; else echo get_template_directory_uri().'/panel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
					
				<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>color').val('#'+hex);
					}
				});
				tie_styling_uploader('<?php echo $value['id']; ?>');
				</script>
		<?php
		break;
		
		
		case 'color':
		?>
				<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']] ; ?>"></div></div>
			<input style="width:80px; margin-right:5px;"  name="tie_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="text" value="<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']]; ?>" />
							
			<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']] ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>').val('#'+hex);
					}
				});
				</script>
		<?php
		break;
		case 'short-text': ?>
			<input style="width:50px" name="tie_cat[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php if( !empty( $cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" />
		<?php 
		break;		
}
		if( !empty( $value['extra_text'] ) ) { ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php }
?>
</div>
			
<?php
}
?>