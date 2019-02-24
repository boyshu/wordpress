<?php
add_action("admin_init", "posts_init");
function posts_init(){
	add_meta_box("tie_post_options", theme_name ." - 文章选项", "tie_post_options_module", "post", "normal", "high");
	add_meta_box("tie_page_options", theme_name ." - 文章选项", "tie_page_options_module", "page", "normal", "high");
}

function tie_post_options_module(){
	global $post ;
	$get_meta = get_post_custom($post->ID);
	
	if( !empty($get_meta["tie_sidebar_pos"][0]) )
		$tie_sidebar_pos = $get_meta["tie_sidebar_pos"][0];
		
	if( !empty($get_meta["tie_review_criteria"][0]) )
		$tie_review_criteria = unserialize($get_meta["tie_review_criteria"][0]);
?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		  jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/panel/images/empty.png'});
		 });
		jQuery(function() {
			jQuery( "#tie-reviews-list" ).sortable({placeholder: "tie-review-state-highlight"});
		});
	</script>
		<input type="hidden" name="tie_hidden_flag" value="true" />
		<div class="tiepanel-item">
			<h3>文章头部设置</h3>
			<?php	

			tie_post_options(				
				array(	"name" => "显示",
						"id" => "tie_post_head",
						"type" => "select",
						"options" => array(
							''=> '默认',
							'none'=> '无',
							'video'=> '视频',
							'audio'=> '音频 - Self Hosted',
							'soundcloud'=> '音频 - SoundCloud',
							'slider'=> '幻灯片',
							'map'=> '谷歌地图',
							'thumb'=> '特色图像',
							'lightbox'=> '特色图像 + 灯箱'
						)));


			tie_post_options(				
				array(	"name" => "嵌入代码 ",
						"id" => "tie_embed_code",
						"type" => "textarea"));

			tie_post_options(				
				array(	"name" => "视频地址 <br /><small>支持 : YouTube, Vimeo, Viddler, Qik, Hulu, FunnyOrDie, DailyMotion, WordPress.tv and blip.tv</small>",
						"id" => "tie_video_url",
						"type" => "text"));

			tie_post_options(				
				array(	"name" => "SoundCloud 地址",
						"id" => "tie_audio_soundcloud",
						"type" => "text"));
						
			tie_post_options(				
				array(	"name" => "自动播放",
						"id" => "tie_audio_soundcloud_play",
						"type" => "checkbox"));
						
			tie_post_options(				
				array(	"name" => "Mp3 文件地址",
						"id" => "tie_audio_mp3",
						"type" => "text"));

			tie_post_options(				
				array(	"name" => "M4A 文件地址",
						"id" => "tie_audio_m4a",
						"type" => "text"));
						
			tie_post_options(				
				array(	"name" => "OGA 文件地址",
						"id" => "tie_audio_oga",
						"type" => "text"));	
						
			global $post;
			$orig_post = $post;
			
			$sliders = array();
			$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1 ) );
			while ( $custom_slider->have_posts() ) {
				$custom_slider->the_post();
				$sliders[get_the_ID()] = get_the_title();
			}
			$post = $orig_post;
			wp_reset_query();
	
			tie_post_options(				
				array(	"name" => "自定义幻灯片",
						"id" => "tie_post_slider",
						"type" => "select",
						"options" => $sliders ));

			tie_post_options(				
				array(	"name" => "谷歌地图地址",
						"id" => "tie_googlemap_url",
						"type" => "text"));

			?>
		</div>
		<div class="tiepanel-item">

			<h3>文章评级选项</h3>
			<?php	

			tie_post_options(				
				array(	"name" => "点评框位置",
						"id" => "tie_review_position",
						"type" => "select",
						"options" => array( "" => "禁用" ,
											"top" => "文章顶部" ,
											"bottom" => "文章底部",
											"both" => "文章顶部和底部",
											"custom" => "自定义位置")));
			?>
			<p id="taq_custom_position_hint" class="tie_message_hint">
			使用 <strong>[review]</strong> 短代码放置在任何地方的评论框在帖子内容或使用 <strong><?php echo theme_name ?>  - 评论框 </strong> 小工具 .
			</p>
			<div id="reviews-options">
			<?php
			tie_post_options(				
				array(	"name" => "评级风格",
						"id" => "tie_review_style",
						"type" => "select",
						"options" => array( "stars" => "星星" ,
											"percentage" => "百分比",
											"points" => "点数")));
											
			tie_post_options(				
				array(	"name" => "点评摘要",
						"id" => "tie_review_summary",
						"type" => "textarea"));

			tie_post_options(				
				array(	"name" => "文字在总分之下",
						"id" => "tie_review_total",
						"type" => "text"));

			?>
				<input id="tie_add_review_criteria" type="button" class="mpanel-save" value="添加新的评价标准">
				<ul id="tie-reviews-list">
				<?php $i = 0;
				if(!empty($tie_review_criteria) && is_array($tie_review_criteria) ){
					foreach( $tie_review_criteria as $tie_review ){  ; $i++; ?>
					<li class="option-item review-item">
						<div>
						<span class="label">评价标准</span>
						<input name="tie_review_criteria[<?php echo $i ?>][name]" type="text" value="<?php if( !empty($tie_review['name'] ) ) echo $tie_review['name'] ?>" />
						<div class="clear"></div>
						<span class="label">评价分数</span>
						<div id="criteria<?php echo $i ?>-slider"></div>
						<input type="text" id="criteria<?php echo $i ?>" value="<?php if( !empty($tie_review['score']) ) echo $tie_review['score']; else echo 0; ?>" name="tie_review_criteria[<?php echo $i ?>][score]" style="width:40px; opacity: 0.7;" />
						<a class="del-cat"></a>
						<script>
						  jQuery(document).ready(function() {
							jQuery("#criteria<?php echo $i ?>-slider").slider({
								range: "min",
								min: 0,
								max: 100,
								value: <?php if( !empty($tie_review['score']) ) echo $tie_review['score']; else echo 0; ?>,
								slide: function(event, ui) {
									jQuery('#criteria<?php echo $i ?>').attr('value', ui.value );
								}
								});
							});
						</script>
						</div>
					</li>	

						<?php
					}
				}
					?>
				</ul>
				<script>var nextReview = <?php echo $i+1 ?> ;</script>

			</div>
		</div>
		
		<div class="tiepanel-item">
			<h3>侧边栏选项</h3>
			<div class="option-item">
				<?php
					$checked = 'checked="checked"';
				?>
				<ul id="sidebar-position-options" class="tie-options">
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="default" <?php if( ( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'default' ) || empty( $tie_sidebar_pos ) ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-default.png" /></a>
					</li>						<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="right" <?php if( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'right' ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-right.png" /></a>
					</li>
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="left" <?php if( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'left' ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-left.png" /></a>
					</li>
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="full" <?php if( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'full' ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-no.png" /></a>
					</li>
				</ul>
			</div>
			<?php
			$sidebars = tie_get_option( 'sidebars' ) ;
			$new_sidebars = array(''=> 'Default');
			
			if (class_exists('Woocommerce'))
				$new_sidebars ['shop-widget-area'] = __( '商城 -  WooCommerce 页面', 'tie' ) ;
					
			if($sidebars){
				foreach ($sidebars as $sidebar) {
					$new_sidebars[$sidebar] = $sidebar;
				}
			}
					
			tie_post_options(				
				array(	"name" => "选择侧边栏",
						"id" => "tie_sidebar_post",
						"type" => "select",
						"options" => $new_sidebars ));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3>文章风格 </h3>
			<?php
				tie_post_options(				
					array(	"name" => "自定义颜色",
							"id" => "post_color",
							"type" => "color" ));
								
				tie_post_options(
					array(	"name" => "背景",
							"id" => "post_background",
							"type" => "background"));
								
				tie_post_options(
					array(	"name" => "全屏幕背景",
							"id" => "post_background_full",
							"type" => "checkbox"));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3>常规选项</h3>
			<?php	

			tie_post_options(				
				array(	"name" => "隐藏文章元",
						"id" => "tie_hide_meta",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));

			tie_post_options(				
				array(	"name" => "隐藏作者信息",
						"id" => "tie_hide_author",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));
											
			tie_post_options(				
				array(	"name" => "隐藏分享按钮",
						"id" => "tie_hide_share",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));
											
			tie_post_options(				
				array(	"name" => "隐藏相关的文章",
						"id" => "tie_hide_related",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));
			?>
		</div>

		<div class="tiepanel-item">
			<h3>横幅选项</h3>
			<?php	
			tie_post_options(				
				array(	"name" => "隐藏上面横幅",
						"id" => "tie_hide_above",
						"type" => "checkbox"));

			tie_post_options(				
				array(	"name" => "自定义上面横幅",
						"id" => "tie_banner_above",
						"type" => "textarea"));

			tie_post_options(				
				array(	"name" => "横幅下面隐藏",
						"id" => "tie_hide_below",
						"type" => "checkbox"));

			tie_post_options(				
				array(	"name" => "自定义下面横幅",
						"id" => "tie_banner_below",
						"type" => "textarea"));
			?>
		</div>
  <?php
}




/*********************************************************************************************/

function tie_page_options_module(){
	global $post ;
	$get_meta = get_post_custom($post->ID);
	$tie_sidebar_pos = $get_meta["tie_sidebar_pos"][0];	
	
	if( !empty( $get_meta["tie_review_criteria"][0] ) )
		$tie_review_criteria = unserialize($get_meta["tie_review_criteria"][0]);

	$categories_obj = get_categories();
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
?>	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		  jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/panel/images/empty.png'});
		 });
		jQuery(function() {
			jQuery( "#tie-reviews-list" ).sortable({placeholder: "tie-review-state-highlight"});
		});
	</script>
		<input type="hidden" name="tie_hidden_flag" value="true" />	
		
		<div class="tiepanel-item" id="tie-template-feed">
			<h3>显示Feed模板选项</h3>
			<?php	
			tie_post_options(				
				array(	"name" => "RSS源的URI",
						"id" => "tie_rss_feed",
						"type" => "text"));
			?>
		</div>

		<div class="tiepanel-item" id="tie-template-blog">
			<h3>选择分类</h3>
			<div class="option-item">
				<span class="label">分类</span>
				<select multiple="multiple" name="tie_blog_cats[]" id="tie_blog_cats">
					<?php
					 $tie_blog_cats = unserialize($get_meta["tie_blog_cats"][0]);
					 foreach ($categories as $key => $option) { ?>
					<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $tie_blog_cats ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			</div>
			<div id="tie_posts_num">
			<?php	
			tie_post_options(				
				array(	"name" => "文章数量",
						"id" => "tie_posts_num",
						"type" => "text"));
			?>
			</div>
		</div>
		
		<?php
			global $wp_roles;
			$roles = $wp_roles->get_names();
		?>
		<div class="tiepanel-item" id="tie-template-authors">
			<h3>作者模板选项</h3>
			<div class="option-item">
					<span class="label">用户角色</span>
					<select multiple="multiple" name="tie_authors[]" id="tie_authors">
						<?php
						 $tie_authors = unserialize($get_meta["tie_authors"][0]);
						 foreach ($roles as $key => $option) { ?>
						<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $tie_authors ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="tiepanel-item">
			<h3>文章头部选项</h3>
			<?php	

			tie_post_options(				
				array(	"name" => "显示",
						"id" => "tie_post_head",
						"type" => "select",
						"options" => array(
							''=> '默认',
							'none'=> '无',
							'video'=> '视频',
							'audio'=> '音频 - 自托管',
							'soundcloud'=> '音频 - 音乐云',
							'slider'=> '幻灯片',
							'map'=> '谷歌地图',
							'thumb'=> '精选图片',
							'lightbox'=> '精选图片 + 灯箱'
						)));


			tie_post_options(				
				array(	"name" => "嵌入代码",
						"id" => "tie_embed_code",
						"type" => "textarea"));

			tie_post_options(				
				array(	"name" => "视频地址<br /><small>支持 : YouTube, Vimeo, Viddler, Qik, Hulu, FunnyOrDie, DailyMotion, WordPress.tv 和 blip.tv</small>",
						"id" => "tie_video_url",
						"type" => "text"));
						
			tie_post_options(				
				array(	"name" => "SoundCloud 地址",
						"id" => "tie_audio_soundcloud",
						"type" => "text"));
						
			tie_post_options(				
				array(	"name" => "自动播放",
						"id" => "tie_audio_soundcloud_play",
						"type" => "checkbox"));
						
			tie_post_options(				
				array(	"name" => "Mp3 文件地址",
						"id" => "tie_audio_mp3",
						"type" => "text"));

			tie_post_options(				
				array(	"name" => "M4A 文件地址",
						"id" => "tie_audio_m4a",
						"type" => "text"));
					
			tie_post_options(				
				array(	"name" => "OGA 文件地址",
						"id" => "tie_audio_oga",
						"type" => "text"));			

						
			global $post;
			$orig_post = $post;
			
			$sliders = array();
			$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1 ) );
			while ( $custom_slider->have_posts() ) {
				$custom_slider->the_post();
				$sliders[get_the_ID()] = get_the_title();
			}
			$post = $orig_post;
			wp_reset_query();
	
			tie_post_options(				
				array(	"name" => "自定义幻灯片",
						"id" => "tie_post_slider",
						"type" => "select",
						"options" => $sliders ));
						
						
			tie_post_options(				
				array(	"name" => "谷歌地图网址",
						"id" => "tie_googlemap_url",
						"type" => "text"));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3>页面评分选项</h3>
			<?php	

			tie_post_options(				
				array(	"name" => "评论框位置",
						"id" => "tie_review_position",
						"type" => "select",
						"options" => array( "" => "Disable" ,
											"top" => "文章顶部" ,
											"bottom" => "文章底部",
											"both" => "文章顶部和底部",
											"custom" => "自定义位置")));
			?>
			<p id="taq_custom_position_hint" class="tie_message_hint">
			使用 <strong>[review]</strong> 短代码在帖子内容的任何地方放置评论框或使用<strong><?php echo theme_name ?> - 评论框 </strong> 小工具。
			</p>
			<div id="reviews-options">
			<?php
			tie_post_options(				
				array(	"name" => "评论风格",
						"id" => "tie_review_style",
						"type" => "select",
						"options" => array( "stars" => "星星" ,
											"percentage" => "百分比",
											"points" => "点数")));
											
			tie_post_options(				
				array(	"name" => "评论总结",
						"id" => "tie_review_summary",
						"type" => "textarea"));

			tie_post_options(				
				array(	"name" => "文本显示总分",
						"id" => "tie_review_total",
						"type" => "text"));

			?>
				<input id="tie_add_review_criteria" type="button" class="mpanel-save" value="添加新的评分标准">
				<ul id="tie-reviews-list">
				<?php $i = 0;
				if(!empty($tie_review_criteria) && is_array($tie_review_criteria) ){
					foreach( $tie_review_criteria as $tie_review ){  ; $i++; ?>
					<li class="option-item review-item">
						<div>
						<span class="label">评分标准</span>
						<input name="tie_review_criteria[<?php echo $i ?>][name]" type="text" value="<?php if( !empty($tie_review['name'] ) ) echo $tie_review['name'] ?>" />
						<div class="clear"></div>
						<span class="label">点评分数</span>
						<div id="criteria<?php echo $i ?>-slider"></div>
						<input type="text" id="criteria<?php echo $i ?>" value="<?php if( !empty($tie_review['score']) ) echo $tie_review['score']; else echo 0; ?>" name="tie_review_criteria[<?php echo $i ?>][score]" style="width:40px; opacity: 0.7;" />
						<a class="del-cat"></a>
						<script>
						  jQuery(document).ready(function() {
							jQuery("#criteria<?php echo $i ?>-slider").slider({
								range: "min",
								min: 0,
								max: 100,
								value: <?php if( !empty($tie_review['score']) ) echo $tie_review['score']; else echo 0; ?>,
								slide: function(event, ui) {
									jQuery('#criteria<?php echo $i ?>').attr('value', ui.value );
								}
								});
							});
						</script>
						</div>
					</li>	

						<?php
					}
				}
					?>
				</ul>
				<script>var nextReview = <?php echo $i+1 ?> ;</script>
			</div>
		</div>
	
		<div class="tiepanel-item">
			<h3>侧边栏选项</h3>
			<div class="option-item">
				<?php
					$checked = 'checked="checked"';
				?>
				<ul id="sidebar-position-options" class="tie-options">
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="default" <?php if($tie_sidebar_pos == 'default' || !$tie_sidebar_pos ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-default.png" /></a>
					</li>						<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="right" <?php if($tie_sidebar_pos == 'right' ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-right.png" /></a>
					</li>
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="left" <?php if($tie_sidebar_pos == 'left') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-left.png" /></a>
					</li>
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="full" <?php if($tie_sidebar_pos == 'full') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-no.png" /></a>
					</li>
				</ul>
			</div>
			<?php
			$sidebars = tie_get_option( 'sidebars' ) ;
			$new_sidebars = array(''=> 'Default');
			
			if (class_exists('Woocommerce'))
				$new_sidebars ['shop-widget-area'] = __( '商城 - WooCommerce 页面', 'tie' ) ;
					
			if($sidebars){
				foreach ($sidebars as $sidebar) {
					$new_sidebars[$sidebar] = $sidebar;
				}
			}
					
			tie_post_options(				
				array(	"name" => "选择侧边栏",
						"id" => "tie_sidebar_post",
						"type" => "select",
						"options" => $new_sidebars ));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3>页面样式 </h3>
			<?php
				tie_post_options(				
					array(	"name" => "自定义颜色",
							"id" => "post_color",
							"type" => "color" ));
								
				tie_post_options(
					array(	"name" => "背景",
							"id" => "post_background",
							"type" => "background"));
								
				tie_post_options(
					array(	"name" => "全屏幕背景",
							"id" => "post_background_full",
							"type" => "checkbox"));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3>横幅选项</h3>
			<?php	
			tie_post_options(				
				array(	"name" => "隐藏上方横幅",
						"id" => "tie_hide_above",
						"type" => "checkbox"));

			tie_post_options(				
				array(	"name" => "自定义上方横幅",
						"id" => "tie_banner_above",
						"type" => "textarea"));

			tie_post_options(				
				array(	"name" => "隐藏下方横幅",
						"id" => "tie_hide_below",
						"type" => "checkbox"));

			tie_post_options(				
				array(	"name" => "自定义下方横幅",
						"id" => "tie_banner_below",
						"type" => "textarea"));
			?>
		</div>
  <?php
}

add_action('save_post', 'save_post');
function save_post( $post_id ){
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		
    if (isset($_POST['tie_hidden_flag'])) {
	
		$custom_meta_fields = array(
			'tie_rss_feed',
			'tie_hide_meta',
			'tie_hide_author',
			'tie_hide_share',
			'tie_hide_related',
			'tie_sidebar_pos',
			'tie_sidebar_post',
			'tie_post_head',
			'tie_post_slider',
			'tie_googlemap_url',
			'tie_video_url',
			'tie_embed_code',
			'tie_audio_m4a',
			'tie_audio_mp3',
			'tie_audio_oga',
			'tie_audio_soundcloud',
			'tie_audio_soundcloud_play',
			'tie_hide_above',
			'tie_banner_above',
			'tie_hide_below',
			'tie_banner_below',
			'tie_posts_num',
			'post_color',
			'post_background_full',
			'tie_review_position',
			'tie_review_style',
			'tie_review_summary',
			'tie_review_total');
			
		foreach( $custom_meta_fields as $custom_meta_field ){
			if(isset($_POST[$custom_meta_field]) )
				update_post_meta($post_id, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])) );
			else
				delete_post_meta($post_id, $custom_meta_field);
		}
		
		if(isset($_POST[ 'tie_review_criteria' ]) )
			update_post_meta($post_id, 'tie_review_criteria', $_POST['tie_review_criteria']);
		
		if(isset($_POST[ 'tie_blog_cats' ]) )		
			update_post_meta($post_id, 'tie_blog_cats', $_POST['tie_blog_cats']);
			
		if(isset($_POST[ 'post_background' ]) )
			update_post_meta($post_id, 'post_background', $_POST['post_background']);
			
		if(isset($_POST[ 'tie_authors' ]) )	
			update_post_meta($post_id, 'tie_authors', $_POST['tie_authors']);


		$get_meta = get_post_custom($post_id);

		$total_counter = $score = 0;
		if( isset( $get_meta['tie_review_criteria'][0] ))
		$criterias = unserialize( $get_meta['tie_review_criteria'][0] );
		
		if( !empty($criterias) && is_array($criterias) ){
			foreach( $criterias as $criteria){ 
				if( $criteria['name'] && $criteria['score'] && is_numeric( $criteria['score'] )){
					if( $criteria['score'] > 100 ) $criteria['score'] = 100;
					if( $criteria['score'] < 0 ) $criteria['score'] = 1;
						
				$score += $criteria['score'];
				$total_counter ++;
				}
			}
			if( !empty( $score ) && !empty( $total_counter ) )
				$total_score =  $score / $total_counter ;

			update_post_meta($post_id, 'tie_review_score', $total_score);
		}
	}
}




