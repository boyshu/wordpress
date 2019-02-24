<?php

$themename = "Sahifa";
$themefolder = "sahifa";

define ('theme_name', $themename );
define ('theme_ver' , 4 );

// Notifier Info
$notifier_name = $themename;
$notifier_url = "http://themes.tielabs.com/xml/".$themefolder.".xml";

//Docs Url
$docs_url = "http://themes.tielabs.com/docs/".$themefolder;

// Constants for the theme name, folder and remote XML url
define( 'MTHEME_NOTIFIER_THEME_NAME', $themename );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder );
define( 'MTHEME_NOTIFIER_XML_FILE', $notifier_url );
define( 'MTHEME_NOTIFIER_CACHE_INTERVAL', 43200 );
require_once (TEMPLATEPATH . '/tuijian.php');
// WooCommerce
define('WOOCOMMERCE_USE_CSS', false);
add_action('woocommerce_before_main_content', 'tie_woocommerce_wrapper_start', 22);
function tie_woocommerce_wrapper_start() {
	echo '<div class="post-listing"><div class="post-inner">';
}
add_action('woocommerce_after_main_content', 'tie_woocommerce_wrapper_start2', 11);
function tie_woocommerce_wrapper_start2() {
  echo '</div></div>';
}
add_action('woocommerce_before_shop_loop', 'tie_woocommerce_wrapper_start3', 33);
function tie_woocommerce_wrapper_start3() {
  echo '<div class="clear"></div>';
}


global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
	add_action( 'init', 'tie_woocommerce_image_dimensions', 1 );

function tie_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '200',	// px
		'height'	=> '200',	// px
		'crop'		=> 1 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}


// Custom Functions 
include (TEMPLATEPATH . '/custom-functions.php');

// Get Functions
include (TEMPLATEPATH . '/functions/home-cats.php');
include (TEMPLATEPATH . '/functions/home-cat-tabs.php');
include (TEMPLATEPATH . '/functions/home-cat-scroll.php');
include (TEMPLATEPATH . '/functions/home-cat-pic.php');
include (TEMPLATEPATH . '/functions/home-cat-videos.php');
include (TEMPLATEPATH . '/functions/home-recent-box.php');
include (TEMPLATEPATH . '/functions/theme-functions.php');
include (TEMPLATEPATH . '/functions/common-scripts.php');
include (TEMPLATEPATH . '/functions/banners.php');
include (TEMPLATEPATH . '/functions/widgetize-theme.php');
include (TEMPLATEPATH . '/functions/default-options.php');
include (TEMPLATEPATH . '/functions/updates.php');

include (TEMPLATEPATH . '/includes/pagenavi.php');
include (TEMPLATEPATH . '/includes/breadcrumbs.php');
include (TEMPLATEPATH . '/includes/wp_list_comments.php');
include (TEMPLATEPATH . '/includes/widgets.php');

if(tie_get_option( 'lightbox' )) include (TEMPLATEPATH . '/functions/auto-highslide.php');
if(tie_get_option( 'lazyload' )) include (TEMPLATEPATH . '/functions/my-lazyload.php');

// tie-Panel
include (TEMPLATEPATH . '/panel/shortcodes/shortcode.php');
if (is_admin()) {
	include (TEMPLATEPATH . '/panel/mpanel-ui.php');
	include (TEMPLATEPATH . '/panel/mpanel-functions.php');
	include (TEMPLATEPATH . '/panel/category-options.php');
	include (TEMPLATEPATH . '/panel/post-options.php');
	include (TEMPLATEPATH . '/panel/custom-slider.php');
	include (TEMPLATEPATH . '/panel/notifier/update-notifier.php');
	include (TEMPLATEPATH . '/panel/importer/tie-importer.php');
}


/*-----------------------------------------------------------------------------------*/
# Custom Admin Bar Menus
/*-----------------------------------------------------------------------------------*/
function tie_admin_bar() {
	global $wp_admin_bar;
	
	if ( current_user_can( 'switch_themes' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'mpanel_page',
			'title' => theme_name ,
			'href' => admin_url( 'admin.php?page=panel')
		) );
	}
	
}
add_action( 'wp_before_admin_bar_render', 'tie_admin_bar' );

if ( ! isset( $content_width ) ) $content_width = 618;


// with activate istall option
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {

	if( !get_option('tie_active') ){
		tie_save_settings( $default_data );
		update_option( 'tie_active' , theme_ver );
	}
   //header("Location: admin.php?page=panel");
}
add_action( 'import_done', 'wordpress_importer_init' );
	
