<!-- Footer -->
                    <footer class="clearfix">
                        <div class="pull-right">
                            Crafted By <a href="http://www.amsons.net/" target="_blank">Amsons Communications P. Ltd.</a>
                        </div>
                        <div class="pull-left">
                            &copy; 2016 <a href="" target="_blank">AMSONS</a>
                        </div>
                    </footer>
                    <!-- END Footer -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        

        <!-- Remember to include excanvas for IE8 chart support -->
        <!--[if IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file -->
        
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="<?php echo base_url().JS; ?>vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src="<?php echo base_url().JS; ?>vendor/bootstrap.min.js"></script>
        <script src="<?php echo base_url().JS; ?>plugins.js"></script>
        <script src="<?php echo base_url().JS; ?>app.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url().JS; ?>jquery-ui-1.11.1.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url().JS; ?>jquery-ui.multidatespicker.js"></script>

        <!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps 
        <script src="//maps.google.com/maps/api/js?sensor=true"></script>
        <script src="<?php //echo base_url().JS; ?>helpers/gmaps.min.js"></script>-->
		
		<!--<script src="http://lab.iamrohit.in/js/location.js"></script> Animation Js -->
		
		

        <!-- Load and execute javascript code used only in this page 
        <script src="<?php //echo base_url().JS; ?>pages/index.js"></script>
		
		 <script>$(function(){ Index.init(); });</script>
		-->
		
		<script>
			//$(function() {
			//var loc = new locationInfo();
			//loc.getStates(101);
			//});
		</script>
       
		
		<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
<script src="<?php echo base_url().JS; ?>helpers/jquery.form-validator.min.js"></script>
<!--
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> -->

<script>
  $.validate({
    modules : 'html5'
  });
</script>


    </body>
</html>