/*********************************************************/

function tie_post_options($value){
	global $post;
?>

	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
		$id = $value['id'];
		$get_meta = get_post_custom($post->ID);
		
		if( isset( $get_meta[$id][0] ) )
			$current_value = $get_meta[$id][0];
			
	switch ( $value['type'] ) {
	
		case 'text': ?>
			<input  name="<?php echo $value['id']; ?>" id="<?php  echo $value['id']; ?>" type="text" value="<?php if( !empty($current_value) )  echo $current_value ?>" />
		<?php 
		break;

		case 'checkbox':
			if( !empty( $current_value ) ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input class="on-of" type="checkbox" name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;
		
		case 'select':
		?>
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( !empty( $current_value ) && $current_value == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		case 'textarea':
		?>
			<textarea style="direction:ltr; text-align:left; width:430px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="3" tabindex="4"><?php if( !empty($current_value) ) echo $current_value  ?></textarea>
		<?php
		break;
		
		case 'background':
			$current_value = unserialize($current_value);
		?>
				<input id="<?php echo $value['id']; ?>-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="<?php echo $value['id']; ?>[img]" value="<?php if( !empty( $current_value['img'] ) ) echo $current_value['img']; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="上传" />
					
				<div style="margin-top:15px; clear:both">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo $current_value['color'] ; ?>"></div></div>
					<input style="width:80px; margin-right:5px;"  name="<?php echo $value['id']; ?>[color]" id="<?php  echo $value['id']; ?>color" type="text" value="<?php echo $current_value['color'] ; ?>" />
					
					<select name="<?php echo $value['id']; ?>[repeat]" id="<?php echo $value['id']; ?>[repeat]" style="width:96px;">
						<option value="" <?php if ( empty( $current_value['repeat'] ) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="repeat" <?php if ( !empty( $current_value['repeat'] ) && $current_value['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>repeat平铺</option>
						<option value="no-repeat" <?php if ( !empty( $current_value['repeat'] ) && $current_value['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>no-repeat不平铺</option>
						<option value="repeat-x" <?php if ( !empty( $current_value['repeat'] ) &&  $current_value['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>repeat-x水平平铺</option>
						<option value="repeat-y" <?php if ( !empty( $current_value['repeat'] ) &&  $current_value['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>repeat-y垂直平铺</option>
					</select>

					<select name="<?php echo $value['id']; ?>[attachment]" id="<?php echo $value['id']; ?>[attachment]" style="width:96px;">
						<option value="" <?php if ( empty( $current_value['attachment'] ) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="fixed" <?php if ( !empty( $current_value['attachment'] ) && $current_value['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>固定的</option>
						<option value="scroll" <?php if ( !empty( $current_value['attachment'] ) &&  $current_value['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>滚动</option>
					</select>
					
					<select name="<?php echo $value['id']; ?>[hor]" id="<?php echo $value['id']; ?>[hor]" style="width:96px;">
						<option value="" <?php if ( empty($current_value['hor']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="left" <?php if ( !empty( $current_value['hor'] ) && $current_value['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>左对齐</option>
						<option value="right" <?php if ( !empty( $current_value['hor'] ) && $current_value['hor']  == 'right') { echo ' selected="selected"' ; } ?>>右对齐</option>
						<option value="center" <?php if ( !empty( $current_value['hor'] ) && $current_value['hor'] == 'center') { echo ' selected="selected"' ; } ?>>居中</option>
					</select>
					
					<select name="<?php echo $value['id']; ?>[ver]" id="<?php echo $value['id']; ?>[ver]" style="width:100px;">
						<option value="" <?php if ( empty( $current_value['ver'] ) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="top" <?php if ( !empty( $current_value['ver'] ) && $current_value['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>顶部</option>
						<option value="center" <?php if ( !empty( $current_value['ver'] ) && $current_value['ver'] == 'center') { echo ' selected="selected"' ; } ?>>居中</option>
						<option value="bottom" <?php if ( !empty( $current_value['ver'] ) && $current_value['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>底部</option>

					</select>
				</div>
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( empty( $current_value['img'] )  ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $current_value['img'] ) ) echo $current_value['img'] ; else echo get_template_directory_uri().'/panel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
					
				<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $current_value['color'] ; ?>',
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
			<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php if( !empty( $current_value ) ) echo $current_value ; ?>"></div></div>
			<input style="width:80px; margin-right:5px;"  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if( !empty( $current_value ) ) echo $current_value ; ?>" />
							
			<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $current_value ; ?>',
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
	} ?>
	</div>
<?php
}
?>