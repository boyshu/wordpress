<?php
function tie_set_demo_data(){
	$theme_options = get_option( 'tie_options' );
		
	$cat1 = $cat2 = $cat3 = $cat4 = $cat5 =1;
	$cat1 = get_cat_ID( 'Business' );
	$cat2 =  get_cat_ID( 'Sports' );
	$cat3 =  get_cat_ID( 'Technology' );
	$cat4 =  get_cat_ID( 'Videos' );
	$cat5 =  get_cat_ID( 'World' );
	
	$home_cats = array(
		array(
            'title' => 'Recent Posts',
            'number' => 3,
            'display' => 'default',
            'pagi' => 'n',
            'boxid' => 'recent_1777',
            'type' => 'recent'
		),
		array(
            'id' => $cat4,
            'order' => 'latest',
            'number' => 5,
            'style' => '2c',
            'type' => 'n'
        ),
		array(
            'id' => $cat3,
            'order' => 'latest',
            'number' => 5,
            'style' => '2c',
            'type' => 'n'
        ),
		array(
            'id' => $cat5,
            'title' => 'Scrolling Box',
            'number' => 8,
            'boxid' => 's_11140',
            'type' => 's'
        ),
		array(
            'text' => '<a href="#" title="">
				<img src="http://themes.tielabs.com/data/banners/tf_468x60_v1.gif" alt="">
			</a>',
            'type' => 'ads'
        ),
		array(
            'id' => $cat1,
            'title' => 'News In Picture',
            'boxid' => 'news-pic_1775',
            'type' => 'news-pic',
            'style' => 'default'
        ),
		array(
            'id' => $cat2,
            'order' => 'latest',
            'number' => 5,
            'style' => '1c',
            'type' => 'n'
        ),
		array(
            'id' => $cat5,
            'order' => 'latest',
            'number' => 5,
            'style' => 'li',
            'type' => 'n'
        ),
		array(
            'id' => $cat1,
            'title' => 'Grid',
            'boxid' => 'news-pic_11099',
            'type' => 'news-pic',
            'style' => 'row'
        )
	);

	$theme_options['social']['facebook'] = 'https://www.facebook.com/TieLabs';
	$theme_options['social']['twitter'] = 'https://twitter.com/mo3aser';
	$theme_options['social']['dribbble'] = 'http://dribbble.com/mo3aser';
	$theme_options['social']['foursquare'] = 'https://foursquare.com/mo3aser';
	$theme_options['social']['Pinterest'] = 'http://www.pinterest.com/mo3aser/';
	$theme_options['social']['instagram'] = 'http://instagram.com/imo3aser';
	
	$theme_options['on_home'] = 'boxes';
	$theme_options['footer_widgets'] = 'footer-4c';
	$theme_options['slider_type'] = 'flexi';
	$theme_options['slider_cat'] = array($cat1, $cat2, $cat3, $cat4, $cat5 );
	$theme_options['banner_top'] = $theme_options['banner_bottom'] = true;
	$theme_options['banner_top_img'] = $theme_options['banner_bottom_img'] = 'http://themes.tielabs.com/data/banners/sahifa-728.jpg';
	$theme_options['banner_top_url'] = $theme_options['banner_bottom_url'] = 'http://themeforest.net/item/sahifa-responsive-wordpress-newsmagazineblog/2819356?ref=mo3aser';
	
	update_option( 'tie_home_cats' , $home_cats );
	update_option( 'tie_options' , $theme_options );

	//Import Menus
	$top_menu = get_term_by('name', 'top', 'nav_menu');
	$main_menu = get_term_by('name', 'main', 'nav_menu');
	set_theme_mod( 'nav_menu_locations' , array('top-menu' => $top_menu->term_id , 'primary' => $main_menu->term_id ) );
	
	
	//Import Widgets
	update_option('sidebars_widgets', '');
	
	tie_addWidgetToSidebar( 'primary-widget-area' , 'counter-widget', 0, array('facebook' => 'https://www.facebook.com/TieLabs','youtube' => 'http://www.youtube.com/user/TEAMMESAI','vimeo' => 'http://vimeo.com/channels/kidproof'));
	tie_addWidgetToSidebar( 'primary-widget-area', 'widget_tabs', 0);
	tie_addWidgetToSidebar( 'primary-widget-area' , 'facebook-widget', 0, array('title' => 'Find us on Facebook', 'page_url' => 'https://www.facebook.com/TieLabs'));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'social', 0, array('title' => 'Social', 'tran_bg' => true, 'icons_size' => 32 ));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'youtube-widget', 0, array('title' => 'Subscribe to our Channel', 'page_url' => 'TEAMMESAI'));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'video-widget', 0, array('title' => ' Featured Video', 'youtube_video' => 'UjXi6X-moxE'));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'login-widget', 0, array('title' => ' Login'));
	
	tie_addWidgetToSidebar( 'first-footer-widget-area' , 'posts-list-widget', 0, array('title' => 'Popular Posts', 'no_of_posts' => 5, 'thumb' => true , 'posts_order' => 'popular'));
	tie_addWidgetToSidebar( 'second-footer-widget-area' , 'posts-list-widget', 0, array('title' => 'Random Posts', 'no_of_posts' => 5, 'thumb' => true , 'posts_order' => 'random'));
	tie_addWidgetToSidebar( 'third-footer-widget-area' , 'posts-list-widget', 0, array('title' => 'Latest Posts', 'no_of_posts' => 5, 'thumb' => true ,  'posts_order' => 'latest'));
	tie_addWidgetToSidebar( 'fourth-footer-widget-area' , 'comments_avatar-widget', 0, array('title' => 'Recent Comments', 'thumb' => true , 'no_of_comments' => 5, 'avatar_size' => 50));

}

