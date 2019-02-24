<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- more_tuijian_page

-----------------------------------------------------------------------------------*/
function more_tuijian_page(){
        ?>
		<STYLE type="text/css">
		.wrap {
			margin:0 15px 0 5px;
			font-family:Tahoma,'Microsoft Yahei','Simsun',Arial,sans-serif;
		}
		.wrap h2{
			font-family:Tahoma,'Microsoft Yahei','Simsun',Arial,sans-serif;
		}
		.tuijian-page div.info {
			height:30px;
			line-height:26px;
			margin-top:20px;
		}
		.tuijian-page div.info a {
	-moz-border-radius: 4px 4px 4px 4px;
	border-radius: 4px 4px 4px 4px;
	float: left;
	margin: 0 10px 0 0;
	padding: 3px 10px;
	font-size: 12px;
	background-attachment: scroll;
	background-color: #FF6600;
	background-image: none;
	background-repeat: repeat;
	background-position: 0 0;
		}
		.tuijian-page div.info a:link, .tuijian-page div.info a:visited {
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	text-decoration: none;
		}
		#tuijian-page div.info a:hover{ color:#666;top:1px; left:1px; position:relative;}
		.tuijian-page div.info a:active, .tuijian-page div.info a:hover {
	color: #FF6600;
		}
		ul.tuijian li.theme {
	padding: 20px 0;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #FFFFFF;
		}
		ul.tuijian li.theme h2{
			font-size:20px;
			padding:10px;
			border-bottom:1px dashed #ccc;
			font-family:Tahoma,'Microsoft Yahei','Simsun',Arial,sans-serif;
		}
		ul.tuijian li.theme h2 a{
			text-decoration:none;
		}

		ul.tuijian li.theme span img {
		}
		ul.tuijian li.theme div {
			margin-left:310px;
		}
		ul.tuijian li.theme div h2 {
			background:none repeat scroll 0 0 #EEEEEE;
			border-bottom:1px solid #DDDDDD;
			border-top:1px solid #E1E1E1;
			font-size:20px;
			margin-bottom:10px;
			padding:0 10px;
		}
		ul.tuijian li.theme div h2 a:link, ul.tuijian li.theme div h2 a:visited {
			color:#555555;
			font-style:normal;
			text-decoration:none;
		}
		ul.tuijian li.theme div p {
			padding-left:5px;
			width:450px;
		}
		ul.tuijian li.theme div p {
			font-size:12px !important;
			margin:10px;
		}
		ul.tuijian li.theme div ul {
			border-top:1px solid #EEEEEE;
			color:#CCCCCC;
			float:left;
			margin-left:20px;
			padding-left:0;
			padding-top:10px;
		}
		ul.tuijian li.theme div ul li {
			list-style:disc inside none;
		}
		ul.tuijian li.theme div ul li a:link, ul.tuijian li.theme div ul li a:visited {
	font-size: 12px !important;
	text-decoration: none;
	color: #333;
		}
		ul.tuijian li.theme div ul li a:hover, ul.tuijian li.theme div ul li a:active {
			text-decoration:underline;
		}
		#search input{
			height:26px;
			line-height:26px;
		}
		</STYLE>
        <div class="wrap tuijian-page">
        <h2>更多推荐</h2>
        
		<?php // Get RSS Feed(s)
        include_once(ABSPATH . WPINC . '/feed.php');
        $rss = fetch_feed('http://www.luoxiao123.cn/feed');			
        // Of the RSS is failed somehow.
        if ( is_wp_error($rss) ) {
            $error = $rss->get_error_code();
            if($error == 'simplepie-error') {
                //Simplepie Error
                echo "<div class='updated fade'><p>An error has occured with the RSS feed. (<code>". $error ."</code>)</p></div>";
            }
            return;
         } 
        ?>
        <div class="info">
			<a target="_blank" href="http://www.luoxiao123.cn/">逍遥乐IT博客首页</a>
			<a target="_blank" href="http://list.qq.com/cgi-bin/qf_invite?id=cc20bf577a0d772f4b2d5d07a1a08989aa07494fdb05ded3">订阅逍遥乐IT博客</a>
            <form id="search" method="get" action="http://www.luoxiao123.cn/">
              <input type="text" name="s" id="textfield" onblur="if (this.value == '') {this.value = '输入关键词搜索...';}" onfocus="if (this.value == '输入关键词搜索...') {this.value = '';}" value="输入关键词搜索..." />
              <input type="submit" id="submit" value="搜索" />
          </form>
		</div>
        <?php
            $maxitems = $rss->get_item_quantity(30); 
			$items = $rss->get_items(0, 30);
        ?>
        <ul class="tuijian">
		<?php if (empty($items)) echo '<li>No items</li>';
        else
			foreach ( $items as $item ) : ?>
				<li class="theme">
                <h2><a target="_blank" href='<?php echo esc_url( $item->get_permalink() ); ?>'
        title='<?php echo $item->get_title(); ?>'>
        <?php echo esc_html( $item->get_title() ); ?></a></h2>
					<?php echo $item->get_content();?>
				</li>
			<?php 
			endforeach; ?>
        </ul>
    </div>        
         <?php
    }
	if (!function_exists('more_tuijian_recommend_page')):
	function izt_more_tuijian() {
	add_menu_page("More Themes", "<strong>更多推荐</strong>", 0, 'gdtj', 'more_tuijian_page',get_bloginfo('template_url').'/images/xiaoyaole_logo.png');
	}
	add_action('admin_menu', 'izt_more_tuijian');
	endif;
?>