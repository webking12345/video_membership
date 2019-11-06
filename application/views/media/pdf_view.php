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
                            echo '<div class="col-sm-6 mb-2">
                                        <a href="'.base_url().'catalogue"><button type="button" class="'. ($theme ? "brightly-btn" : "dark-purple-button") .'"> <i class="fa fa-backward"></i> back to catalogue</button></a>
                                    </div>';
                        }
                ?>
                <iframe id="player" class="pdf-viewer-container" src="<?php echo $pdf_url; ?>#toolbar=0&navpanes=0&scrollbar=0" style="height"></iframe>
                <div class="row mt-2">
                    <?php 
                        if($view == "contents"){
                            echo '<div class="col-sm-12">
                                        <a href="'.base_url().'catalogue/details/'.$id.'"><button type="button" class="'. ($theme ? "brightly-btn" : "dark-purple-button").'"><i class="fa fa-backward"></i> back to details </button></a>
                                    </div>';
                        }else{
                            echo '<div class="col-sm-6">
                                    <a href="javascript:history.back()"><button type="button" class="'. ($theme ? "brightly-btn" : "dark-purple-button") .'"> <i class="fa fa-backward"></i> back</button></a>
                                </div>';
                        }
                    ?>
                </div>
            </div>
        </section>
    </div>
    

    