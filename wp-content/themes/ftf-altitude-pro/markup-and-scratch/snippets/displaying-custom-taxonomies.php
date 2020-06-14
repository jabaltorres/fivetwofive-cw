<div class="product-type">
  <div>
	  <?php echo get_the_term_list( $post->ID, 'product-type', 'Type of product: ', ', ', '' ); ?>
  </div>
</div>
<div class="mood">
  <div>
	  <?php echo get_the_term_list( $post->ID, 'jt-custom-tag', 'The mood this puts me in: ', ', ', '' ); ?>
  </div>
</div>