<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HOME</title>
    <meta name="description" content='All about meta tags and how to add them to your website.'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/font-awesome/css/font-awesome.min.css"> 
    <!-- video -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dist/normalize.min.css">
    <link rel='stylesheet' href='<?php echo base_url(); ?>public/css/dist/plyr.css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/home/home.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/home/users.css">
    <?php if($resource=="catalogue/details"){?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/owl-carousel/owl.theme.css">
    <?php }?>
    <script>
        let theme='<?php echo $theme?'brightly':'darkly';?>';
        let base_url = '<?php echo base_url() ?>';

    </script>
</head>
<body class="<?php echo (($theme) ? 'brightly' : 'darkly'); ?>">
    <div id="sticky" class="header-bar <?php echo ($theme ? 'brightly' : 'darkly'); ?>">
        <nav class="navbar navbar-expand-md header-menu">
            <div class="h-100">
                <a href="<?php echo base_url(); ?>home" class="navbar-brand h-100 p-0">
                    <img class="h-100" src="<?php echo base_url(); ?>public/images/logo.png">
                </a>
                <a href="#" id="theme-btn" class="h-100 ml-4" data-state="<?php echo $theme; ?>" >
                    <img class="h-100" src="<?php echo base_url(); ?>public/images/bulb-<?php echo ($theme ? 'on' : 'off'); ?>.png">
                </a>
            </div>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse" style="z-index:1; background:rgb(0,0,0,0.8)">
                <div class="navbar-nav  ml-auto">
                    <a href="<?php echo base_url(); ?>" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold">home</a>
                    <?php if(isset($isLoggedIn)&&$isLoggedIn) {?>
                        <a href="<?php echo base_url(); ?>catalogue" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold">catalogue</a>

                        <?php if(isset($role)&&$role==1) {?>
                            <a href="<?php echo base_url(); ?>admin/dashboard" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold">admin dashboard</a>
                        <?php } else {?>
                            <a href="<?php echo base_url(); ?>profile" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold"><?php echo $username; ?></a>
                        <?php } ?>

                        <a href="<?php echo base_url(); ?>auth/logout" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold">logout</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url(); ?>auth/join" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold" >join</a>
                        <a href="<?php echo base_url(); ?>auth/register" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold">register</a>
                        <a href="<?php echo base_url(); ?>auth/login" class="nav-item nav-link font-color-light-blue text-center pl-4 font-weight-bold">login</a>
                    <?php }?>
                </div>            
            </div>
        </nav>
    </div>
    
 
        

    

    