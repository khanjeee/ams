<div class="c-box">
	<div class="row">
		<div class="col-md-12">
        
          <!-- ============================ -->
          <!-- Editable Content -->
		  
		  
		  <?php  if(is_array($aWhiteLabelInfo) && !empty($aWhiteLabelInfo)) : 
			  
				$DeleteUrl  =   site_url('whitelabel/deletecompany/'.$aWhiteLabelInfo['whitelabel_id']); 
		 	   $EditUrl    =   site_url('whitelabel/create/'.$aWhiteLabelInfo['whitelabel_id']); ?>
			   
		
          <div class="editable" id="edit-section-9">
            <h1 class="heading-sty-1 m-t-0"><?php echo (isset($aWhiteLabelInfo['title'])) ? $aWhiteLabelInfo['title'] : NOT_AVAILABLE  ; ?>
              <ul class="actions-sty-1 t-col text-right no-line-break">
                <li><a data-target="edit-section-9" class="fa edit" href="<?php echo $EditUrl; ?>"></a></li>
                <li><a class="fa delete" onclick="return confirmDelete('delete_campaign','<?php echo $DeleteUrl; ?>');" href="javascript:void(0)"></a></li>
              </ul>
            </h1>
            <p><span class="camp_desc_9"><?php echo (isset($aWhiteLabelInfo['description'])) ? $aWhiteLabelInfo['description'] : NOT_AVAILABLE  ; ?></span></p>
          </div>
					
                    
              
          

        <hr>

	        <!-- START PANEL -->
            <div class="panel panel-transparent m-b-0">
              <!-- <div class="panel-heading p-l-0 p-r-0">
                <div class="clearfix">
                  
                  <div class="fr m-fn">
                    <a href="<?php echo site_url('whitelabel/create'); ?>" class="btn btn-complete btn-cons hidden-sm hidden-xs">Add New <?php echo WHITE_LABEL_SINGULAR; ?></a>
                  </div>
                </div>
              </div> -->
              
				
				<div class="panel-body p-0">

                    
                    <div class="accordion skin-1">
                      
                        
                    <!--Row-->
                   


                        <div class="accordion-body active" style="display: block;">
                            <div class="row">
           	<div class="col-md-4">

           		<div class="c-box text-center m-b-20">
           			<img width="220" src="<?php echo site_url(COMPANY_LOGO_PATH.$aWhiteLabelInfo['logo']); ?>">
					<div><strong class="title">Company Logo</strong></div>
           		</div>
                                    
	           	<!-- <div class="template-preview owl-carousel owl-theme owl-loaded">
	           		                                                                                            
	           					 	<div class="owl-stage-outer">
	           							<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 648px;">
	           								<div class="owl-item" style="width: 324px; margin-right: 0px;">
	           									<div class="template-preview__item">					
	           									<?php  if($aWhiteLabelInfo['logo']): ?>
	           									 <img width="150" src="<?php echo site_url(COMPANY_LOGO_PATH.$aWhiteLabelInfo['logo']); ?>">
	           									   <div class="title">Company Logo</div>
	           									   <?php else :?>
	           									   <img width="150" src="<?php echo site_url(DEFAULT_COMPANY_LOGO_PATH); ?>">
	           									   <div class="title">Logo not updated</div>
	           									   <?php endif; ?>
	           									</div>
	           								</div>
	           							</div>
	           						</div>
	           	
	           					</div> -->
            </div>
                                <div class="col-md-8">
									
									
									<div class="form-group">
										<label>Email: </label>
                                        <p><?php echo (isset($aWhiteLabelInfo['email_address'])) ? $aWhiteLabelInfo['email_address'] : NOT_AVAILABLE  ; ?></p>
                                    </div>
									
										<div class="form-group">
                                    <label>Promotion Code: </label>
                                    <p><?php echo (isset($aWhiteLabelInfo['promotion_code'])) ? $aWhiteLabelInfo['promotion_code'] : NOT_AVAILABLE  ; ?></p>
									</div>
									<div class="form-group">
										<label>Selected Theme: </label>
                                        <p>
                                            <?php

                                            if(isset($aWhiteLabelInfo['selected_theme']) and $aWhiteLabelInfo['selected_theme'])
                                            {
                                                $aColors = json_decode($aWhiteLabelInfo['selected_theme']);

                                                ?>
            <div class="c-display-color">
              <div class="c-display-color__color" style="background-color:<?php echo $aColors->logo_background; ?>"></div>
              <div class="c-display-color__txt">Logo Background</div>
            </div>

            <div class="c-display-color">
              <div class="c-display-color__color" style="background-color:<?php echo $aColors->menu_color; ?>"></div>
              <div class="c-display-color__txt">Menu Color</div>
            </div>

            <div class="c-display-color">
              <div class="c-display-color__color" style="background-color:<?php echo $aColors->theme_primary_color; ?>"></div>
              <div class="c-display-color__txt">Theme Primary Color</div>
            </div>

            <div class="c-display-color">
              <div class="c-display-color__color" style="background-color:<?php echo $aColors->theme_secondary_color; ?>"></div>
              <div class="c-display-color__txt">Theme Secondary Color</div>
            </div>

                                        <?php

                                            }
                                            else
                                            {
                                                echo NOT_AVAILABLE;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label>Solution Type: </label>
                                        <p><?php echo getSolutionType($aWhiteLabelInfo['solution_type']); ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Created Date: </label>
                                        <p><?php echo displayDate($aWhiteLabelInfo['created_on']); ?></p>
                                    </div>


                                    <div class="form-group">
                                        <label>Total Subscriber(s): </label>
                                        <p><?php echo $iTotalUsers; ?></p>
                                    </div>

                                   <!-- <div class="form-group">
                                        <label>Total Revenue: </label>
                                        <p><?php /*echo formatAmount($iTotalUsers); */?></p>
                                    </div>-->
                                    
                                    
                                 
                                </div>
                            </div>
                        </div>
				</div>

				

              </div>
            </div>
            <!-- END PANEL -->
			<?php   else : ?>
			   <p><?php echo MSG_NO_RECORD_FOUND; ?></p>
			<?php endif; ?>
		
		
		

		</div>
	</div>
</div>