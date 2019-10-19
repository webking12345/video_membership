<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
    <div class="main">
        <!-- main start -->
        <section id="condition" class="condition">     
            <!-- condition start -->
            <div class="container">
                <div class="row mt-4">
                    <div class="col-sm-12 header-quote ">
                        <h1 class="title font-color-light-blue mb-0 mt-0">
                            catalogue
                        </h1>
                    </div>
                </div>
                <div class="row category">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="term" class="font-color-light-blue mb-0 font-color-gray">search term:</label>
                            <input type="text" class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control" id="term">
                        </div>
                    </div>
                </div>
                <div class="row condition">
                    <div class="col-sm-3">
                        <label for="content-title" class="font-color-light-blue mb-0 font-color-gray">title:</label>
                        <select id="content-title" name="title" class="condition-select browser-default custom-select <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?> ft-20">
                            <option value="0" selected>all</option>
                            <option value="a">a</option>
                            <option value="b">b</option>
                            <option value="c">c</option>
                            <option value="d">d</option>
                            <option value="e">e</option>
                            <option value="f">f</option>
                            <option value="g">g</option>
                            <option value="h">h</option>
                            <option value="i">i</option>
                            <option value="j">j</option>
                            <option value="k">k</option>
                            <option value="l">l</option>
                            <option value="m">m</option>
                            <option value="n">n</option>
                            <option value="o">o</option>
                            <option value="p">p</option>
                            <option value="q">q</option>
                            <option value="r">r</option>
                            <option value="s">s</option>
                            <option value="t">t</option>
                            <option value="u">u</option>
                            <option value="v">v</option>
                            <option value="w">w</option>
                            <option value="x">x</option>
                            <option value="y">y</option>
                            <option value="z">z</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="subject" class="font-color-light-blue mb-0 font-color-gray" >subject:</label>
                        <select id="subject" name="category_id" class="condition-select browser-default custom-select <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?> ft-20">
                            <option value="0" selected>all</option>
                            <?php 
                                foreach ($categories as $cate) {
                                    
                                    $str= '<option value="'.$cate->id.'">';

                                    for($i=1;$i<count(explode(".",$cate->class));$i++){
                                        $str.='&nbsp;&nbsp;&nbsp;';
                                    }
                                    
                                    $str.=$cate->name.'</option>';
                                    echo $str;
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="order" class="font-color-light-blue mb-0 font-color-gray" >order:</label>
                        <select id="order" name="order" class="condition-select browser-default custom-select <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?> ft-20">
                            <option value="0" selected>latest</option>                            
                            <option value="1" >oldest</option>
                            <option value="2" >alphabetical</option>                           
                            <option value="3" >video</option>                           
                            <option value="4" >pdf</option>                           
                            <option value="5" >size</option>                           
                            <option value="6" >duration</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="price" class="font-color-light-blue mb-0 font-color-gray">price:</label>
                        <select id="price" name="price" class="condition-select browser-default custom-select <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?> ft-20">
                            <option value="0" selected>all</option>
                            <option value="1">lowest</option>                            
                            <option value="2">highest</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12" align="center">
                        <div id="pagenation" style="display:inline-block"></div>                        
                    </div>                    
                </div>
            </div>
        </section>
            <!-- condition end -->
        <section id="catalog-items">
            <div class="container">
                <div class="row mt-4" id="contents" align="center">
                    <?php if(!count($contents)) {?>
                        <div class="col-lg-12 text-secondary">No Result.</div>
                    <?php } ?>

                    <?php foreach($contents as $content){ ?>
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="catalog-item" style="height:200px; background: url('<?php echo substr($content->thumb_url,0,6)=="public"?base_url().$content->thumb_url:$content->thumb_url;?>') no-repeat; background-size:cover">
                            <div class="overlay">
                                <div class="background">
                                    <div class="font-color-light-blue pt-5"><?php echo $content->title; ?></div>
                                    <div class="font-color-light-blue" ><?php echo $content->category_name; ?></div>
                                    <a href="<?php echo base_url().'catalogue/details/'.$content->id; ?>"><div style="background-color:rgb(0,0,0,0)" class="w-75 font-color-light-blue m-auto <?php echo $theme?"brightly-btn" : "dark-purple-button";?>">view details</div></a>
                                </div>                                
                            </div>                            
                        </div>
                    </div>
                    <?php } ?>
                </div>                                         
            </div>            
        </section>
    </div>
    <script>
        let pages=<?php echo $pages;?>
    </script>

    