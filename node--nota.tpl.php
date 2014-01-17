<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<?php // breadcrums custom see template.php ?>
<?php print nnmx_breadcrums(); ?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<?php //titulo de la nota ?>
<h1><?php echo $title; ?></h1>
<?php //balazo de la nota ?>
<h2><?php print render($content['field_balazo']); ?></h2>
<?php //autores de la nota ?>
<h3><?php print render($content['field_autores']); ?></h3>
<time><?php print $date; ?></time>
<div class="galeria">
  <?php //slideshow de fotos ?>
  <?php print render($content['field_nota_foto']); ?>
</div>

<div class="social-bar">
	<div class="comment-count"><!--Contador de comentarios-->
		<fb:comments-count href=<?php echo url('', array('absolute' => TRUE)) . current_path(); ?>></fb:comments-count>
	<div>
	<div class="like-button"><!-- Boton like de facebook -->
		<fb:like href="<?php echo url('', array('absolute' => TRUE)) . current_path(); ?>"></fb:like>
	</div>
	<div class="twittear-button"><!--boton de twittear-->
        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="es" data-related="noticiasnetmx">Twittear</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </div>
    <div class="plus-one"><!--plus one button-->
		<div class="g-plusone" data-size="medium"></div>
		<script type="text/javascript">
		  window.___gcfg = {lang: 'es-419'};

		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
    </div>
    <?php if(!empty($content['links']['statistics'])): ?>
    <div class="statistics"><!--Estadisticas del nodo-->
		<?php print render($content['links']['statistics']); ?>
    </div>
	<?php endif; ?>
</div><!--fin barra social-->

<div class="nota">
  <div class="numeralia">
    <?php //numeralia ?>
    <span class="n-title">Numeralia</span>
    <?php print format_string($node->field_numeralia[LANGUAGE_NONE][0]['value']); ?>
  </div>
  <?php //cuerpo ?>
  <?php print format_string($node->body[LANGUAGE_NONE][0]['value']); ?>
</div>
</article>
<div class="pub_bottom">
	<div class="pub_bottom_left">
		<?php
		//imprimimos el anuncio desde la referencia del modulo DFP 
		$pub_bottom_left = dfp_serve_external_data('add-ContLeftAll-300x250', 'node');
		if(count($pub_bottom_left) > 0) {
			print $pub_bottom_left[0];
		}
		?>
	</div>
	<div class="pub_bottom_right">
		<?php
		//imprimimos el anuncio desde la referencia del modulo DFP 
		$pub_bottom_right = dfp_serve_external_data('add-ContRightAll-300x250', 'node');
		if(count($pub_bottom_right) > 0) {
			print $pub_bottom_right[0];
		}
		?>
	</div>
</div>
<div class="comentarios">
	<fb:comments href="<?php echo url('', array('absolute' => TRUE)) . current_path(); ?>" width="674" num_posts="4"></fb:comments>
</div>