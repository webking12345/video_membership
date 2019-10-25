<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
    <div class="main">
        <div class="row mt-3">
            <div class="col-sm-12 header-quote ">
                <h1 class="title font-color-light-blue mb-0 mt-0">
                    view
                </h1>
            </div>
        </div>
        <!-- main start -->
        <section id="video">
            <!-- intro video start -->
            <div class="container" style="margin-top:20px;max-width: 1024px;">
                <?php 
                        if($view == "contents"){
                            echo '<div class="col-sm-6 mb-3">
                                        <a href="'.base_url().'catalogue"><button type="button" class="'. ($theme ? "brightly-btn" : "dark-purple-button") .'"> <i class="fa fa-backward"></i> back to catalogue</button></a>
                                    </div>';
                        }
                ?>
                <?php if(!$is_youtube) { ?>
                    <video controls crossorigin playsinline poster="<?php echo $thumb_url; ?>" class="player-container" style="visibility:hidden">
                        <source src="<?php echo $video_url; ?>" type="video/mp4">            
                    </video>
                <?php } else { ?>
                    <iframe src="<?php echo $video_url; ?>" class="player-container" frameborder="0"></iframe>
                <?php } ?>

                <div class="row mt-3">
                    <?php 
                        if($view == "contents"){
                            echo '<div class="col-sm-12 mt-3">
                                        <a href="'.base_url().'catalogue/details/'.$id.'"><button type="button" class="'. ($theme ? "brightly-btn" : "dark-purple-button").'"><i class="fa fa-backward"></i> back to details </button></a>
                                    </div>';
                        }else{
                            echo '<div class="col-sm-6 mt-3">
                                    <a href="javascript:history.back()"><button type="button" class="'. ($theme ? "brightly-btn" : "dark-purple-button") .'"> <i class="fa fa-backward"></i> back</button></a>
                                </div>';
                        }
                    ?>
                </div>
            </div>
        </section>
    </div>
    

    