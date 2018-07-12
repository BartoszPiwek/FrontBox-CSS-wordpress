<!-- Header -->
<header class="header navbar" id="header">
    <div class="wrap wrap-navbar">
        <div class="container" id="header-container">
            <!-- content -->
            <div class="container__position container__position--left sm_width-100">
                <div class="container__item navbar-left">
                    <div class='v-center'>
                        <div class='v-center__content'>
                                
                        </div>
                    </div>
                </div>  
            </div>

            <div class="container__position container__position--right navbar__navigation navbar-right">

                <div id="burger-button" class="navbar__button">
                    <span class="plank"></span>
                    <span class="plank"></span>
                    <span class="plank"></span>
                </div>

                <div id="burger-menu" class="nav">
                    <nav class="nav__container">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'main-menu',
                                'menu_class' => 'nav__container',
                                'menu_id' => false,
                                'container_class' => 'nav',
                                'container_id' => 'burger-menu',
                                // 'walker'          => new NAV_MENU,
                                'depth'           => 1,
                                'container' => '',
                                'items_wrap' => '%3$s' 
                            ) );
                        ?>   
                    </nav> 
                    <div class="nav__overlay" id="nav-overlay"></div>
                </div>      

            </div>

            <!-- end content -->
        </div>
    </div>
</header>
<div class="header__overlay"></div>