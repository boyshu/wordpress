<?php
global $post;
$share_box_class= "mini-share-post";
if( is_singular() ) $share_box_class = "share-post";
?>
<div class="<?php echo $share_box_class ?>">
	<span class="share-text"><?php _e( 'Share !' , 'tie' );?></span>
	<script>
	window.___gcfg = {lang: 'en-US'};
	(function(w, d, s) {
	  function go(){
		var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.src = url; js.id = id;
		  fjs.parentNode.insertBefore(js, fjs);
		};
		load('//connect.facebook.net/en/all.js#xfbml=1', 'fbjssdk');
		load('https://apis.google.com/js/plusone.js', 'gplus1js');
		load('//platform.twitter.com/widgets.js', 'tweetjs');
	  }
	  if (w.addEventListener) { w.addEventListener("load", go, false); }
	  else if (w.attachEvent) { w.attachEvent("onload",go); }
	}(window, document, 'script'));
	</script>
	<ul>
<?php if( tie_get_option( 'share_baidu' ) ): ?>
		<li style="width:300px;margin-top:-10px">
		<!-- Baidu Button BEGIN -->
		<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
		<a class="bds_qzone"></a>
		<a class="bds_tsina"></a>
		<a class="bds_tqq"></a>
		<a class="bds_renren"></a>
		<a class="bds_t163"></a>
		<span class="bds_more"></span>
		<a class="shareCount"></a>
		</div>
		<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=471458" ></script>
		<script type="text/javascript" id="bdshell_js"></script>
		<script type="text/javascript">
		document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
		</script>
		<!-- Baidu Button END -->
		</li>
	<?php endif; ?>				
	<?php if( tie_get_option( 'share_tweet' ) ): ?>
		<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="<?php echo tie_get_option( 'share_twitter_username' ) ?>" data-lang="en">tweet</a></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_facebook' ) ): ?>
		<li>
			<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		</li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_google' ) ): ?>
		<li style="width:80px;"><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
		</li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_stumble' ) ): ?>
		<li><su:badge layout="2" location="<?php the_permalink(); ?>"></su:badge>
			<script type="text/javascript">
				(function() {
					var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
					li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
				})();
			</script>
		</li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_linkdin' ) ): ?>
		<li><script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="right"></script></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_pinterest' ) ): ?>
		<li style="width:80px;"><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo tie_thumb_src( 'slider' ); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="http://assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
	<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div> <!-- .share-post -->