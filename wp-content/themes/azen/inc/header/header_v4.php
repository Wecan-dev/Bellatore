<div class="affix-top header-hp-1 style-header-hp-2">
    <div id="js-navbar-fixed" class="menu-desktop">
        <div class="menu-desktop-inner">
            <!-- Logo -->
            <?php
            echo '<div class="menu-mobile-effect hamburger hamburger--spin"><div class="hamburger-box">
							<span class="hamburger-inner"></span>
						</div></div>';
            do_action('azen_logo_404');
            ?>
            <div class="space-header"></div>
            <!-- Main Menu -->
            <nav class="main-menu">
                <?php
                get_template_part('inc/header/main-menu');
                ?>
            </nav>
            <!-- Header Right -->
            <?php if (is_active_sidebar('menu_right')) {
                echo '<div class="header-right">';
                dynamic_sidebar('menu_right');
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>