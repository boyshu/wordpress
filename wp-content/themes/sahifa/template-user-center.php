<?php
/*
Template Name: 用户中心页面
*/

?>
<?php get_header(); ?>
<section class="pad user-center group">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="user-inner">
      <div id="user-left">
        <div class="user-avatar">
          <?php global $userdata; echo get_avatar( $userdata->user_email, 100 ).'<p>'.$userdata->display_name.'</p>'; ?>
        </div>
        <ul id="user-menu">
         <?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'user-menu', 'fallback_cb' => 'cmp_nav_fallback',)); ?>
       </ul>
     </div>
     <div id="user-right" class="entry">
      <div class="user-header">
        <div class="feedback"><a href="<?php tie_get_option('user_fankuilinks'); ?>">反馈建议</a></div>
        <h1 class="user-title" itemprop="headline">
          <?php the_title(); ?>
        </h1>
        <?php
        if(tie_get_option('user_tips')){
          echo '<div class="poptip"><span class="poptip-arrow poptip-arrow-left"><em>◆</em><i>◆</i></span>'.htmlspecialchars_decode(tie_get_option('user_tips')).'</div>';
        }
        ?>
      </div>
      <div class="entry" itemprop="articleBody">
        <?php the_content(); ?>
      </div>
    </div>
    <div class="clear"></div>
  </div>
<?php endwhile;?>
</section>
<?php get_footer(); ?>