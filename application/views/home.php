<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
    <div class="main">
        <!-- main start -->
        <section id="categories" class="categories">     
            <!-- category start -->
            <div class="container">
                <div class="row mt-4">
                    <div class="col-sm-12 header-quote ">
                        <h1 class="title font-color-light-blue mb-0 mt-0">
                            Welcome to Lifestyle
                        </h1>
                        <div class="content text-secondary ft-16">
                            Lifestyle is dedicated to bringing inspirational stories to light,<br>using the power of video and the internet to multiply acts of kindness, beauty, and generosity.
                        </div>
                    </div>
                </div>
                <div class="row category mt-4">
                    <div class="col-sm-12">
                        <ul id="mobile-category">
                            <?php 
                                if($all_category){
                                    $str = '';
                                    $t = $theme ? "brightly-btn" : "dark-purple-button";
                                    foreach($all_category as $row){
                                            $str .= '<li>';
                                            // $str .='<a href="#video" data-easing="easeInQuad"><button data-type="video-cat" class="parent-category dark-purple-button" ';
                                            $str .='<a  data-easing="easeInQuad"><button data-type="video-cat" class="parent-category '.$t.'" ';
                                            $str .=' data-id="'.$row->id.'"';
                                            $str .=' data-class="'.$row->class.'" ';
                                            $str .=' data-src="'.$row->video_url.'" ';
                                            $str .=' data-poster="'.$row->thumb_url.'" >';
                                            $str .= $row->name.'</button></a>';
                                            $str .= '</li>';
                                    }
                                    echo $str;
                                }
                            ?>                                
                        </ul>
                    </div>
                </div>
            </div>
        </section>
            <!-- categroy end -->
        <section id="video">
            <!-- intro video start -->
            <div class="container" style="margin-top:35px">
                <div class="video-container">
                    <video controls crossorigin playsinline poster="<?php echo base_url() ?>public/images/video-thumbnail/Welcome_HD.jpg">
                        <source src="https://www.radiantmediaplayer.com/media/bbb-360p.mp4" type="video/mp4" width="640" height="380" >            
                    </video>    
                </div>
            </div>
        </section>
    </div>
    

    