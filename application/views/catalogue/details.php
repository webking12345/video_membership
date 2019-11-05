<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
    <div class="main">
        <!-- main start -->
        <section id="details" class="details">     
            <!-- deatails start -->
            <div class="container">
                <div class="row mt-4">
                    <div class="col-sm-12 header-quote ">
                        <h1 class="title font-color-light-blue mb-0 mt-0">
                            details
                        </h1>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-4 mb-3">
                        <div class="catalog-item"  style="height:170px; background: url('<?php echo substr($content->thumb_url,0,6)=="public"?base_url().$content->thumb_url:$content->thumb_url;?>') no-repeat; background-size:cover">
                            <!-- <div class="overlay">
                                <div class="background">
                                    <div class="thumb-title font-color-light-blue" >title</div>
                                    <div class="thumb-subject font-color-light-blue" >subject</div>
                                    <a href="<?php echo base_url(); ?>catalogue/details/1"><button type="button" class="detail-btn w-75 font-color-light-blue m-auto">view details</button></a>
                                </div>                                
                            </div>                             -->
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="font-color-light-blue row">
                            <span style="color:grey">title: </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="title content-title"><?php echo $content->title; ?></span>
                        </div>
                        <div class="font-color-light-blue row">
                            <span style="color:grey">subject: </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="subject"><?php echo $content->category_name; ?></span>
                        </div>
                        <div class="font-color-light-blue row" >
                            <span style="color:grey">format: </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span><?php echo $content->type==1 ? 'video' : 'pdf'; ?></span>
                        </div>
                        <div class="font-color-light-blue row" >
                            <span style="color:grey"><?php echo $content->type==1 ? 'duration:' : 'pages: &nbsp;&nbsp;&nbsp;'; ?> </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span><?php echo $content->duration; ?></span>
                        </div>
                        <div class="font-color-light-blue row">
                            <span style="color:grey">description: </span> &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="description"><?php echo $content->description; ?></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-4 mb-3">
                        <div class="">
                            <!-- type=video  : viewvideo, type=pdf : viewpdf -->
                            <a href="<?php echo base_url()."media/contents_view/".$content->id; ?>"  id="view">
                                <button type="button" class="<?php echo ($theme ? "brightly-btn" : "dark-purple-button"); ?> w-100" >view</button>
                            </a>
                        </div>
                        <!-- <div class="mt-4">
                            <a href="<?php echo base_url(); ?>auth/login">
                                <button type="button" class="<?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?> w-100" >login</button>
                            </a>
                        </div> -->
                        <?php if(!$is_member && !$is_purchased) {?>
                            <div class="mt-4">
                                <a href="<?php echo base_url(); ?>profile/join">
                                    <button type="button" class="<?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?> w-100">join us!</button>
                                </a>
                            </div>

                            <div class="mt-4">
                                <a href="#">
                                    <button id="pay2play" type="button" class="<?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?> w-100">pay2play @ $<?php echo $content->price; ?></button>
                                </a>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="col-sm-7 service ml-3 mr-3">
                        <div class="font-color-light-blue p-2">
                            <?php echo nl2br($content->description2); ?>
                        </div>
                        <div class=""></div>
                    </div>                    
                </div>
            </div>
        </section>
            <!-- details end -->
        <section id="similar-items">
            <div class="container">
                <?php if(count($similar_contents)>0) { ?>
                    <div class="row mt-4">
                        <div class="col-sm-12 font-color-light-blue">
                            <div>similar products</div>
                        </div>
                    </div>
                    <div class="row ml-2 mt-2">
                        <div class="owl-carousel owl-carousel-category">
                            <?php foreach ($similar_contents as $content) { ?>
                                <div class="item">
                                    <div class="catalog-item mr-2 ml-2" style="height:150px; background: url('<?php echo substr($content->thumb_url,0,6)=="public"?base_url().$content->thumb_url:$content->thumb_url;?>') no-repeat; background-size:cover" >
                                        <div class="overlay">
                                            <div class="background">
                                                <div class="font-color-light-blue pt-3"><?php echo $content->title; ?></div>
                                                <div class="font-color-light-blue" ><?php echo $content->category_name; ?></div>
                                                <a href="<?php echo base_url().'catalogue/details/'.$content->id; ?>"><div style="background-color:rgb(0,0,0,0)" class="w-75 font-color-light-blue m-auto <?php echo $theme?"brightly-btn" : "dark-purple-button";?>">view details</div></a>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>                    
                    </div>
                <?php }?>
                <div class="row mt-5">
                    <div class="col-sm-12">
                        <a href="<?php echo base_url(); ?>catalogue"><button type="button" class="<?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?>"> <i class='fa fa-backward'></i> back to catalogue</button></a>
                    </div>
                </div>                                
            </div>            
        </section>
    </div>
    <script>
        let is_member = '<?php echo $is_member; ?>'
        let is_purchased = '<?php echo $is_purchased; ?>'
        let content_id = '<?php echo $content->id; ?>'
        let content_title = '<?php echo $content->title; ?>'
        let content_price = '<?php echo $content->price; ?>'
    </script>
    

    