<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
    <div class="main">
        <!-- main start -->
        <section id="categories" class="categories">     
            <!-- category start -->
            <div class="container">
                <div class="row mt-4">
                    <div class="col-sm-12 header-quote ">
                        <h1 class="welcome-title font-color-light-blue mb-0 mt-0">
                            Welcome to <?php echo isset($title) ? $title : '';?>
                        </h1>
                        <div class="content text-secondary ft-16 mt-3">
                            <?php echo isset($welcome_text) ? nl2br($welcome_text) : '' ; ?>
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
                                            $str .=' data-src="'.$intro[$row->id]['contents_url'].'" ';
                                            $str .=' data-poster="'.$intro[$row->id]['thumb_url'].'" >';
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
                <?php if(!$is_youtube) { ?>
                    <div class="video-container">
                        <video controls crossorigin playsinline poster="<?php echo $thumb_url; ?>" class="video-container" style="visibility:hidden">
                            <source src="<?php echo $video_url; ?>" type="video/mp4">            
                        </video>
                    </div>
                <?php } else { ?>
                    <iframe id="player" src="<?php echo $video_url; ?>"  class="video-container" frameborder="0" style="width:100%; height:auto; display:block"></iframe>
                <?php } ?>  
            </div>
        </section>
    </div>
    

    