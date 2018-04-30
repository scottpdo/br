        <section id="warranty">
            <div class="scroll">
                <h2>Warranty</h2>
                <img alt="Warranty - B and R Auto and Truck Salvage" class="alignright" src="<?php echo bloginfo('template_url'); ?>/images/warranty.jpg" />
                <h3>Warranties are subject to the following conditions</h3>
                <ul>
                    <li>Unless otherwise noted on invoice, warranty expires 90 days after date of purchase. Warranty expires 30 days after date of purchase for motors, rear ends, and transmissions over 15 model years. Claims made after this period of time will not be covered under warranty.</li>
                    <li>Invoice must accompany all claims under warranty.</li>
                    <li>Merchandise must be returned to Seller.</li>
                    <li>Defective transmissions, axle assemblies, and engine assemblies must be returned to the Seller installed in the vehicle for the purpose of analysis before warranty coverage will be considered.</li>
                    <li>New fluids, filters, seals, and gaskets must be used in installation of part. Engine oil must be of the proper viscosity for the season of the year and transmission oil must be the type recommended by the manufacturer of the vehicle.</li>
                    <li>Engine assemblies are understood to consist of a short block assembly and cylinder heads. Any other parts left on the engine assembly at the time of sale are included for possible purchaser convenience only and are to be used at the purchaser's option only. These parts are not covered under the warranty.</li>
                    <li>Motors, rear ends and transmissions have 90 day warranties.</li>
                </ul>
                <h3>Warranties do not cover</h3>
                <ul>
                    <li>The purchaser's loss of time, inconvenience, loss of use of the vehicle, towing expense, installation expense, commercial loss or consequential damages.</li>
                    <li>Fluids, gaskets, seals, filters, or other materials or parts used in the installation of the purchaser's part.</li>
                    <li>Claims that result form accident, abuse, neglect, alteration, improper installation.</li>
                    <li>Standard transmission gears.</li>
                    <li>Parts installed in vehicles used for commercial, racing, or off road purposes, or any part used under conditions that would cause greater that normal wear.</li>
                    <li>Parts used for other than original application.</li>
                </ul>
                <h3>Purchaser Please Note</h3>
                <p>Some states do not allow the exclusion or limitation of incidental or consequential damages, so the above limitations or exclusions may not apply to you. This warranty gives you specific legal rights and you may have other rights which vary from state to state.</p>
                <h3>Deposits</h3>
                <p>Deposits on parts are good for only 30 days.</p>
                <p style="margin-bottom: 60px;">This is the extent of B&amp;R Auto &amp; Truck Salvage, Inc. warranty.</p>
            </div>

            <div class="close"></div>
        </section>

        <section id="exchange">
            <div class="scroll">
                <h2>Return Policy</h2>
                <h3>All Returned items are subject to the following conditions:</h3>
                <ul>
                    <li>Invoice must accompany all returns.</li>
                    <li>No returns on special orders.</li>
                    <li>80% refund on all returned parts.</li>
                    <li>Parts must be returned unused and in the same condition as when purchased.</li>
                    <li>No returns on parts under $15.00.</li>
                    <li>No returns after 15 days of purchase.</li>
                </ul>
                <h2>Exchange Policy</h2>
                <p style="margin-bottom: 60px;">Deposit on parts to be exchanged are refundable within 20 days from date of purchase. Any exchange parts returned after this 20 day period are not eligible for refund of deposit.</p>
            </div>

            <div class="close"></div>
        </section>

    </div><!-- #main -->

    <div class="greyscale"></div>

    <footer class="clearfix">
        <div class="alignleft">
            <span>&copy; <?php echo date('Y'); ?> B &amp; R Auto &amp; Truck Salvage</span>
            &nbsp;&nbsp;<span class="sep">|</span>&nbsp;&nbsp;
            <span class="parsley">Design + Code by <a href="http://www.parsleyandsprouts.com" target="_blank">Parsley &amp; Sprouts</a></span>
        </div>
        <div class="alignright uppercase">
            <span class="warranty">Warranty</span>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <span class="exchange">Exchange/Return Policy</span>
        </div>
    </footer>

    <script src="<?php echo bloginfo('template_url'); ?>/js/jquery-ui-1.8.21.custom.min.js"></script>
    <script src="<?php echo bloginfo('template_url'); ?>/js/plugins.js"></script>
    <script src="<?php echo bloginfo('template_url'); ?>/js/script.js"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-36786652-1', 'auto');
      ga('send', 'pageview');

    </script>

    <?php if (is_front_page()) { ?>
      <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/lib/swal/sweetalert.css">
      <script src="<?php echo bloginfo('template_url'); ?>/lib/swal/sweetalert.min.js"></script>
      <script>
      var img = document.createElement('img');
      var src = '<?php echo bloginfo('template_url'); ?>/images/detour-2018.png';
      img.src = src;
      img.onload = function() {
        swal({
          title: "Updated Directions:",
          text: '<p style="font-size: 18px; margin-bottom: 10px;">Please note: Highway 22 construction is occurring this summer. Google Maps may not show the correct route.</p><img src="' + src + '" />',
          html: true,
          allowOutsideClick: true,
          confirmButtonText: "OK",
        });
      }
      </script>
    <?php } ?>

    <?php wp_footer(); ?>
    </body>
</html>
