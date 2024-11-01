<div class="share-the-posts-single-sticky">
	<div class="share-the-posts-single-sticky-wrapper">
		<a href="<?php echo esc_url( $this->stp_post->get_permalink() ) ?>" target="_blank" class="share-the-posts-single-sticky-link">
			<?php echo wp_get_attachment_image( $this->stp_post->get_image(), array('150', '150'), "", array( "class" => "img-responsive", "alt" => $this->stp_post->get_title() ) ); ?>
			<span class="share-the-posts-single-sticky-title"><?php echo esc_html( $this->stp_post->get_button_text() ) ?></span>
		</a>
	</div>
</div>