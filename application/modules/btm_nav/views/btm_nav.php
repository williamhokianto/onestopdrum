<div id="btm_nav">

</div>

<footer class="footer-distributed" style="margin-top: 0px !important">

      <div class="footer-left">

        <img class="img img-responsive img-center" src="<?= base_url() ?>assets/img/OneStopDrum White Inline.png" alt="ido">

        <p class="footer-links">
          	<?php
				foreach ($query->result() as $row) {
				$page_url = base_url().$row->page_url;
				$page_title = $row->page_title;
				echo " <a href=".$page_url;
				echo ">".$page_title;
				echo "</a> |";
			}
			?>
        </p>

        <p class="footer-company-name">OneStopDrum &copy; 2017</p>
      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>Jl. Scientia Boulevard, Gading Serpong,</span> Tangerang, Banten-15811 Indonesia</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+628 9685 7234 31</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p"><a href="mailto:onestopdrum@gmail.com" style="color: white;">onestopdrum@gmail.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span>About the company</span>
          <b>One Stop Drum</b><br>
          Your one stop sollution for drum kits & accessories, unleash the power within.
        </p>

        <div class="footer-icons">

          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="https://linkedin.com/in/william-hokianto-65b356133"><i class="fa fa-linkedin"></i></a>
          <a href="https://github.com/williamhokianto"><i class="fa fa-github"></i></a>

        </div>

      </div>

    </footer>