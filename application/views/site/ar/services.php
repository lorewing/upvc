<div class="kopa-breadcrumb">
        <div class="wrapper">
            <div class="pull-right">
                <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                    <a itemprop="url" class="current-page">
                        <span itemprop="title">منتجاتنا والاسعار</span>
                    </a>
                </span>
               &nbsp;&rsaquo;&nbsp;
                <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                    <a itemprop="url" href="<?php echo base_url(); ?>" >
                        <span itemprop="title">الرئيسية</span>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <div id="main-content">

        <section class="kopa-area kopa-area-0">

            <div class="wrapper">

                <div class="row">
                
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="widget kopa-service-4-widget">
                            <ul class="clearfix">
                                
                        <?php 
                            $section_type = 'products';
                            $limit = 20;
                            $query = $this->db->order_by('view_order','asc')->get_where('post_section',array('section_type'=>$section_type,'active'=>TRUE));
                            foreach($query->result() as $row) {
                        ?>  
                                <li class="col-md-3 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-duration="0.4s" data-wow-delay="0.7s">
                                    <article class="entry-item">
                         <a href="<?= base_url('news/news-detalis/');?>/<?php echo str_replace(' ', '-', $row->section_name_ar);?>/<?php echo $row->section_id;?>"><img src="<?php echo base_url(); ?>private/post/<?php echo $row->section_cover_thumb ;?>" alt="<?php echo $row->section_name_ar; ?>"></a>

                                        </a>
                                        <div class="entry-content">
                                            <h4 class=""><a href="win.html"><?php echo $row->section_name_ar; ?></a></h4>
                                            <p><?php echo $row->section_desc_ar; ?></p> 
                                            <a href="win.html" class="more-link style2">المزيد</a>
                                        </div>
                                    </article>
                                </li>
                              <?php  } ?> ;      
                            </ul>
                        </div>
                        <!-- widget --> 
                
                    </div>
                    <!-- col-md-12 -->
                
                </div>
                <!-- row --> 
            
            </div>
            <!-- wrapper -->
            
        </section>
        <!-- kopa-area-0 -->