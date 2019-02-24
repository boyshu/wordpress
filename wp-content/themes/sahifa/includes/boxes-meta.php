<p class="post-meta">
<?php if( tie_get_option( 'box_meta_score' ) ) tie_get_score(); ?>
<?php if( tie_get_option( 'box_meta_author' ) ): ?>		
	<span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( '查看 %s 所有文章', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author() ?> </a></span>
<?php endif; ?>	
<?php if( tie_get_option( 'box_meta_date' ) ): ?>		
	<?php tie_get_time() ?>
<?php endif; ?>	
<?php if( tie_get_option( 'box_meta_cats' ) ): ?>
	<span><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( tie_get_option( 'box_meta_comments' ) ): ?>
	<span><?php comments_popup_link( __( '发表评论', 'tie' ), __( '1 条评论', 'tie' ), __( '% 条评论', 'tie' ) ); ?></span>
<?php endif; ?>
</p>
