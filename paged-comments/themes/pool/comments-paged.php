<?php if ( post_password_required() ) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>


<h2 id="comments"><?php comments_number(__('No Comments yet'), __('1 Comment'), __('% Comments')); ?> 
<?php if ( comments_open() ) : ?>
	<a href="#postcomment" title="<?php _e("Leave a comment"); ?>">&raquo;</a>
<?php endif; ?>
</h2>


<p>
<?php if ( comments_open() ) : ?>
<?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?> 
<?php endif; ?>

<?php if ( pings_open() ) : ?>
<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>'); ?></a>
<?php endif; ?>
</p>

<?php if ( $comments ) : ?>

<!-- Comment page numbers -->
<?php if ($paged_comments->pager->num_pages() > 1): ?>
<p class="comment-page-numbers"><?php _e("Pages:"); ?> <?php paged_comments_print_pages(); ?></p>
<?php endif; ?>
<!-- End comment page numbers -->

<ol id="commentlist" style="list-style-type: none;">

<?php foreach ($comments as $comment) : ?>

<?php $i++; /* For different background colors */
	($i % 2 == 1) ? $bg_comment = 'class_comment1' : $bg_comment = 'class_comment2';
?>

	<li id="comment-<?php comment_ID() ?>" class="<?php echo $bg_comment; ?>">
	<div class="comment-number"><?php echo $comment_number; $comment_number += $comment_delta;?></div>
	<?php comment_text() ?>
	<p class="alignright"><small><?php comment_type(__('Comment'), __('Trackback'), __('Pingback')); ?> <?php _e('by'); ?> <?php comment_author_link() ?> &#8212; <?php comment_date() ?> <a href="<?php echo paged_comments_url('comment-'.get_comment_ID()); ?>">#</a><?php edit_comment_link(__("Edit This"), ' |'); ?></small></p>
	</li>

<?php endforeach; ?>

</ol>

<!-- Comment page numbers -->
<?php if ($paged_comments->pager->num_pages() > 1): ?>
<p class="comment-page-numbers"><?php _e("Pages:"); ?> <?php paged_comments_print_pages(); ?></p>
<?php endif; ?>
<!-- End comment page numbers -->

<?php endif; ?>

<?php if ( comments_open() ) : ?>
<h2 id="postcomment"><?php _e('Leave a comment'); ?></h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>">Logout &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small>Name <?php if ($req) _e('(required)'); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small>Mail (will not be published) <?php if ($req) _e('(required)'); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></p>
<p><small><strong>XHTML:</strong> <?php echo allowed_tags(); ?></small>
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
<p><?php _e('Sorry, the comment form is closed at this time.'); ?></p>
<?php endif; ?>
