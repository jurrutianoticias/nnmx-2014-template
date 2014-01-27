<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>


<div id="blk-ad-background-left" class="ad-background">
  <?php print render($page['blk_ad_background_left']); ?>
</div>
<div id="blk-ad-background-right" class="ad-background">
  <?php print render($page['blk_ad_background_right']); ?>
</div>

    <div class="blk-skycrapper-wrapper wrapper">
      <div id="blk-skycrapper" class="row">
        <?php print render($page['blk_skycrapper']); ?>
      </div>
    </div>
    
    <div class="blk-header-wrapper wrapper">
      <header id="blk-header" class="row"><!--inicio del header-->
        <div class="social-header">
          <a href="<?php echo $GLOBALS['base_path']; ?>">
            <span class="logo-text"><img src="<?php echo $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx'); ?>/images/logo-text.png" atl="noticiasnet.mx" title="noticiasnet.mx" /></span>
          </a>
          <?php if(!user_is_logged_in()): ?>
          <a href="#" class="login-icon" title="login">
            <span data-icon="o" class="icon social-icons"></span>
            <div class="login-form-wrapper">
              <div class="login-form secciones">
                <?php print render($custom_login_form); ?>
              </div>
            </div>
          </a>
          <?php endif; ?>
          <?php if(user_is_logged_in()): ?>
          <a href="<?php echo base_path(); ?>user/logout" title="logout" target="_blank">
            <span data-icon="f" class="icon social-icons"></span>
          </a>
          <?php endif; ?>
          <a href="https://www.facebook.com/pages/Noticiasnetmx/131129766930048" target="_blank">
            <span data-icon="n" class="icon social-icons" title="facebook"></span>
          </a>
          <a href="https://twitter.com/noticiasnetmx" target="_blank">
            <span data-icon="t" class="icon social-icons" title="twitter"></span>
          </a>
          <a href="http://www.youtube.com/user/noticiasnetmx2012" target="_blank">
            <span data-icon="v" class="icon social-icons" title="youtube"></span>
          </a>
          <a href="<?php echo $GLOBALS['base_path']; ?>rss.xml" target="_blank">
            <span data-icon="r" class="icon social-icons" title="rss"></span>
          </a>
        </div>
        <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img class="main-logo" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>
      
      <!-- no es necesario imprimir el site name y el site slogan pero queda como opcion
      <?php if ($site_name || $site_slogan): ?>
        <div id="name-and-slogan">
          <?php if ($site_name): ?>
            <?php if ($title): ?>
              <div id="site-name"><strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong></div>
            <?php else: /* Use h1 when the content title is empty */ ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    -->

      <?php if ($main_menu): ?> <?php //menu principal inicio ?>
      <!--<div class="menu-button">Menu</div>-->
      <nav id="navigation" class="nav-collapse">
        <?php print render($main_menu_expanded); ?>
      </nav> <!-- /.section, /#navigation -->
    <?php endif; ?> <?php //fin menu principal ?>
      </header><!--Fin del header-->
    </div>
    <?php if($page['blk_carrusel']): ?>
    <div class="blk-carrusel-wrapper wrapper">
      <div id="blk-carrusel" class="row">
        <?php print render($page['blk_carrusel']); ?>
      </div><!--fin blk-carrusel -->
    </div>
    <?php endif; ?>


    <?php //bloque de busqueda y fecha actual ?>
    <div class="date-search-block row">
      <div class="col6 date">
        <?php echo format_date(time(), 'long'); ?>
      </div>
      <div class="col6 search">
        <script>
          (function() {
            var cx = '016101084644073512961:epildbejxx0';
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                '//www.google.com/cse/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
          })();
        </script>
        <gcse:search></gcse:search>
      </div>
    </div>


    <?php if($page['blk_up']): ?>
    <div class="blk-up-wrapper wrapper">
      <div id="blk-up" class="row">
        <?php print render($page['blk_up']); ?>
      </div><!--fin blk-up -->
    </div>
    <?php endif; ?>
    <!--drupal Status messages-->
    <div class="status-messages"><?php print $messages ?></div>
    <!--fin drupal status messages-->
    
    <div class="blk-main-wrapper wrapper">
      <div class="row">
        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      </div>
      <div id="blk-main" class="row">
        <section id="contenido" class="<?php print nnmx_check_sidebars($page['left_sidebar'], $page['right_sidebar']); ?>">
          <?php print render($page['content']); ?>
        </section><!--fin contenido-->
        <?php if($page['left_sidebar']): ?>
        <section id="left-sidebar" class="col4">
          <?php print render($page['left_sidebar']); ?>
        </section>
        <?php endif; ?>
        <?php if($page['right_sidebar']): ?>
        <section id="right-sidebar" class="col4">
          <?php print render($page['right_sidebar']); ?>
        </section>
        <?php endif; ?>
      </div><!--fin blk-main-->
    </div>

    <div id="blk-middle-pub" class="row">
      <div class="cosa2"></div>
      <?php print render($page['blk_middle_pub']); ?>
    </div>
    <div id="blk-row-1" class="row">
      <?php print render($page['blk_row_1']); ?>
    </div>
    <div id="blk-row-2" class="row">
      <?php print render($page['blk_row_2']); ?>
    </div>
    <div id="blk-row-3" class="row">
      <?php print render($page['blk_row_3']); ?>
    </div>
    <div class="blk-footer-wrapper wrapper">
      <div id="blk-footer" class="row">
        <?php print render($page['blk_footer']); ?>
      </div>
      <span class="separador-linea"></span>
      <footer class="row brand">
      <nav id="permanentes" class="clearfix">
        <?php print render($menu_permanentes); ?>
      </nav>
      <img src="<?php echo $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx'); ?>/images/nmx.png" />
      <p>NOTICIAS Voz e Imagen© y NOTICIASnet© son marcas registradas de Editorial Golfo Pacífico, S.A. de C.V. y/o una de sus empresas filiales.
Todos los derechos reservados® Portal oficial del Grupo Noticias Voz e Imagen de Oaxaca, Tuxtepec, Chiapas.</p>
      <p>www.noticiasnet.mx</p>
      </footer>
      <div class="footer-color"></div>
    </div>
