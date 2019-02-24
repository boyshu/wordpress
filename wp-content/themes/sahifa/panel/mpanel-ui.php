<?php
function panel_options() { 

	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}
	
	
$save='
	<div class="mpanel-submit">
		<input type="hidden" name="action" value="test_theme_data_save" />
        <input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
		<input name="save" class="mpanel-save" type="submit" value="保存更改" />    
	</div>'; 
?>
		
		
<div id="save-alert"></div>

<div class="mo-panel">

	<div class="mo-panel-tabs">
		<div class="logo"></div>
		<ul>
			<li class="tie-tabs general"><a href="#tab1"><span></span>常规设置</a></li>
			<li class="tie-tabs homepage"><a href="#tab2"><span></span>首页</a></li>
			<li class="tie-tabs header"><a href="#tab9"><span></span>页眉</a></li>
			<li class="tie-tabs archives"><a href="#tab12"><span></span>归档</a></li>
			<li class="tie-tabs article"><a href="#tab6"><span></span>文章</a></li>
			<li class="tie-tabs sidebars"><a href="#tab11"><span></span>侧边栏</a></li>
			<li class="tie-tabs footer"><a href="#tab7"><span></span>页脚</a></li>
			<li class="tie-tabs slideshow"><a href="#tab5"><span></span>幻灯片</a></li>
			<li class="tie-tabs banners"><a href="#tab8"><span></span>广告</a></li>
			<li class="tie-tabs styling"><a href="#tab13"><span></span>样式</a></li>
			<li class="tie-tabs typography"><a href="#tab14"><span></span>排版</a></li>
			<li class="tie-tabs Social"><a href="#tab4"><span></span>社交网络</a></li>
			<li class="tie-tabs advanced"><a href="#tab10"><span></span>高级</a></li>
			<li class="tie-tabs tie-rate tie-not-tab"><a target="_blank" href="http://themeforest.net/downloads?ref=mo3aser"><span></span>评价 <?php echo theme_name ?></a></li>
			<li class="tie-tabs tie-more tie-not-tab"><a target="_blank" href="http://www.luoxiao123.cn"><span></span>更多主题</a></li>
		</ul>
		<div class="clear"></div>
	</div> <!-- .mo-panel-tabs -->
	
	
	<div class="mo-panel-content">
	<form action="/" name="tie_form" id="tie_form">
		<div id="tab1" class="tabs-wrap">
			<h2>常规设置</h2> <?php echo $save ?>
			<?php if(class_exists( 'bbPress' )): ?>
			<div class="tiepanel-item">
				<h3>bbPress Settings</h3>
				<?php
					tie_options(
						array(	"name" => "bbPress 全宽比例",
								"id" => "bbpress_full",
								"type" => "checkbox"));
				?>
			</div>
			<?php endif; ?>
            <div class="tiepanel-item">
				<h3>用户中心</h3>
				<?php
					tie_options(
						array(	"name" => "用户中心公告",
								"id" => "user_tips",
								"type" => "textarea",
								"help" => "用于在用户中心页面显示网站公告！"
								));
					tie_options(
						array(	"name" => "反馈建议链接",
								"id" => "user_fankuilinks",
								"type" => "text",
								"help" => "用于在用户中心右上角反馈建议按钮链接！"
								));
				?>
			</div>
            
                                
              <div class="tiepanel-item">
				<h3>SEO设置</h3>
				<?php
					tie_options(
						array(	"name" => "首页关键字",
								"id" => "homepage_keywords",
								"type" => "textarea"));
					tie_options(
						array(	"name" => "首页描述",
								"id" => "homepage_description",
								"type" => "textarea"));
								
				?>
			</div>	   
            <div class="tiepanel-item">
				<h3>增强功能设置</h3>
				<?php
					tie_options(
						array(	"name" => "启用图片灯箱",
								"id" => "lightbox",
                    "type" => "checkbox",
					"help" => "开启图片灯箱，可以让访客在文章中点击查看原始尺寸的大图片。"
                  ));
				 tie_options(array(
                    "name" =>"延迟加载文章图片",
                    "id" => "lazyload",
                    "type" => "checkbox",
                    "help" => "启用延迟加载文章图片，只有滚动到图片可视区时，才加载图片，这样可以加快网页的打开速度。"
                  ));
				  tie_options(array(
                    "name" =>"jQuery CDN加速(可选)",
                    "id" => "jquery_cdn",
                    "type" => "select",
                    "options" => array( "default"=>"wordpress自带（默认）",
                    "google"=>"谷歌",
                    "mrosoft"=>"微软",
                    "baidu"=>"百度",
                    "sae"=>"新浪",
                    "qiniu"=>"七牛云",
                    "upyun"=>"又拍云",
                    "jquery"=>"jquery官方"
                    ),
                    "help"=>"选择一个 jquery库 CDN 加速服务."
                  ));			
								
				?>
			</div>               
			<div class="tiepanel-item">
				<h3>收藏小图标</h3>
				<?php
					tie_options(
						array(	"name" => "自定义favicon.ico",
								"id" => "favicon",
								"type" => "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3>自定义头像</h3>
				
				<?php
					tie_options(
						array(	"name" => "自定义头像",
								"id" => "gravatar",
								"type" => "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3>苹果图标</h3>
				<?php
					tie_options(
						array(	"name" => "苹果iPhone图标",
								"id" => "apple_iphone",
								"type" => "upload",
								"extra_text" => '苹果iPhone的图标 (57px x 57px)')); 			

					tie_options(
						array(	"name" => "苹果iPhone视网膜图标",
								"id" => "apple_iphone_retina",
								"type" => "upload",
								"extra_text" => '苹果iPhone的视网膜版本的图标 (120px x 120px)')); 			

					tie_options(
						array(	"name" => "苹果iPad图标",
								"id" => "apple_iPad",
								"type" => "upload",
								"extra_text" => '苹果ipad的图标 (72px x 72px)')); 			

					tie_options(
						array(	"name" => "苹果iPad视网膜图标",
								"id" => "apple_iPad_retina",
								"type" => "upload",
								"extra_text" => '苹果ipad的视网膜版本的图标 (144px x 144px)')); 			

				?>
			</div>	
			<div class="tiepanel-item">
				<h3>时间格式</h3>
				<?php
					tie_options(
						array( 	"name" => "博客文章的时间格式",
								"id" => "time_format",
								"type" => "radio",
								"options" => array( "traditional"=>"传统" ,
													"modern"=>"早期时间格式",
													"none"=>"全部禁用 " )));
				?>									
			</div>	
			
			<div class="tiepanel-item">
				<h3>面包屑设置</h3>
				<?php
					tie_options(
						array(	"name" => "面包屑 ",
								"id" => "breadcrumbs",
								"type" => "checkbox")); 
					
					tie_options(
						array(	"name" => "面包屑分隔符",
								"id" => "breadcrumbs_delimiter",
								"type" => "short-text"));
				?>
			</div>
						
			<div class="tiepanel-item">
				<h3>页眉代码</h3>
				<div class="option-item">
					<small>下面的代码将添加到的&lt;head&gt;标签. 如果你需要添加额外的脚本，如CSS或JS。</small>
					<textarea id="header_code" name="tie_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('header_code'));  ?></textarea>				
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>页脚代码</h3>
				<div class="option-item">
					<small>下面的代码添加到页脚之前结束&lt;/body&gt;标签。如果你需要使用Javascript或跟踪代码。</small>

					<textarea id="footer_code" name="tie_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('footer_code'));  ?></textarea>				
				</div>
			</div>	
			
		</div>
		
		<div id="tab9" class="tabs-wrap">
			<h2>页眉设置</h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3>Logo</h3>
				<?php
					tie_options(
						array( 	"name" => "Logo设置",
								"id" => "logo_setting",
								"type" => "radio",
								"options" => array( "logo"=>"自定义 Logo图像" ,
													"title"=>"显示网站标题" )));

					tie_options(
						array(	"name" => "Logo 图像",
								"id" => "logo",
								"help" => "上传一个logo图像，或如果它已经上传，输入图像的URL。如果输入字段留空，主题默认logo将被应用。",
								"type" => "upload",
								"extra_text" => '推荐尺寸 (最大) : 190px x 60px')); 
								
					tie_options(
						array(	"name" => "Logo 图像 (视网膜版本 @2x)",
								"id" => "logo_retina",
								"type" => "upload",
								"extra_text" => '请选择一个图像文件的视网膜版本的logo。应该2倍大小的主要logo。')); 			
					
					tie_options(
						array(	"name" => "视网膜logo的标准logo宽度",
								"id" => "logo_retina_width",
								"type" => "short-text",
								"extra_text" => '如果视网膜logo是上传的,请输入标准的logo(1 x)版本宽度,不要进入视网膜logo宽度。')); 			

					tie_options(
						array(	"name" => "视网膜logo的标准logo高度",
								"id" => "logo_retina_height",
								"type" => "short-text",
								"extra_text" => '如果视网膜logo是上传的,请输入标准的logo(1 x)版本的高度,不进入视网膜logo高度。')); 			
								
					tie_options(
						array(	"name" => "LOGO上边距",
								"id" => "logo_margin",
								"type" => "slider",
								"help" => "输入数字来设置的logo的上部空间",
								"unit" => "px",
								"max" => 100,
								"min" => 0 ));

					tie_options(
						array(	"name" => "全款比例logo",
								"id" => "full_logo",
								"type" => "checkbox",
								"extra_text" => '推荐logo宽度 : 1045px')); 

					tie_options(
						array(	"name" => "居中Logo",
								"id" => "center_logo",
								"type" => "checkbox")); 			
				?>

			</div>
			

			<div class="tiepanel-item">
				<h3>页眉菜单设置</h3>
				<?php
					tie_options(
						array(	"name" => "隐藏顶部菜单",
								"id" => "top_menu",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "隐藏主要导航",
								"id" => "main_nav",
								"type" => "checkbox"));	

					tie_options(
						array(	"name" => "今天日期",
								"id" => "top_date",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "今天日期格式 ",
								"id" => "todaydate_format",
								"type" => "text",
								"extra_text" => '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">日期和时间格式化文档</a>')); 			
					tie_options(
						array(	"name" => "顶部菜单右部区域",
								"id" => "top_right",
								"type" => "radio",
								"options" => array( ""=>"无" ,
													"search"=>"搜索" ,
													"social"=>"社会化图标" ))); 
													
					tie_options(
						array(	"name" => "随机文章按钮",
								"id" => "random_article",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "置顶导航菜单",
								"id" => "stick_nav",
								"type" => "checkbox")); 			
				?>		
			</div>
			

			<div class="tiepanel-item">
				<h3>即时新闻</h3>
				<?php
					tie_options(
						array(	"name" => "启用",
								"id" => "breaking_news",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "只在主页显示",
								"id" => "breaking_home",
								"type" => "checkbox")); 
												
					tie_options(
						array(	"name" => "即时新闻标题",
								"id" => "breaking_title",
								"type" => "text"));
																
					tie_options(
						array(	"name" => "动画效果",
								"id" => "breaking_effect",
								"type" => "select",
								"options" => array(
									'fade' => '淡入淡出',
									'slide' => '滑动',
									'ticker' => '断续',
								)));
								
					tie_options(
						array(	"name" => "动画速度",
								"id" => "breaking_speed",
								"type" => "slider",
								"unit" => "毫秒",
								"max" => 40000,
								"min" => 100 ));

								
					tie_options(
						array(	"name" => "淡出淡入之间时间",
								"id" => "breaking_time",
								"type" => "slider",
								"unit" => "毫秒",
								"max" => 40000,
								"min" => 100 ));
				
				?>
				
				<?php				
					tie_options(
						array(	"name" => "即时新闻查询类型",
								"id" => "breaking_type",
								"options" => array( "category"	=>	"分类" ,
													"tag"		=>	"标签",
													"custom"	=>	"自定义文字"),
								"type" => "radio")); 
															
					
					tie_options(
						array(	"name" => "显示文章数",
								"id" => "breaking_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "实时新闻标签",
								"help" => "输入标签名，或用逗号分隔标签名. ",
								"id" => "breaking_tag",
								"type" => "text"));
								
				?>
					
				
					<div class="option-item" id="breaking_cat-item">
						<span class="label">即时新闻分类</span>
							<select multiple="multiple" name="tie_options[breaking_cat][]" id="tie_breaking_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , tie_get_option('breaking_cat') ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
					</div>
		
			</div>
			
			<div class="tiepanel-item" id="breaking_custom-item">
				<h3>即时新闻自定义文本</h3>
					<div class="option-item" >
					
						<span class="label" style="width:40px">文字</span>
						<input id="custom_text" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_text" value="" />
						<span class="label" style="width:40px; margin-left:10px;">链接</span>
						<input id="custom_link" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_link" value="" />
						<input id="TextAdd"  class="small_button" type="button" value="添加" />
							
						<ul id="customList" style="margin-top:15px;">
						<?php $breaking_custom = tie_get_option( 'breaking_custom' ) ;
							$custom_count = 0 ;
							if($breaking_custom){
								foreach ($breaking_custom as $custom_text) { $custom_count++; ?>
							<li>
								<div class="widget-head">
									<a href="<?php echo $custom_text['link'] ?>" target="_blank"><?php echo $custom_text['text'] ?></a>
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][link]" type="hidden" value="<?php echo $custom_text['link'] ?>" />
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][text]" type="hidden" value="<?php echo $custom_text['text'] ?>" />
									<a class="del-custom-text"></a></div>
							</li>
								<?php }
							}
						?>
						</ul>
						<script>
							var customnext = <?php echo $custom_count+1 ?> ;
						</script>
					</div>	
				</div>
		</div> <!-- Header Settings -->
		
		
		
		<div id="tab2" class="tabs-wrap">
			<h2>首页</h2> <?php echo $save ?>
		
			<div class="tiepanel-item">
				<h3>首页显示</h3>
				<?php
					tie_options(
						array( 	"name" => "首页显示",
								"id" => "on_home",
								"type" => "radio",
								"options" => array( "latest"=>"最新文章 - 博客式布局" ,
													"boxes"=>" 新闻框 - 使用首页生成器（自由布局）" )));
				?>
			</div>	
			
		<div id="Home_Builder" style="width:100%;">

			<div class="tiepanel-item">
				<h3>第一新闻摘录长度</h3>
				<?php
					tie_options(
						array( 	"name" => "第一新闻摘录长度",
								"id" => "home_exc_length",
								"type" => "short-text"));	
					tie_options(
						array(	"name" => "评审得分",
								"id" => "box_meta_score",
								"type" => "checkbox" )); 			
					tie_options(
						array(	"name" => "作者元",
								"id" => "box_meta_author",
								"type" => "checkbox",
								"extra_text" => '此选项不适用滚动框和最新文章的博客风格。')); 			
					tie_options(
						array(	"name" => "日期元",
								"id" => "box_meta_date",
								"type" => "checkbox"));
					tie_options(
						array(	"name" => "分类元",
								"id" => "box_meta_cats",
								"type" => "checkbox",
								"extra_text" => '此选项不适用滚动框和最新文章的博客风格。')); 
					tie_options(
						array(	"name" => "评论元",
								"id" => "box_meta_comments",
								"type" => "checkbox",
								"extra_text" => '此选项不适用滚动框和最新文章的博客风格。')); 
				?>
			</div>	
			
			
			<div class="tiepanel-item"  style=" overflow: visible; ">
				<h3>首页生成器 					<a id="collapse-all">[-] 全部折叠</a>
					<a id="expand-all">[+] 全部展开</a></h3>
				<div class="option-item">

					<select style="display:none" id="cats_defult">
						<?php foreach ($categories as $key => $option) { ?>
						<option value="<?php echo $key ?>"><?php echo $option; ?></option>
						<?php } ?>
					</select>
				
					
					<div style="clear:both"></div>
					<div class="home-builder-buttons">
						<a id="add-cat" >新闻框</a>
						<a id="add-slider" >滚动框</a>
						<a id="add-ads" >广告 / 自定义内容</a>
						<a id="add-news-picture" >图片新闻</a>
						<a id="add-news-videos" >视频</a>
						<a id="add-recent" >最新新闻</a>
						<a id="add-divider" >分隔符</a>
					</div>
										
					<ul id="cat_sortable">
						<?php
							$cats = get_option( 'tie_home_cats' ) ;
							$i=0;
							if($cats){
								foreach ($cats as $cat) { 
									$i++;
									?>
									<li id="listItem_<?php echo $i ?>" class="ui-state-default">
			
								<?php 
									if( $cat['type'] == 'n' ) :	?>
										<div class="widget-head"> 新闻框 : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>框分类 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label><span>文章排序 : </span><select name="tie_home_cats[<?php echo $i ?>][order]" id="tie_home_cats[<?php echo $i ?>][order]"><option value="latest" <?php if( $cat['order'] == 'latest' || $cat['order']=='' ) echo 'selected="selected"'; ?>>最新文章</option><option  <?php if( $cat['order'] == 'rand' ) echo 'selected="selected"'; ?> value="rand">随机文章</option></select></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>显示文章数 :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php  if( !empty($cat['number']) )  echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>平移-文章通过数量</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">框类型 : </span>
												<ul class="tie-cats-options tie-options">
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="li" <?php if( $cat['style'] == 'li' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/li.png" /></a>
													</li>
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="2c" <?php if( $cat['style'] == '2c' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/2c.png" /></a>
													</li>
													<li style="margin-right:0 !important;">
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="1c" <?php if( $cat['style'] == '1c') echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/1c.png" /></a>
													</li>
												</ul>
											</label>
								<?php 
									elseif( $cat['type'] == 'recent' ) :	?>
										<div class="widget-head"> 最新文章 
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span style="float:left;">排除此分类 : </span><select multiple="multiple" name="tie_home_cats[<?php echo $i ?>][exclude][]" id="tie_home_cats[<?php echo $i ?>][exclude][]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['exclude'] ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>框标题 :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>显示文章数 :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>平移-文章通过数量</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][display]"><span>显示模式:</span>
												<select id="tie_home_cats[<?php echo $i ?>][display]" name="tie_home_cats[<?php echo $i ?>][display]">
													<option value="default" <?php if ( $cat['display'] == 'default') { echo ' selected="selected"' ; } ?>>默认风格</option>
													<option value="blog" <?php if ( $cat['display'] == 'blog') { echo ' selected="selected"' ; } ?>>博客风格</option>
												</select>
											</label>
											<label for="tie_home_cats[<?php echo $i ?>][pagi]"><span>显示分页:</span>
												<select id="tie_home_cats[<?php echo $i ?>][pagi]" name="tie_home_cats[<?php echo $i ?>][pagi]">
													<option value="n" <?php if ( $cat['pagi'] == 'n') { echo ' selected="selected"' ; } ?>>No</option>
													<option value="y" <?php if ( $cat['pagi'] == 'y') { echo ' selected="selected"' ; } ?>>Yes</option>
												</select>
											</label>
											<p class="tie_message_hint">WordPress警告：设置取消选项符分页，分页设置选项为“NO”。</p>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
										
									<?php elseif( $cat['type'] == 's' ) : ?>
										<div class="widget-head scrolling-box"> 滚动框 : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>框分类 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>框标题 :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>显示文章数 :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>平移-文章通过数量</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
									<?php elseif( $cat['type'] == 'ads' ) : ?>
										<div class="widget-head ads-box"> 广告 / 自定义内容
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<textarea cols="36" rows="5" name="tie_home_cats[<?php echo $i ?>][text]" id="tie_home_cats[<?php echo $i ?>][text]"><?php  if( !empty($cat['text']) ) echo stripslashes($cat['text']) ; ?></textarea>
												<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
											<small>支持 <strong>文本, HTML 和短代码</strong> .</small>

										
									<?php elseif( $cat['type'] == 'news-pic' ) : ?>
										<div class="widget-head news-pic-box">  图片新闻
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>框分类 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>框标题 :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>平移-文章通过数量</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">框样式 : </span>
												<ul class="tie-cats-options tie-options">
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="default" <?php if( $cat['style'] == 'default' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic1.png" /></a>
													</li>
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="row" <?php if( $cat['style'] == 'row' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic2.png" /></a>
													</li>
												</ul>
											</label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
								<?php elseif( $cat['type'] == 'videos' ) : ?>
										<div class="widget-head news-pic-box">Videos
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>框分类 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>框标题 :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) )  echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>平移-文章通过数量</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) )  echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
									<?php elseif( $cat['type'] == 'divider' ) : ?>
										<div class="widget-head news-pic-box">  分隔符
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label for="tie_home_cats[<?php echo $i ?>][height]"><span>高度 :</span><input id="tie_home_cats[<?php echo $i ?>][height]" name="tie_home_cats[<?php echo $i ?>][height]" value="<?php  echo $cat['height']  ?>" type="text" style="width:50px;" /> px</label>

									<?php endif; ?>
									
									
											<input id="tie_home_cats[<?php echo $i ?>][type]" name="tie_home_cats[<?php echo $i ?>][type]" value="<?php  echo $cat['type']  ?>" type="hidden" />
											<a class="del-cat"></a>
										
										</div>
									</li>
							<?php } 
							} else{?>
							<?php } ?>
					</ul>

					<script>
						var nextCell = <?php echo $i+1 ?> ;
						var templatePath =' <?php echo get_template_directory_uri(); ?>';
					</script>
				</div>	
			</div>
			
			<div class="tiepanel-item">
				<h3>分类选项卡框</h3>
				
				<?php
				tie_options(
					array(	"name" => "显示分类选项卡框",
							"id" => "home_tabs_box",
							"type" => "checkbox")); 
							
					if( tie_get_option('home_tabs') )
						$tie_home_tabs = tie_get_option('home_tabs') ;
					else 
						$tie_home_tabs = array();
					
					$tie_home_tabs_new = array();					
					
					foreach ($tie_home_tabs as $key1 => $option1) {
						if ( array_key_exists( $option1 , $categories) )
							$tie_home_tabs_new[$option1] = $categories[$option1];
					}
					foreach ($categories as $key2 => $option2) {
						if ( !in_array( $key2 , $tie_home_tabs) )
							$tie_home_tabs_new[$key2] = $option2;
					}
				?>
					
				<div class="option-item">
					<span class="label">选择分类 : </span>
					<div class="clear"></div> <p></p>
					<ul id="tabs_cats">
						<?php foreach ($tie_home_tabs_new as $key => $option) { ?>
						<li><input id="tie_home_tabs" name="tie_options[home_tabs][]" type="checkbox" <?php if ( in_array( $key , $tie_home_tabs) ) { echo ' checked="checked"' ; } ?> value="<?php echo $key ?>">
						<span><?php echo $option; ?></span></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		</div> <!-- Homepage Settings -->
		
	
		
		<div id="tab4" class="tabs-wrap">
			<h2>社交网络</h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3>自定义 Feed 地址</h3>
							
				<?php
					tie_options(
						array(	"name" => "隐藏RSS图标",
								"id" => "rss_icon",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "自定义 Feed 地址",
								"id" => "rss_url",
								"help" => "例如： http://feedburner.com/userid",
								"type" => "text"));
				?>
			</div>
			
		<div class="tiepanel-item">
				<h3>社交网络</h3>
				<p class="tie_message_hint"> 别忘记在链接地址前加http://。邮箱链接请在邮箱地址前加mailto:</p>
						
				<?php						
					tie_options(
						array(	"name" => "Facebook 地址",
								"id" => "social",
								"key" => "facebook",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Twitter 地址",
								"id" => "social",
								"key" => "twitter",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Google+ 地址",
								"id" => "social",
								"key" => "google_plus",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "MySpace 地址",
								"id" => "social",
								"key" => "myspace",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "dribbble 地址",
								"id" => "social",
								"key" => "dribbble",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "LinkedIn 地址",
								"id" => "social",
								"key" => "linkedin",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "evernote 地址",
								"id" => "social",
								"key" => "evernote",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Dropbox 地址",
								"id" => "social",
								"key" => "dropbox",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Flickr 地址",
								"id" => "social",
								"key" => "flickr",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Picasa Web 地址",
								"id" => "social",
								"key" => "picasa",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "DeviantArt 地址",
								"id" => "social",
								"key" => "deviantart",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "YouTube 地址",
								"id" => "social",
								"key" => "youtube",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "grooveshark 地址",
								"id" => "social",
								"key" => "grooveshark",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Vimeo 地址",
								"id" => "social",
								"key" => "vimeo",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "ShareThis 地址",
								"id" => "social",
								"key" => "sharethis",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "yahoobuzz 地址",
								"id" => "social",
								"key" => "yahoobuzz",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "500px 地址",
								"id" => "social",
								"key" => "px500",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Skype 地址",
								"id" => "social",
								"key" => "skype",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Digg 地址",
								"id" => "social",
								"key" => "digg",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Reddit 地址",
								"id" => "social",
								"key" => "reddit",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Delicious 地址",
								"id" => "social",
								"key" => "delicious",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "StumbleUpon  地址",
								"key" => "stumbleupon",
								"id" => "social",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "FriendFeed 地址",
								"id" => "social",
								"key" => "friendfeed",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Tumblr 地址",
								"id" => "social",
								"key" => "tumblr",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Blogger 地址",
								"id" => "social",
								"key" => "blogger",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Wordpress 地址",
								"id" => "social",
								"key" => "wordpress",
								"type" => "arrayText"));						
					tie_options(
						array(	"name" => "Yelp 地址",
								"id" => "social",
								"key" => "yelp",
								"type" => "arrayText"));							
					tie_options(
						array(	"name" => "posterous 地址",
								"id" => "social",
								"key" => "posterous",
								"type" => "arrayText"));																														
					tie_options(
						array(	"name" => "Last.fm 地址",
								"id" => "social",
								"key" => "lastfm",
								"type" => "arrayText"));						
					tie_options(
						array(	"name" => "Apple 地址",
								"id" => "social",
								"key" => "apple",
								"type" => "arrayText"));											
					tie_options(
						array(	"name" => "FourSquare 地址",
								"id" => "social",
								"key" => "foursquare",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Github 地址",
								"id" => "social",
								"key" => "github",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "openid 地址",
								"id" => "social",
								"key" => "openid",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "SoundCloud 地址",
								"id" => "social",
								"key" => "soundcloud",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "xing.me 地址",
								"id" => "social",
								"key" => "xing",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Google Play 地址",
								"id" => "social",
								"key" => "google_play",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Pinterest 地址",
								"id" => "social",
								"key" => "Pinterest",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Instagram 地址",
								"id" => "social",
								"key" => "instagram",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Spotify 地址",
								"id" => "social",
								"key" => "spotify",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "PayPal 地址",
								"id" => "social",
								"key" => "paypal",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Forrst 地址",
								"id" => "social",
								"key" => "forrst",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Behance 地址",
								"id" => "social",
								"key" => "behance",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Viadeo 地址",
								"id" => "social",
								"key" => "viadeo",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "VK.com 地址",
								"id" => "social",
								"key" => "vk",
								"type" => "arrayText"));
				?>
			</div>			
		</div><!-- Social Networking -->
		
		
		<div id="tab5" class="tab_content tabs-wrap">
			<h2>幻灯片设置</h2> <?php echo $save; ?>
			<div class="tiepanel-item">
				<h3>幻灯片设置</h3>
				<?php
					tie_options(
						array(	"name" => "启用",
								"id" => "slider",
								"type" => "checkbox")); 
		
					tie_options(
						array(	"name" => "幻灯片样式",
								"id" => "slider_type",
								"options" => array( "flexi"=>"Flexi 滑块" ,
													"elastic"=>"弹性幻灯片 " ),
								"type" => "radio")); 

					tie_options(
						array(	"name" => "显示幻灯片标题",
								"id" => "slider_caption",
								"type" => "checkbox")); 

					tie_options(
						array(	"name" => "幻灯片标题长度",
								"id" => "slider_caption_length",
								"type" => "short-text"));
								
				?>
				<div class="option-item">
					<span class="label">幻灯片位置</span>
					<div style="float:left; width: 338px;">
						<?php
							$checked = 'checked="checked"';
							$tie_slider_pos = tie_get_option('slider_pos');
						?>
						<ul id="sidebar-position-options" class="tie-options">
							<li style="margin:5px 20px 5px 0 ">
								<input id="tie_slider_pos"  name="tie_options[slider_pos]" type="radio" value="small" <?php if($tie_slider_pos == 'small' || !$tie_slider_pos ) echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/small-slider.png" /></a>
							</li>
							<li>
								<input id="tie_slider_pos"  name="tie_options[slider_pos]" type="radio" value="big" <?php if($tie_slider_pos == 'big') echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/big-slider.png" /></a>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
			<div id="elastic" class="tiepanel-item">
			<h3>弹力幻灯片设置</h3>
				<?php
					tie_options(
						array(	"name" => "动画效果",
								"id" => "elastic_slider_effect",
								"type" => "select",
								"options" => array(
									'center' => '中',
									'sides' => '两侧'
								)));

					tie_options(
						array(	"name" => "自动播放",
								"id" => "elastic_slider_autoplay",
								"type" => "checkbox"));
					
					
					tie_options(
						array(	"name" => "幻灯片速度",
								"id" => "elastic_slider_interval",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

					tie_options(
						array(	"name" => "动画速度",
								"id" => "elastic_slider_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>

			<div id="flexi" class="tiepanel-item">
			<h3>Flexi幻灯片设置</h3>
				<?php
					if( is_rtl() ){
						tie_options(
							array(	"name" => "动画效果",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => '淡入淡出',
										'slideV' => '垂直滑动',
									)));
					}else{
						tie_options(
							array(	"name" => "动画效果",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => '淡入淡出',
										'slideV' => '垂直滑动',
										'slideH' => '水平滑动',
									)));
					}
								
					tie_options(
						array(	"name" => "幻灯片速度",
								"id" => "flexi_slider_speed",
								"type" => "slider",
								"unit" => "毫秒",
								"max" => 40000,
								"min" => 100 ));

					tie_options(
						array(	"name" => "动画速度",
								"id" => "flexi_slider_time",
								"type" => "slider",
								"unit" => "毫秒",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>查询设置<</h3>
			<?php
					tie_options(
						array(	"name" => "显示文章数",
								"id" => "slider_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "查询类型",
								"id" => "slider_query",
								"options" => array( "category"=>"分类" ,
													"tag"=>"标签",
													"post"=>"选择文章",
													"page"=>"选择页面" ,
													"custom"=>"自定义幻灯片" ),
								"type" => "radio")); 
								
					tie_options(
						array(	"name" => "标签",
								"help" => "输入标签名称，以逗号分隔名称。 ",
								"id" => "slider_tag",
								"type" => "text"));
			?>
				<?php $slider_cat = tie_get_option('slider_cat') ; ?>
					<div class="option-item" id="slider_cat-item">
						<span class="label">分类</span>
							<select multiple="multiple" name="tie_options[slider_cat][]" id="tie_slider_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $slider_cat ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
						<a class="mo-help tooltip" title="输入一个分类ID或用逗号分隔ID."></a>
					</div>
					
			<?php
																
					tie_options(
						array(	"name" => "选择文章ID",
								"help" => "输入文章ID，用逗号分隔. ",
								"id" => "slider_posts",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "选择页面ID",
								"help" => "输入页面ID，用逗号分隔. ",
								"id" => "slider_pages",
								"type" => "text"));	
								
					tie_options(
						array(	"name" => "自定义幻灯片",
								"help" => "选择自定义幻灯片",
								"id" => "slider_custom",
								"type" => "select",
								"options" => $sliders));
			?>
			
			</div>
		</div> <!-- Slideshow -->
		
				
		<div id="tab6" class="tab_content tabs-wrap">
			<h2>文章设置</h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3>评级系统设置</h3>
				<?php
					tie_options(
						array( 	"name" => '谁被允许评级 ?',
								"id" => "allowtorate",
								"type" => "radio",
								"options" => array( "none"=> '禁用' ,
													"both"=> '注册用户和访客',
													"guests"=>'仅访客',
													"users"=>'仅注册用户') ));
				?>									
			</div>
			
			<div class="tiepanel-item">
				<h3>文章元素</h3>
				<?php
					tie_options(
						array(	"name" => "显示特色图像",
								"desc" => "",
								"id" => "post_featured",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "文章作者框",
								"desc" => "",
								"id" => "post_authorbio",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "下一篇/上一篇文章",
								"desc" => "",
								"id" => "post_nav",
								"type" => "checkbox")); 

					tie_options(
						array(	"name" => "OG 元",
								"desc" => "",
								"id" => "post_og_cards",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">

				<h3>文章元设置</h3>
				<?php
					tie_options(
						array(	"name" => "文章元 :",
								"id" => "post_meta",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "作者元",
								"id" => "post_author",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "日期元",
								"id" => "post_date",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "分类元",
								"id" => "post_cats",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "评论元",
								"id" => "post_comments",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "标签元",
								"id" => "post_tags",
								"type" => "checkbox"));

								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>分享文章设置</h3>
				<?php
					tie_options(
						array(	"name" => "分享文章按钮:",
								"id" => "share_post",
								"type" => "checkbox"));
					tie_options(
						array(	"name" => "百度分享按钮",
								"id" => "share_baidu",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "热门分享按钮 :",
								"id" => "share_post_top",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Tweet 按钮",
								"id" => "share_tweet",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Twitter 用户名 <small>(可选)</small>",
								"id" => "share_twitter_username",
								"type" => "text"));
						
					tie_options(
						array(	"name" => "Facebook Like 按钮",
								"id" => "share_facebook",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Google+ 按钮",
								"id" => "share_google",
								"type" => "checkbox"));
								
																
					tie_options(
						array(	"name" => "Linkedin 按钮",
								"id" => "share_linkdin",
								"type" => "checkbox"));
																					
					tie_options(
						array(	"name" => "StumbleUpon 按钮",
								"id" => "share_stumble",
								"type" => "checkbox"));
								
																			
					tie_options(
						array(	"name" => "Pinterest 按钮",
								"id" => "share_pinterest",
								"type" => "checkbox"));
								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>相关文章设置</h3>
				<?php
					tie_options(
						array(	"name" => "相关文章",
								"id" => "related",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "相关文章框标题",
								"id" => "related_title",
								"type" => "text")); 
								
					tie_options(
						array(	"name" => "显示文章数",
								"id" => "related_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "查询类型",
								"id" => "related_query",
								"options" => array( "category"=>"分类" ,
													"tag"=>"标签",
													"author"=>"作者" ),
								"type" => "radio")); 
				?>
			</div>

			
			<div class="tiepanel-item">

				<h3>jQuery评论设置</h3>
				<?php
					tie_options(
						array(	"name" => "添加评论输入验证",
								"id" => "comment_validation",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- Article Settings -->
		
		
		<div id="tab7" class="tabs-wrap">
			<h2>页脚设置</h2> <?php echo $save ?>

			<div class="tiepanel-item">

				<h3>页脚设置</h3>
				<?php
					tie_options(
						array(	"name" => "'去顶部' 图标",
								"id" => "footer_top",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "社交图标",
								"desc" => "",
								"id" => "footer_social",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>页脚列布局</h3>
					<div class="option-item">

					<?php
						$checked = 'checked="checked"';
						$tie_footer_widgets = tie_get_option('footer_widgets');
					?>
					<ul id="footer-widgets-options" class="tie-options">
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-1c" <?php if($tie_footer_widgets == 'footer-1c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-1c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-2c" <?php if($tie_footer_widgets == 'footer-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="narrow-wide-2c" <?php if($tie_footer_widgets == 'narrow-wide-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-narrow-wide.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-narrow-2c" <?php if($tie_footer_widgets == 'wide-narrow-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-wide-narrow.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-3c" <?php if($tie_footer_widgets == 'footer-3c' || !$tie_footer_widgets ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-left-3c" <?php if($tie_footer_widgets == 'wide-left-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-left.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-right-3c" <?php if($tie_footer_widgets == 'wide-right-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-right.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-4c" <?php if($tie_footer_widgets == 'footer-4c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-4c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="disable" <?php if($tie_footer_widgets == 'disable') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-no.png" /></a>
						</li>

					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>页脚文字一</h3>
				<div class="option-item">
					<textarea id="tie_footer_one" name="tie_options[footer_one]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_one'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">变量</strong>
						这些标签可以包含在上面的文本,并将取代当一个页面被显示。
						<br />
						<strong>%year%</strong> : <em>替换当前的年 .</em><br />
						<strong>%site%</strong> : <em>替换为该网站的名称 .</em><br />
						<strong>%url%</strong>  : <em>替换为该网站的URI .</em>
					</span>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>页脚文字二</h3>
				<div class="option-item">
					<textarea id="tie_footer_two" name="tie_options[footer_two]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_two'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">变量</strong>
						这些标签可以包含在上面的文本,并将取代当一个页面被显示。
						<br />
						<strong>%year%</strong> : <em>替换当前的年 .</em><br />
						<strong>%site%</strong> : <em>替换为该网站的名称 .</em><br />
						<strong>%url%</strong>  : <em>替换为该网站的URI .</em>
					</span>
				</div>
			</div>

		</div><!-- Footer Settings -->

		
		<div id="tab8" class="tab_content tabs-wrap">
			<h2>横幅设置</h2> <?php echo $save ?>
			<div class="tiepanel-item">
				<h3>背景图片广告</h3>
				<?php
					tie_options(				
						array(	"name" => "启用背景图片广告",
								"id" => "banner_bg",
								"type" => "checkbox")); 	
							
					tie_options(					
						array(	"name" => "背景图片广告链接",
								"id" => "banner_bg_url",
								"type" => "text"));
				?>
				<p class="tie_message_hint">
					转到“样式”选项卡，设置“背景类型”设置为“自定义背景”，然后上传您的自定义图像，并启用 <strong>"全屏幕背景"</strong> 选项 ... <a href="http://themes.tielabs.com/docs/sahifa/#!/setting_up_a_background" target="_blank">点击这里</a> 了解更多 .
				</p>
			</div>
			<div class="tiepanel-item">
				<h3>顶部横幅区域</h3>
				<?php
					tie_options(				
						array(	"name" => "顶部横幅",
								"id" => "banner_top",
								"type" => "checkbox"));
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "顶部横幅图像",
								"id" => "banner_top_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "顶部横幅链接",
								"id" => "banner_top_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图片替代文字",
								"id" => "banner_top_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新选项卡打开",
								"id" => "banner_top_tab",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_top_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应谷歌AdSense</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_top_publisher",
								"type" => "text"));

					tie_options(					
						array(	"name" => "728x90 (通栏广告) -广告标识",
								"id" => "banner_top_728",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "468x60 (横幅) - 广告标识",
								"id" => "banner_top_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (中等矩形) - 广告标识",
								"id" => "banner_top_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "自定义广告代码",
								"id" => "banner_top_adsense",
								"extra_text" => '支持 <strong>文本, HTML 和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="tiepanel-item">
				<h3>底部横幅区域</h3>
				<?php
					tie_options(				
						array(	"name" => "底部横幅",
								"id" => "banner_bottom",
								"type" => "checkbox")); 
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "底部横幅图片",
								"id" => "banner_bottom_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "底部横幅链接",
								"id" => "banner_bottom_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图像替代文字",
								"id" => "banner_bottom_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新选项卡打开",
								"id" => "banner_bottom_tab",
								"type" => "checkbox"));
						
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_bottom_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应谷歌AdSense</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_bottom_publisher",
								"type" => "text"));

					tie_options(					
						array(	"name" => "728x90 (通栏广告) - 广告标识",
								"id" => "banner_bottom_728",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "468x60 (横幅) - 广告标识",
								"id" => "banner_bottom_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (中等矩形) - 广告标识",
								"id" => "banner_bottom_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "自定义广告代码",
								"id" => "banner_bottom_adsense",
								"extra_text" => '支持 <strong>文本, HTML 和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
	
			<div class="tiepanel-item">
				<h3>文章的上面横幅区域</h3>
				<?php
					tie_options(				
						array(	"name" => "文章上面横幅",
								"id" => "banner_above",
								"type" => "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "文章上面横幅图片",
								"id" => "banner_above_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "文章上面横幅链接",
								"id" => "banner_above_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图像替代文字",
								"id" => "banner_above_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新选项卡打开",
								"id" => "banner_above_tab",
								"type" => "checkbox"));
					
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_above_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应谷歌AdSense</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_above_publisher",
								"type" => "text"));
	
					tie_options(					
						array(	"name" => "468x60 (横幅) - 广告标识",
								"id" => "banner_above_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (中等矩形) - 广告标识",
								"id" => "banner_above_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "自定义广告代码",
								"id" => "banner_above_adsense",
								"extra_text" => '支持 <strong>文本, HTML 和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
			
			<div class="tiepanel-item">
				<h3>文章下面横幅位置</h3>
				<?php
					tie_options(				
						array(	"name" => "文章下面横幅",
								"id" => "banner_below",
								"type" => "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "文章下面横幅图片",
								"id" => "banner_below_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "文章下面横幅链接",
								"id" => "banner_below_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图像替代文字",
								"id" => "banner_below_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新选项卡打开",
								"id" => "banner_below_tab",
								"type" => "checkbox"));
							
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_below_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应谷歌AdSense</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_below_publisher",
								"type" => "text"));
	
					tie_options(					
						array(	"name" => "468x60 (横幅) - 广告标识",
								"id" => "banner_below_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (中等矩形) - 广告标识",
								"id" => "banner_below_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "自定义广告代码",
								"id" => "banner_below_adsense",
								"extra_text" => '支持 <strong>文本, HTML 和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="tiepanel-item">
				<h3>短代码广告</h3>
				<?php
					tie_options(				
						array(	"name" => "[广告1]短代码横幅",
								"id" => "ads1_shortcode",
								"type" => "textarea")); 
	
					tie_options(
						array(	"name" => "[广告2] 短代码横幅",
								"id" => "ads2_shortcode",
								"type" => "textarea")); 
				?>
			</div>
		</div> <!-- Banners Settings -->
		
			

		<div id="tab11" class="tab_content tabs-wrap">
			<h2>侧边栏</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>侧边栏位置</h3>
				<div class="option-item">
					<?php
						$checked = 'checked="checked"';
						$tie_sidebar_pos = tie_get_option('sidebar_pos');
					?>
					<ul id="sidebar-position-options" class="tie-options">
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="right" <?php if($tie_sidebar_pos == 'right' || !$tie_sidebar_pos ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-right.png" /></a>
						</li>
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="left" <?php if($tie_sidebar_pos == 'left') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-left.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>添加侧边栏</h3>
				<div class="option-item">
					<span class="label">侧边栏名字</span>
					
					<input id="sidebarName" type="text" size="56" style="direction:ltr; text-laign:left" name="sidebarName" value="" />
					<input id="sidebarAdd"  class="small_button" type="button" value="Add" />
					
					<ul id="sidebarsList">
					<?php $sidebars = tie_get_option( 'sidebars' ) ;
						if($sidebars){
							foreach ($sidebars as $sidebar) { ?>
						<li>
							<div class="widget-head"><?php echo $sidebar ?>  <input id="tie_sidebars" name="tie_options[sidebars][]" type="hidden" value="<?php echo $sidebar ?>" /><a class="del-sidebar"></a></div>
						</li>
							<?php }
						}
					?>
					</ul>
				</div>				
			</div>

			<div class="tiepanel-item" id="custom-sidebars">
				<h3>自定义侧边栏</h3>
				<?php
				
				$new_sidebars = array(''=> '默认');
				if (class_exists('Woocommerce'))
					$new_sidebars ['shop-widget-area'] = __( '商城-  WooCommerce 页面', 'tie' ) ;

				if($sidebars){
					foreach ($sidebars as $sidebar) {
						$new_sidebars[$sidebar] = $sidebar;
					}
				}
				
				
				tie_options(				
					array(	"name" => "首页侧边栏",
							"id" => "sidebar_home",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "页面侧边栏",
							"id" => "sidebar_page",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "文章页侧边栏",
							"id" => "sidebar_post",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "归档页侧边栏r",
							"id" => "sidebar_archive",
							"type" => "select",
							"options" => $new_sidebars ));

				if(class_exists( 'bbPress' ))
				tie_options(				
					array(	"name" => "bbPress 侧边栏",
							"id" => "sidebar_bbpress",
							"type" => "select",
							"options" => $new_sidebars )); 

				?>
				<p class="tie_message_hint">
				你从类别分类编辑页面，您可以设置自定义侧边栏..到 <strong><a target="Blank" href="edit-tags.php?taxonomy=category">分类页面</a></strong> - 编辑你想要的类别，然后选择您的自定义侧边栏 <strong><?php echo theme_name;?> - 分类设置</strong> box  .
				</p>
			</div>
		</div> <!-- Sidebars -->
		
		
		<div id="tab12" class="tab_content tabs-wrap">
			<h2>归档设置</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>常规设置</h3>
				<p class="tie_message_hint">以下的设置将应用在主页博客布局和所有页面与博客列表模板。</p>
				<?php
					tie_options(
						array(	"name" => "显示",
								"id" => "blog_display",
								"help" => "将出现在所有归档页面，如：分类、搜索、标签和首页博客风格.",
								"type" => "radio",
								"options" => array( "excerpt"=>"摘录 + 特色图像" ,
													"full_thumb"=>"摘录 + 全宽特色图像" ,
													"content"=>"内容" )));
								
					tie_options(
						array(	"name" => "显示社交按钮",
								"id" => "archives_socail",
								"type" => "checkbox",
								"help" => "如果启用 Facebook , Twitter , Google plus 和 Pinterest 社交按钮将出现在所有归档页，像分类、标签、搜索和首页博客风格." ));
					
					tie_options(
						array( 	"name" => "摘录长度",
								"id" => "exc_length",
								"type" => "short-text"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>归档文章元</h3>
				<p class="tie_message_hint">以下设置将适用于在网页上博客布局和博客列表模板的所有网页的。</p>
				<?php
					tie_options(
						array(	"name" => "评分",
								"id" => "arc_meta_score",
								"type" => "checkbox" )); 			
					tie_options(
						array(	"name" => "作者元",
								"id" => "arc_meta_author",
								"type" => "checkbox")); 			
					tie_options(
						array(	"name" => "日期元",
								"id" => "arc_meta_date",
								"type" => "checkbox"));
					tie_options(
						array(	"name" => "分类元",
								"id" => "arc_meta_cats",
								"type" => "checkbox")); 
					tie_options(
						array(	"name" => "评论元",
								"id" => "arc_meta_comments",
								"type" => "checkbox")); 
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3>分类页面设置</h3>
				<?php
					tie_options(
						array(	"name" => "分类描述",
								"id" => "category_desc",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "RSS 图标",
								"id" => "category_rss",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>标签页设置</h3>
				<?php
					tie_options(
						array(	"name" => "RSS图标",
								"id" => "tag_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>作者页设置</h3>
				<?php
					tie_options(
						array(	"name" => "作者个人资料",
								"id" => "author_bio",
								"type" => "checkbox"));
				?>
				<?php
					tie_options(
						array(	"name" => "RSS 图标",
								"id" => "author_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>搜索页设置</h3>
				<?php
					tie_options(
						array(	"name" => "在分类ID中搜索",
								"id" => "search_cats",
								"help" => "使用减号（ - ）来排除类别。例：（1,4，-7）=仅在分类1和4中搜索，排除7.",
								"type" => "text"));
				?>
				<?php
					tie_options(
						array(	"name" => "在结果排队页面",
								"id" => "search_exclude_pages",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- Archives -->
				
				
		<div id="tab13" class="tab_content tabs-wrap">
			<h2>风格</h2>	<?php echo $save ?>	
			<div class="tiepanel-item">
				<h3>主题颜色和设置</h3>

				<div class="option-item">
					<span class="label">选择主题颜色</span>
			
					<?php
						$checked = 'checked="checked"';
						$theme_color = tie_get_option('theme_skin');
					?>
					<ul style="clear:both" id="theme-skins" class="tie-options">
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="0" <?php if(!$theme_color) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-none.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ef3636" <?php if($theme_color == '#ef3636' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-red.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#37b8eb" <?php if($theme_color == '#37b8eb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-blue.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#81bd00" <?php if($theme_color == '#81bd00') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-green.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#e95ca2" <?php if($theme_color == '#e95ca2') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-pink.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#000" <?php if($theme_color == '#000') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-black.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ffbb01" <?php if($theme_color == '#ffbb01' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-yellow.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#7b77ff" <?php if($theme_color == '#7b77ff') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-purple.png" /></a>
						</li>
					</ul>
				</div>

				<?php
					tie_options(
						array(	"name" => "自定义主题颜色",
								"id" => "global_color",
								"type" => "color"));

					tie_options(				
						array(	"name" => "深色皮肤",
								"id" => "dark_skin",
								"type" => "checkbox")); 
								
					tie_options(				
						array(	"name" => "现代彩色滚动条",
								"id" => "modern_scrollbar",
								"type" => "checkbox",
								"extra_text" => '对此仅适用于Chrome和Safari .'));
				?>
			</div>	
			<div class="tiepanel-item">

				<h3>背景类型</h3>
				<?php
					tie_options(
						array( 	"name" => "背景类型",
								"id" => "background_type",
								"type" => "radio",
								"options" => array( "pattern"=>"图案" ,
													"custom"=>"自定义背景" )));
				?>
			</div>

			<div class="tiepanel-item" id="pattern-settings">
				<h3>选择图案</h3>
				
				<?php
					tie_options(
						array( 	"name" => "背景颜色",
								"id" => "background_pattern_color",
								"type" => "color" ));
				?>
				
				<?php
					$checked = 'checked="checked"';
					$theme_pattern = tie_get_option('background_pattern');
				?>
				<ul id="theme-pattern" class="tie-options">
					<?php for($i=1 ; $i<=36 ; $i++ ){ 
					 $pattern = 'body-bg'.$i; ?>
					<li>
						<input id="tie_background_pattern"  name="tie_options[background_pattern]" type="radio" value="<?php echo $pattern ?>" <?php if($theme_pattern == $pattern ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/pattern<?php echo $i ?>.png" /></a>
					</li>
					<?php } ?>
				</ul>
			</div>

			<div class="tiepanel-item" id="bg_image_settings">
				<h3>自定义背景</h3>
				<?php
					tie_options(
						array(	"name" => "自定义背景",
								"id" => "background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "全屏背景",
								"id" => "background_full",
								"type" => "checkbox"));
				?>

			</div>	
			<div class="tiepanel-item">
				<h3>主体风格</h3>
				<?php
				
					tie_options(
						array(	"name" => "高亮文本颜色",
								"id" => "highlighted_color",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "链接颜色",
								"id" => "links_color",
								"type" => "color"));
					tie_options(
						array(	"name" => "链接装饰",
								"id" => "links_decoration",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"无",
													"underline"=>"下划线",
													"overline"=>"上划线",
													"line-through"=>"删除线" )));

					tie_options(
						array(	"name" => "鼠标悬停颜色",
								"id" => "links_color_hover",
								"type" => "color"));
	
					tie_options(
						array(	"name" => "鼠标悬停时链接装饰",
								"id" => "links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"无",
													"underline"=>"下划线",
													"overline"=>"上划线",
													"line-through"=>"删除线" )));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>顶部导航风格</h3>
				<?php
					tie_options(
						array(	"name" => "背景",
								"id" => "topbar_background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "链接颜色",
								"id" => "topbar_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "鼠标悬停链接颜色",
								"id" => "topbar_links_color_hover",
								"type" => "color"));
				?>

				<?php
					tie_options(
						array(	"name" => "页眉今日日期背景",
								"id" => "todaydate_background",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "页眉今日日期文字颜色",
								"id" => "todaydate_color",
								"type" => "color"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>页眉背景</h3>
				<?php
					tie_options(
						array(	"name" => "背景",
								"id" => "header_background",
								"type" => "background"));
				?>
			</div>
			
						
			<div class="tiepanel-item">
				<h3>主要导航样式</h3>
				<p class="tie_message_hint">要修改主导航背景，你需要通过照片编辑软件编辑 <strong>images/main-menu-bg</strong> 图像/主菜单背景的，改变它的颜色。</p>
				<?php
					tie_options(
						array(	"name" => "子菜单背景",
								"id" => "sub_nav_background",
								"type" => "color"));

					tie_options(
						array(	"name" => "链接颜色",
								"id" => "nav_links_color",
								"type" => "color"));
										
					tie_options(
						array(	"name" => "链接文本阴影颜色",
								"id" => "nav_shadow_color",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "连接鼠标悬停颜色",
								"id" => "nav_links_color_hover",
								"type" => "color"));

					tie_options(
						array(	"name" => "鼠标移到链接文字阴影颜色",
								"id" => "nav_shadow_color_hover",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "当前选项链接颜色",
								"id" => "nav_current_links_color",
								"type" => "color"));
										
					tie_options(
						array(	"name" => "当前的选项链接文本阴影颜色",
								"id" => "nav_current_shadow_color",
								"type" => "color"));

					tie_options(
						array(	"name" => "分隔线1颜色",
								"id" => "nav_sep1",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "分隔线2颜色",
								"id" => "nav_sep2",
								"type" => "color"));
				?>
			</div>
			
			
			<div class="tiepanel-item">
				<h3>即时新闻风格</h3>
				<?php
					tie_options(
						array(	"name" => "即时新闻文字背景",
								"id" => "breaking_title_bg",
								"type" => "color"));
				?>		
			</div>

			<div class="tiepanel-item">
				<h3>主要内容框风格</h3>
				<?php
					tie_options(
						array(	"name" => "主要内容框背景 ",
								"id" => "main_content_bg",
								"type" => "background"));

					tie_options(
						array(	"name" => "框 / 小工具背景 ",
								"id" => "boxes_bg",
								"type" => "background"));

				?>		
			</div>
			<div class="tiepanel-item">
				<h3>文章风格</h3>
				<?php
					tie_options(
						array(	"name" => "文章链接颜色",
								"id" => "post_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "文章链接装饰",
								"id" => "post_links_decoration",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"无",
													"underline"=>"下划线",
													"overline"=>"上划线",
													"line-through"=>"删除线" )));
				?>
				<?php
					tie_options(
						array(	"name" => "鼠标悬停文章链接颜色",
								"id" => "post_links_color_hover",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "鼠标悬停文章链接装饰",
								"id" => "post_links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"无",
													"underline"=>"下划线",
													"overline"=>"上划线",
													"line-through"=>"删除线" )));
				?>
			</div>
			<div class="tiepanel-item">
				<h3>页脚背景</h3>
				<?php
					tie_options(
						array(	"name" => "背景",
								"id" => "footer_background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "页脚小工具标题颜色",
								"id" => "footer_title_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "链接颜色",
								"id" => "footer_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "鼠标悬停链接颜色",
								"id" => "footer_links_color_hover",
								"type" => "color"));
				?>
			</div>				
						
			<div class="tiepanel-item">
				<h3>自定义CSS</h3>	
				<div class="option-item">
					<p><strong>全局CSS :</strong></p>
					<textarea id="tie_css" name="tie_options[css]" style="width:100%" rows="7"><?php echo tie_get_option('css');  ?></textarea>
				</div>	
				<div class="option-item">
					<p><strong>平板CSS :</strong> 宽度从 768px 到 985px</p>
					<textarea id="tie_css" name="tie_options[css_tablets]" style="width:100%" rows="7"><?php echo tie_get_option('css_tablets');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>宽手机CSS :</strong> 宽度从 480px 到 767px</p>
					<textarea id="tie_css" name="tie_options[css_wide_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_wide_phones');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>手机 CSS :</strong> 宽度从 320px 到 479px</p>
					<textarea id="tie_css" name="tie_options[css_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_phones');  ?></textarea>
				</div>	
			</div>	

		</div> <!-- Styling -->

	
		
		<div id="tab14" class="tab_content tabs-wrap">
			<h2>排版</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>字符集</h3>
				<p class="tie_message_hint"><strong>提示:</strong> 如果你只选择你需要的语言，你会帮助防止您的网页上的缓慢。</p>
				<?php
					tie_options(
						array(	"name" => "拉丁语扩展",
								"id" => "typography_latin_extended",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "西里尔",
								"id" => "typography_cyrillic",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "西里尔扩展",
								"id" => "typography_cyrillic_extended",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "希腊",
								"id" => "typography_greek",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "希腊语扩展",
								"id" => "typography_greek_extended",
								"type" => "checkbox"));	
								
					tie_options(
						array(	"name" => "高棉语",
								"id" => "typography_khmer",
								"type" => "checkbox"));		
								
					tie_options(
						array(	"name" => "越南语",
								"id" => "typography_vietnamese",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>实时预览排版</h3>
					<?php 	global $options_fonts;
					tie_options(
						array( 	"name" => "",
								"id" => "typography_test",
								"type" => "typography"));
						?>
	
				<div id="font-preview" class="option-item">逍遥乐用心汉化，逍遥乐IT博客www.luoxiao123.cn</div>		

			</div>
			<div class="tiepanel-item">
				<h3>主要版式</h3>
				<?php
					tie_options(
						array( 	"name" => "常规排版",
								"id" => "typography_general",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "页眉的网站标题",
								"id" => "typography_site_title",
								"type" => "typography"));	

					tie_options(
						array( 	"name" => "页眉的标语",
								"id" => "typography_tagline",
								"type" => "typography"));	
								
					tie_options(
						array( 	"name" => "顶部菜单",
								"id" => "typography_top_menu",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "主导航",
								"id" => "typography_main_nav",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "幻灯片文章标题",
								"id" => "typography_slider_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "页面标题",
								"id" => "typography_page_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "单文章标题",
								"id" => "typography_post_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "在首页装饰盒的文章标题",
								"id" => "typography_post_title_boxes",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "在首页装饰盒的文章小标题",
								"id" => "typography_post_title2_boxes",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "文章元",
								"id" => "typography_post_meta",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "文章输入",
								"id" => "typography_post_entry",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "新闻框标题",
								"id" => "typography_boxes_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "小工具标题",
								"id" => "typography_widgets_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "页脚小工具标题",
								"id" => "typography_footer_widgets_title",
								"type" => "typography"));
				?>
			</div>			
		</div> <!-- Typography -->
		
		
		<div id="tab10" class="tab_content tabs-wrap">
			<h2>高级设置</h2>	<?php echo $save ?>	

			<div class="tiepanel-item">
				<h3>禁用自适应</h3>
				<?php
					tie_options(
						array(	"name" => "禁用自适应",
								"id" => "disable_responsive",
								"type" => "checkbox"));
				?>
				<p class="tie_message_hint">此选项仅适用于平板电脑和手机..禁用桌面上的响应行动..编辑style.css文件，并删除从文件末尾所有媒体查询的.</p>
			</div>	
			
			<div class="tiepanel-item">
				<h3>禁用主题[相册]短代码</h3>
				<?php
					tie_options(
						array(	"name" => "禁用主题[相册]",
								"id" => "disable_gallery_shortcode",
								"type" => "checkbox"));
				?>
				<p class="tie_message_hint">将其设置为 <strong>ON</strong> ，如果你想使用Jetpack瓷砖画廊，或者如果你使用自定义的收藏夹插件[相册]短代码。</p>
			</div>	
			
			<div class="tiepanel-item">
				<h3>Twitter API OAuth 设置</h3>
				<p class="tie_message_hint">此信息将使用Sicail counter 和 Twitter小工具 .. 你需要
创建 <a href="https://dev.twitter.com/apps" target="_blank">Twitter APP</a>获取此信息 .
. 点击 <a href="https://vimeo.com/59573397" target="_blank">视频</a> .</p>

				<?php
					tie_options(
						array(	"name" => "Twitter Username",
								"id" => "twitter_username",
								"type" => "text"));

					tie_options(
						array(	"name" => "Consumer key",
								"id" => "twitter_consumer_key",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Consumer secret",
								"id" => "twitter_consumer_secret",
								"type" => "text"));	
								
					tie_options(
						array(	"name" => "Access token",
								"id" => "twitter_access_token",
								"type" => "text"));	
								
					tie_options(
						array(	"name" => "Access token secret",
								"id" => "twitter_access_token_secret",
								"type" => "text"));
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3>图片调整</h3>
				
				<?php
					tie_options(
						array(	"name" => "TimThumb缩略图 <small style='font-weight:bold;'>(不推荐)</small>",
								"id" => "timthumb",
								"type" => "checkbox"));
				?>
			</div>	
				
			<div class="tiepanel-item">
				<h3>主题更新</h3>
				<?php
					tie_options(
						array(	"name" => "主题更新通知",
								"id" => "notify_theme",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Worpress登录页Logo</h3>
				<?php
					tie_options(
						array(	"name" => "Worpress登录页Logo",
								"id" => "dashboard_logo",
								"type" => "upload"));

					tie_options(
						array(	"name" => "Worpress登录页Logo链接",
								"id" => "dashboard_logo_url",
								"type" => "text"));
				?>
			
			</div>
			<?php
				global $array_options ;
				
				$current_options = array();
				foreach( $array_options as $option ){
					if( get_option( $option ) )
						$current_options[$option] =  get_option( $option ) ;
				}
			?>
			
			<div class="tiepanel-item">
				<h3>导出</h3>
				<div class="option-item">
					<textarea style="width:100%" rows="7"><?php echo $currentsettings = base64_encode( serialize( $current_options )); ?></textarea>
				</div>
			</div>
			<div class="tiepanel-item">
				<h3>导入</h3>
				<div class="option-item">
					<textarea id="tie_import" name="tie_import" style="width:100%" rows="7"></textarea>
				</div>
			</div>


		</div> <!-- Advanced -->
		
		
		<div class="mo-footer">
			<?php echo $save; ?>
		</form>

			<form method="post">
				<div class="mpanel-reset">
					<input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>" />
					<input name="reset" class="mpanel-reset-button" type="submit" onClick="if(confirm('所有设置将重置 .. 你确定 ?')) return true ; else return false; " value="重置所有设置" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div>

	</div><!-- .mo-panel-content -->
	<div class="clear"></div>
</div><!-- .mo-panel -->
<?php 
}
?>
