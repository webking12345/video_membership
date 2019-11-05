
<section id="footer">
    <div class="container">
        <div class="row site-title mt-4 mb-3">
            <div class="col-sm-12">
                <div class=" text-center text-secondary ft-16"><?php echo isset($copyright) ? $copyright : 'Copyright@2019 Lifestyle.com' ; ?></div>
            </div>
        </div>
    </div>
</section>

    <!-- plugins -->
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/jquery-3.4.0.min.js "></script>        
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/smooth-scroll.polyfills.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/jquery.sticky.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/popper.min.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/jquery-ui.min.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/jquery.bootpag.min.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/owl.carousel.min.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/propeller.min.js "></script>
    <!-- PDF viewer -->
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/pdfobject.min.js "></script> -->

    <!-- video player -->
    <script src='<?php echo base_url(); ?>public/plugins/polyfill.min.js'></script>
    <script src='<?php echo base_url(); ?>public/plugins/plyr.min.js'></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/stickyBar.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/videoPlayer.js "></script>

    <?php if(isset($resource)) { ?>
        <?php if($resource=='checkout/stripe') {?>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
            <!-- If you're using Stripe for payments -->
            <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <?php }?>

        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/<?php echo $resource; ?>.js "></script>
    <?php }?>
</html>