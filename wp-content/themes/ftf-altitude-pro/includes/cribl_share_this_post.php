<div class="cribl-social-share-module">
	<h5 class="m-b-sm">Share this on social media!</h5>
	<ul class="share-on-social">
		<li><a rel="nofollow" target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" title="Share this article with your Twitter followers">Tweet this!</a></li>
		<li><a rel="nofollow" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php echo urlencode(get_the_title($id)); ?>" title="Share this post on Facebook">Share on Facebook</a></li>
		<li><a rel="nofollow" target="_blank" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>" title="Share this post on Reddit">Share on Reddit</a></li>
		<li><a rel="nofollow" target="_blank" href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php the_permalink(); ?>" title="Share this post on Google+">Share on Google+</a></li>
		<li><a rel="nofollow" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php echo urlencode(get_the_title($id)); ?>&summary=<?php echo get_the_excerpt(); ?>&source=<?php bloginfo('name'); ?>">Share on LinkedIn - 1</a></li>
		<li><a rel="nofollow" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php echo urlencode(get_the_title($id)); ?>&source=<?php bloginfo('name'); ?>">Share on LinkedIn - 2</a></li>
	</ul>
</div>