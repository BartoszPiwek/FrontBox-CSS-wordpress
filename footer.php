	<footer class="footer">
		<div class="wrap wrap-footer">
      <div class="row-flex flex-same-size sm_hide">
      <?php
  		if ( is_active_sidebar( 'footer__left' ) ) { ?>
          <div class="col-12 lg_col-5 md_col-6">
  				      <?php dynamic_sidebar( 'footer__left' ); ?>
          </div>
  		<?php } ?>

      <?php
  		if ( is_active_sidebar( 'footer__right' ) ) { ?>
        <div class="col-12 lg_push-3 md_push-1 md_col-4">
          <?php dynamic_sidebar( 'footer__right' ); ?>
        </div>
  		<?php } ?>

      </div>
      <div class="row-flex row-links">
        <div class="col-12 md_col-4 lg_col-5">
          <div class="footer-links">
            <a class="link" href="http://www.polskistandardplatnosci.pl/Content/docs/Polityka_prywatności_PSP.pdf" target="_blank" class="footer-links__link">Polityka prywatności</a>
            <a class="link" href="http://www.polskistandardplatnosci.pl/Content/docs/Polityka_cookies_PSP.pdf" target="_blank" class="footer-links__link">Polityka cookies</a>
            <a class="link line--end" href="http://www.polskistandardplatnosci.pl/Content/docs/Polityka_cookies_PSP.pdf" target="_blank" class="footer-links__link">Materiały do pobrania</a>
            </div>
        </div>
        <div class="col-12 lg_push-2 lg_col-4 md_col-4 md_push-4">
          <div class="footer-links mt-0">
            <p class="footer-links__text footer-links__copy">© 2017 Polski Standard Płatności</p>
          </div>
        </div>
      </div>
      <?php
      if ( is_active_sidebar( 'footer__social' ) ) { ?>
          <div class="col-social ignore col-12 md_col-8 md_push-2 lg_col-3">
            <?php dynamic_sidebar( 'footer__social' ); ?>
          </div>
      <?php } ?>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