function tie_addWidgetToSidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array()){
	$sidebarOptions = get_option('sidebars_widgets');
	if(!isset($sidebarOptions[$sidebarSlug])){
	$sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
	}
	$newWidget = get_option('widget_'.$widgetSlug);
	if(!is_array($newWidget))$newWidget = array();
	$count = count($newWidget)+1+$countMod;
	$sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

	$newWidget[$count] = $widgetSettings;

	update_option('sidebars_widgets', $sidebarOptions);
	update_option('widget_'.$widgetSlug, $newWidget);
}

function tie_demo_installer() { ?>  
	<div id="icon-tools" class="icon32"><br></div>
	<h2>导入演示数据</h2>
	<div style="background-color: #F5FAFD; margin:10px 0;padding: 10px;color: #0C518F;border: 3px solid #CAE0F3; claer:both; width:90%; line-height:18px;">
		<p class="tie_message_hint">导入演示数据（文章，页面，图片，主题设置，...）是最简单的方法来设置你的主题。它将
让您快速编辑，而不是一切从头开始创建内容。当您导入数据后的事情会发生：</p>
	  
	  <ul style="padding-left: 20px;list-style-position: inside;list-style-type: square;}">
		  <li>没有已存在的文章，页面，分类，图像，自定义文章类型或任何其他数据将被删除或修改。</li>
		  <li>没有WordPress的设置将被修改。</li>
		  <li>包括十篇文章,几页,10张图片,一些小工具和两个菜单将会被导入。</li>
		  <li>从我们的服务器，可下载图像，这些图像版权保护，并只用于演示使用。</li>
		  <li>只需单击一次单击“导入”，并等待，它可能需要一两分钟。逍遥乐提示：受限于网络和主机因素，这个时间不确定。</li>
	  </ul>
	 </div>
	<form method="post">
		<input type="hidden" name="demononce" value="<?php echo wp_create_nonce('tie-demo-code'); ?>" />
		<input name="reset" class="mpanel-save" type="submit" value="导入演示数据" />
		<input type="hidden" name="action" value="demo-data" />
	</form>
	<br />
	<br />	
<?php
	if(  'demo-data' == $_REQUEST['action'] && check_admin_referer('tie-demo-code' , 'demononce')){
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			require_once ABSPATH . 'wp-admin/includes/import.php';
			$importer_error = false;
			if ( !class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) ){
					require_once($class_wp_importer);
				}
				else{
					$importer_error = true;
				}
			}
			
		if ( !class_exists( 'WP_Import' ) ) {
			$class_wp_import = get_template_directory() . '/panel/importer/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) )
				require_once($class_wp_import);
			else
				$importerError = true;
		}
		if($importer_error){
			die("导入错误 :(");
		}else{
			if(!is_file( get_template_directory() . '/panel/importer/sample.xml')){
				echo "XML文件包含虚拟内容不可用或者无法读取. . 你可能需要设置文件权限和chmod755。<br/>如果这不起作用，使用WordPress的导入和手动导入XML文件（应该在下载 .zip：示例内容文件夹）。 ";
			}
			else{
				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = true;
				$wp_import->import( get_template_directory() . '/panel/importer/sample.xml');
		  }
	  }
		tie_set_demo_data();
	}
}
?>