//后台仪表盘订阅逍遥乐（不需要可删除）
function dashboard_custom_feed_output() {
     echo '<div class="rss-widget">';
     wp_widget_rss_output(array(
         'url' => 'http://www.luoxiao123.cn/feed/', //rss地址
          'title' => '查看逍遥乐IT博客的最新内容',
         'items' => 6,         //显示篇数
          'show_summary' => 0,  //是否显示摘要，1为显示
          'show_author' => 0,   //是否显示作者，1为显示
          'show_date' => 1  )); //是否显示日期
     echo '</div>';
}
function h_add_dashboard_widgets() {
    wp_add_dashboard_widget('example_dashboard_widget', '逍遥乐IT博客最新动态', 'dashboard_custom_feed_output');
}
add_action('wp_dashboard_setup', 'h_add_dashboard_widgets' );
//更换登录logo描述 
add_filter("login_headertitle", create_function(false,"return get_bloginfo('description');"));

/* Postviews start */
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return " 0 ";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
       $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
/* Postviews start end*/

/* 访问计数 */
function record_visitors()
{
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  

/// 函数名称：post_views 
/// 函数作用：取得文章的阅读次数
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}

//增强编辑器开始
function add_editor_buttons($buttons) {
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'forecolor';
$buttons[] = 'backcolor';
$buttons[] = 'underline';
$buttons[] = 'hr';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'cut';
$buttons[] = 'copy';
$buttons[] = 'paste';
$buttons[] = 'cleanup';
$buttons[] = 'wp_page';
$buttons[] = 'newdocument';
return $buttons;
}
add_filter("mce_buttons_4", "add_editor_buttons");
//增强编辑器结束
//编辑器字体http://www.luoxiao123.cn/7259.html
 
function custum_fontfamily($initArray){
   $initArray['font_formats'] = "微软雅黑='微软雅黑';宋体='宋体';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';ClearSans='clear_sansregular',Helvetica,Arial,sans-serif;ClearSans Medium='clear_sans_mediumregula',Helvetica,Arial,sans-serif;ClearSans Light='clear_sans_lightregular',Helvetica,Arial,sans-serif;ClearSans Thin='clear_sans_thinregular',Helvetica,Arial,sans-serif";
   return $initArray;
}
add_filter('tiny_mce_before_init', 'custum_fontfamily');



//自动用文章标题为图片添加alt
//自动用文章标题为图片添加alt和title
add_filter('the_content', 'img_info');
function img_info ($img_info)
{ $pattern = "/<img(.*?)src=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
  $replacement = '<img$1src=$2$3.$4$5 alt="'.get_the_title().'" title="'.get_the_title().'"$6>';
  $img_info = preg_replace($pattern, $replacement, $img_info);
  return $img_info; }

/**
 * 为 WordPress 分类目录的描述添加可视化编辑器
 */
// 移除HTML过滤
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );
//为分类编辑界面添加可视化编辑器的“描述”框
add_filter('edit_category_form_fields', 'cat_description');
function cat_description($tag)
{
	?>
	<table class="form-table">
		<tr class="form-field">
			<th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
			<td>
				<?php
				$settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
				wp_editor(wp_kses_post($tag->description , ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
				?>
				<br />
				<span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.'); ?></span>
			</td>
		</tr>
	</table>
	<?php
}
//移除默认的“描述”框
add_action('admin_head', 'remove_default_category_description');
function remove_default_category_description()
{
	global $current_screen;
	if ( $current_screen->id == 'edit-category' )
	{
		?>
		<script type="text/javascript">
			jQuery(function($) {
				$('textarea#description').closest('tr.form-field').remove();
			});
		</script>
		<?php
	}
}
/**
 * WordPress 前台评论添加“删除”和“标识为垃圾”链接
 */
function comment_manage_link($id) {
	global $comment, $post;
	$id = $comment->comment_ID;
	if(current_user_can( 'moderate_comments', $post->ID )){
		if ( null === $link ) $link = __('编辑');
		$link = '<a class="comment-edit-link" href="' . get_edit_comment_link( $comment->comment_ID ) . '" title="' . __( '编辑评论' ) . '">' . $link . '</a>';
		$link = $link . ' | <a href="'.admin_url("comment.php?action=cdc&c=$id").'">删除</a> ';
		$link = $link . ' | <a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">标识为垃圾</a>';
		$link = $before . $link . $after;
		return $link;
	}
}
add_filter('edit_comment_link', 'comment_manage_link');

// 禁止全英文和日文评论
function BYMT_comment_post( $incoming_comment ) {
$pattern = '/[一-龥]/u';
$jpattern ='/[ぁ-ん]+|[ァ-ヴ]+/u';
if(!preg_match($pattern, $incoming_comment['comment_content'])) {
wp_die( "写点汉字吧，博主外语很捉急！ Please write some chinese words！" );
}
if(preg_match($jpattern, $incoming_comment['comment_content'])){
wp_die( "日文滚粗！Japanese Get out！日本語出て行け！" );
}
return( $incoming_comment );
}
add_filter('preprocess_comment', 'BYMT_comment_post');

?>