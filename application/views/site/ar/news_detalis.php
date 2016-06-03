<?php foreach($rows as $row) : ?>

                    	  <?php 
								{
									$post_id 				= $row->post_id;
									$section_id 				= $row->section_id;
									$title_en 			= $row->title_en;
									$title_ar 				= $row->title_ar;
									$desc_en			= $row->desc_en;
									$desc_ar			= $row->desc_ar;
									$created_date			= $row->created_date;
									$count_view				= $row->count_view;
									$related_tag 		= $row->related_tag;
									$alt_desc	= $row->alt_desc;
									$image_name			= $row->image_name;
									$image_thumb			= $row->image_thumb;
								} ?>
                    	  
                    	  <?php endforeach; ?>  
<!-- kopa-page-header -->

    <div class="kopa-breadcrumb">
        <div class="wrapper">
           
            <div class="pull-right">
                <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                    <a itemprop="url" class="current-page">
                        <span itemprop="title">من نحن </span>
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

        <section class="kopa-area kopa-area-0"><!-- wrapper -->
            
        </section>
        <!-- kopa-area-0 -->

        <div class="wrapper">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="widget kopa-mission-carousel-widget">
                <div class="owl-carousel owl-carousel-7">
                  <div class="item">
                      <div class="entry-thumb"> <img class="img-rounded pull-left" src="<?php echo base_url(); ?>private/post/<?php echo $row->image_name ;?>" width="535" height="329" alt="<?php echo $row->title_ar; ?>"> </div>
                  </div>
               
                </div>
              </div>
              <!-- widget -->
            </div>
            <!-- col-md-6 -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="widget widget_text">
                <h3 class="widget-title style5"><?php echo $title_ar ?></h3>
                <p class="mb-20"><?php echo $desc_ar ?></p>
              </div>
              <!-- widget -->
            </div>
            <!-- col-md-6 -->
          </div>
          <!-- row -->
        </div>
       