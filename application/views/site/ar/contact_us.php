<div class="kopa-breadcrumb">
        <div class="wrapper">
            <div class="pull-right">
                <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                    <a itemprop="url" class="current-page">
                        <span itemprop="title">أتصل بنا</span>
                    </a>
                </span>
               &nbsp;&rsaquo;&nbsp;
                <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                    <a itemprop="url" href="#" >
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

                    <div class="kopa-main-col col-md-12 col-sm-12 col-xs-12">

                         <div class="kopa-map-wrapper mb-50">
                            <div id="kopa-map" class="kopa-map" data-place="BLACKCAT" data-latitude="25.2418714" data-longitude="51.4575456"></div>
                        </div>
                
                            </div>

                        </div>
                <!-- row --> 

                <div class="row">

                    <div class="col-md-7 col-sm-7 col-xs-12">

                        <div class="widget kopa-contact-info-2-widget">
                            <h3 class="widget-title style5">أتصل بنا</h3>
                            <p>لدينا فريق دعم متاح لمساعدتك على مدار 24 ساعة في اليوم، سبعة أيام في الأسبوع. ونحن نتطلع الى الاستماع منك ومساعدتك!.</p>
                            <ul class="clearfix">
                                <li>
                                    <p><span class="fa fa-envelope-o"></span>Email: <a href="mailto:info@majestic-did.com">info@upvc.com</a></p>
                                </li>
                                <li>
                                    <p><span class="fa fa-phone"></span>هاتف: (+974) 4432-0036</p>
                                </li>
                                <li>
                                    <p><span class="fa fa-fax"></span>فاكس: (+974) 4435-3319</p>
                                </li>
                                <li>
                                    <p><span class="fa fa-map-marker"></span>العنوان: ص.ب 1642 الدوحة, قطر</p>
                                </li>
                            </ul>
                        </div>
                        <!-- widget -->
                
                    </div>
                    <!-- col-md-7 -->
                
                    <div class="col-md-5 col-sm-5 col-xs-12">

                        <div class="widget widget_text">

                            <div class="contact-box">
                                     <?php 
					$attributes = array('class' => 'contact-form clearfix');
					
					echo form_open('contact_us',$attributes);
						
						 echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
					?> 
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="input-block">
                                                <?php echo form_input(array('name' => 'name', 'id' => 'name', 'placeholder' => 'الأسم', 'value' => set_value('name'))); ?>

                                                <span class="fa fa-user"></span>
                                            </p>
                                        </div>
                                        <!-- col-md-12 -->
                                        
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="input-block">
                                     <?php echo form_input(array('name' => 'phone', 'id' => 'phone', 'placeholder' => 'رقم الهاتف', 'value' => set_value('phone'))); ?>

                                                <span class="fa fa-user"></span>
                                            </p>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="input-block">
                                                <?php echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'البريد الإلكترونى', 'value' => set_value('email'))); ?>

                                                <span class="fa fa-envelope"></span>
                                            </p>
                                        </div>
                                        <!-- col-md-12 -->
                                    
                                    </div>
                                    <!-- row --> 
                                    <p class="textarea-block">  
                                         <?php echo form_textarea(array('name' => 'message', 'id' => 'message', 'placeholder' => 'رسالتك', 'value' => set_value('message'))); ?>

                                    </p>
                                    <p class="contact-button clearfix"> 
                                        <div class="g-recaptcha" data-sitekey="6LeUxSETAAAAADl1Q9Te8uYp097JU6hLA2hOg_V1"></div>           

                                         <?php
							
						echo form_submit(array('name' => 'submit','id' => 'submit', 'value' => 'Send', 'class' => 'contact-button animated'));
						
						echo form_close();
						
						?>
                                    </p>
                                </form>
                                <div id="response"></div>
                            </div>
                            <!-- contact-box -->

                        </div>
                        <!-- widget --> 
                
                    </div>
                    <!-- col-md-5 -->
                
                </div>
                <!-- row --> 
            
            </div>
            <!-- wrapper -->
            
        </section>
        <!-- kopa-area-0 -->