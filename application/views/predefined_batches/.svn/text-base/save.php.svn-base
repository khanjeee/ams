<?php //d($aBatchDetails); ?>
<link rel="stylesheet" href="<?php echo getAssetsPath(); ?>css/angular/ng-tags-input.min.css" />
<script data-require="angular.js@1.2.x" src="<?php echo getAssetsPath(); ?>js/angular/angular.js" data-semver="1.2.15"></script>
<script src="<?php echo getAssetsPath(); ?>js/angular/ng-tags-input.min.js"></script>
<!--ajax file upload libraries -->
<script src="<?php echo getAssetsPath(); ?>js/JSAjaxFileUploader.js"></script>
<link   href="<?php echo getAssetsPath().'css/JQuery.JSAjaxFileUploader.css'; ?>" rel="stylesheet" type="text/css" />
<!--ajax file upload libraries -->
<script>
    
(function(){    
var app = angular.module('ams', ['ngTagsInput']);

app.controller('MainCtrl',function(tags,$scope,$http,$compile,$parse)
{
  /*angular validation variables*/
  
  $scope.batch_list         = '';
  $scope.campaign_id        = <?php echo $aBatchDetails['predefined_campaign_batch_id']; ?>;
  $scope.batch_id           = 0;
  $scope.predefined_campaign_batch_id      = <?php echo $aBatchDetails['predefined_campaign_id']; ?>;
  
  $scope.selected_template_id = <?php echo $aBatchDetails['template_id']; ?>;
  $scope.selected_product_id = <?php echo $aBatchDetails['product_id']; ?>;
  $scope.schedule_date      = '';
  $scope.schedule_time      = '';
  $scope.image_preview_html = '';
  $scope.template_cuttoff_period = 0; 
  
  
  
  /*angular validation variables*/
  $scope.error_batch_lists    = false;
  $scope.error_campaign_id    = false;
  $scope.error_template_id    = false;
  $scope.error_product_id     = false;
  $scope.error_schedule_date  = false;
  
  
  $scope.error_upload_content = [];
  
  $scope.previous_button    = false;
  $scope.next_button        = true;
  $scope.finish_button       = false;
  
  //$scope.element_value      = '';
  $scope.element_array      =  [];
  
  $scope.active_tab = 1;
  $scope.aProducts  = [];
  $scope.aProducts  = <?php echo empty($aProducts)? '[]' : $aProducts ; ?>;
  
  
  /*data recieved from ajax for productTempaltes is saved in this var*/
  $scope.htmlProductTemplate = false;
  
  /*data received from ajax for Upload Content*/
  $scope.htmlUploadContent   = false;
  
  /*data received from ajax for Sumamry tab*/
  $scope.htmlSummaryContent   = false;
  
  
  $scope.setActiveTab = function(selected_tab) 
    {   
      $scope.active_tab = selected_tab;
    }
   
   $scope.previous_tab = function ()
    {
        
       $scope.active_tab = $scope.active_tab - 1; 
       //hiding showing previous next  and finish buttons
       $scope.previous_button   = ($scope.active_tab == 1) ? false : true ; 
       $scope.next_button   = ($scope.active_tab == 6) ? false : true ; 
       $scope.finish_button = ($scope.active_tab == 6) ? true : false ;
       
       
    }

     
    $scope.addClass = function(someValue)
    {
        if($scope.active_tab==someValue)   
            return "active";
        else                               
            return "";
    }
  
    
      
    $scope.loadTags = function(query) 
    {
      return tags.load();
    };
    
    $scope.loading = function(bool)
    {
        if(bool == true )
        {
            $('.main-div').addClass('show-loading');
        }
        else if(bool == false)
        {
            $('.main-div').removeClass('show-loading');
        }
    }
    
    
    $scope.setElementDetails = function(element_value,element_name,element_id,position_id,fold_id,index) 
    {
     //string appended because without it all indexs less then the position passed are created     
     
     $scope.obj = {};
     $scope.index = parseInt(index);
          
     $scope.obj.element_data                = element_value;
     //obj.element_name                     = element_name;
     $scope.obj.template_element_id         = element_id;
     $scope.obj.template_fold_id            = fold_id;
     $scope.obj.element_position            = position_id;
     $scope.obj.template_id                 = $scope.selected_template_id;
     $scope.obj.campaign_batch_id           = $scope.batch_id;
      
     //$scope.element_array.splice(index,1, obj); 
     $scope.element_array[$scope.index]= $scope.obj ;
     //console.log($scope.element_array);
     
    
     
      
    };
    
    
   
    //called when the next button is clicked
    $scope.submit_form = function(selected_tab) 
    {
     
        
  
        /*step 1     
        * Called when Create tab is selected
        * */

         //client side validation

         $scope.batch_list = $('#batch_list').val();
         if(selected_tab==1)
         {       
                
                $scope.error_batch_lists= false;
                $scope.error_campaign_id  = false;

                 if($scope.batch_list.length <= 2)
                         {
                             $scope.error_batch_lists = true;
                         }
                  if($scope.campaign_id == 0)
                         {
                             $scope.error_campaign_id = true;
                         }  

                  //return false if any of the validation fails   
                  if($scope.error_batch_lists || $scope.error_campaign_id )
                         {
                          return false;
                         }

       
             //making ajax call only if validations are passed
             var request = 
             {
                 method: 'POST',
                 url:    '<?php echo $sFormAction; ?>',
                 data:   {
                            method:'createUserBatch',
                            predefined_campaign_id:''+$scope.campaign_id,
                            list:$scope.batch_list,
                            user_batch_id:$scope.batch_id,
                            template_id:$scope.selected_template_id,
                            predefined_campaign_batch_id:$scope.predefined_campaign_batch_id,
                            user_id:'<?php echo $aUserInfo->user_id; ?>'
                        }
              };
              
              
             //ajax call for creating batch 
             ajax_call(request,selected_tab);
         }

         
         /*step 2     
        * Called when Upload Content tab is selected
        * */  
         else if (selected_tab==2)
         {
             if ($(".test_check").hasClass("custom_upload"))
             {
                alert("Please upload a file.");
                return false;
             }
         
         //console.log($scope.element_array); return;   
         //making ajax call only if validations are passed
            var models = document.getElementsByClassName("custom-elements");
            
            //nulling the validation array error_upload_content
            $scope.error_upload_content = [];
            
            
            angular.forEach(models, function(value,key) 
                {   
                    //client side validation for empty fileds on upload content
                    var val_ng_model = value.attributes['ng-model'].value;       
                   // console.log($scope[val_ng_model]);  
                    
                    //true if model is undefiend or empty
                    if(angular.isUndefined($scope[val_ng_model]) || angular.equals($scope[val_ng_model],'') )
                            {
                                //making error_{model} true to show validation errors
                                $scope['error_'+val_ng_model] = true ;
                                //pushing random item in array to check validation on the basis of array
                                $scope.error_upload_content.push(1);
                                //console.log( $scope[val_ng_model]);
                            }
                   else     {
                                //making error_{model} false to remove validation error
                                $scope['error_'+val_ng_model] = false ;
                                //console.log( $scope[val_ng_model]);
                            }    
                       

                },$scope);
            
            
            //validation succedes if length of array is 0 else fails
            if($scope.error_upload_content.length > 0  )
                {
                    return;
                }
            
            
             var request = 
             {
                 method: 'POST',
                 url:    '<?php echo $sFormAction; ?>',
                 data:   {method:'setBatchElementsData',fold_elements_data:$scope.element_array,meta_field:true}
              };
              
              
             //ajax call for creating batch 
             ajax_call(request,selected_tab);
            //console.log(selected_tab);   

         } 
         
         
         /*step 4     
        * Called when Scheduling a batch
        * */  
         else if (selected_tab==3)
         {
           $scope.active_tab = 4;     

         }
         
         /*step 5     
        * Called when Scheduling a batch
        * */  
         else if (selected_tab==4)
         {
                $scope.error_schedule_date = false; 
                
                 if(angular.equals($scope.schedule_date,'') || angular.isUndefined($scope.schedule_date) )
                         {
                             $scope.error_schedule_date = true;
                             return false;
                         }

                  
             var request = 
             {
                 method: 'POST',
                 url:    '<?php echo $sFormAction; ?>',
                 data:   {method:'ScheduleBatch',campaign_batch_id:$scope.batch_id,schedule_date:$scope.schedule_date,schedule_time:$scope.schedule_time}
              };
              
              
             //ajax call for creating batch 
             ajax_call(request,selected_tab);
            //console.log(selected_tab);   

         } 
    };

/*@params:request and tab no
* @desc:  request is the json object to be posted*/        
function ajax_call(request,selected_tab)
    {
     //show loading 
     $scope.loading(true);   
     
       $http(request).
       success(function(data, status, headers, config) {
          if(data)
              {
                    //hide loading 
                    $scope.loading(false);
             
                        if(selected_tab == 1)
                            {
                             if(angular.equals(data.status,true))
                                { 
                                   
                                    
                                    $scope.active_tab  = (isNaN(data.tab)) ? $scope.active_tab : 2;
                                    $scope.batch_id    = data.batch_id;
                                    $scope.error_batch_lists  = false;
                                    $scope.error_campaign_id  = false;
                                    $scope.previous_button    = true;
                                    
                                    //ipload content html
                                    var unSerializedJson = angular.fromJson(data.hUploadContentHTML);
                                        //compling the html for angular
                                        $scope.htmlUploadContent = $compile(unSerializedJson)($scope);
                                        $scope.template_cuttoff_period = data.cuttOffPeriod;
                                        console.log(data);
                                 }
                             else
                                 {
                                  //showing error messages if received
                                    if(angular.isArray(data.message))
                                        {
                                                   angular.forEach(data.message, function(item) 
                                                    {       

                                                           if(angular.equals(item,'<?php echo ERROR_CAMPAIGN_ID_REQUIRED; ?>'))
                                                                {
                                                                    $scope.error_campaign_id = true;
                                                                }

                                                            //batch lists validation
                                                            if(angular.equals(item,'<?php echo ERROR_CAMPAIGN_LIST_REQUIRED; ?>'))
                                                                {
                                                                    $scope.error_batch_lists = true;
                                                                }

                                                        //console.log(item);


                                                    }); 
                                         }   
                                 }
                            }
                  
                  else if(selected_tab == 2)
                            {
                                
                                if(angular.equals(data.status,true))
                                    {
                                        $scope.active_tab  = (isNaN(data.tab)) ? $scope.active_tab : 3;
                                        //unserializing the json to get proper html
                                        var unSerializedJsonHtml = angular.fromJson(data.preview_url);
                                        //compling the html for angular
                                        $scope.image_preview_html = $compile(unSerializedJsonHtml)($scope);
                                        //console.log($scope);
                                        //console.log(data.preview_url[1]);
                                        //document.getElementById("previewImage").src = data.preview_url;
                                        //console.log(data.preview_url);
                                    }
                                //display error message    
                                else
                                    {
                                        console.log(data.message);
                                    }    
                                //compling is necessary for binding ajax data's Angular attributes to current scope
                                
                            
                            }
                  else if(selected_tab == 3)
                            {
                                
                                 //html reveived for upload content tab in {hUploadContentHTML} object
                                //checking status
                                if(angular.equals(data.status,true))
                                    {
                                        $scope.active_tab  = (isNaN(data.tab)) ? $scope.active_tab : data.tab;
                                         //disabling next button on last tab
                                        $scope.next_button   = ($scope.active_tab == 6) ? false : true ; 
                                        //showing finish button 
                                        $scope.finish_button = ($scope.active_tab == 6) ? true : false ; 
                                        
                                        //unserializing the json to get proper html
                                        var unSerializedJson = angular.fromJson(data.hSummary);
                                        //compling the html for angular
                                        $scope.htmlSummaryContent = $compile(unSerializedJson)($scope);
                                        $scope.error_schedule_date = false;

                                    }
                                else{
                                        //console.log(data.message);
                                        $scope.error_schedule_date = true;
                                    }  
                                
                            
                            }          
                  
              }

       }).
       error(function(data, status, headers, config) {
                    //hide loading 
                    $scope.loading(false);
                    console.log('error making request for step '+selected_tab);    

       }); 
         
    }
    
    
    
    

});



//defining productTemplate directive
app.directive("uploadContent",function($compile){
    return {
    
        link: function (scope, iElement, iAttrs) {
			
			scope.$watch('htmlUploadContent', function() {
						
						iElement.html('');
						iElement.append(scope.htmlUploadContent);
			});
			
           

        }
    
    }
});


//defining productTemplate directive
app.directive("imagePreview",function($compile){
    return {
    
        link: function (scope, iElement, iAttrs) {
			
			scope.$watch('image_preview_html', function() {
						
						iElement.html('');
						iElement.append(scope.image_preview_html);
			});
			
           

        }
    
    }
});



//defining productTemplate directive
app.directive("summary",function($compile){
    return {
    
        link: function (scope, iElement, iAttrs) {
			
			scope.$watch('htmlSummaryContent', function() {
						
						iElement.html('');
						iElement.append(scope.htmlSummaryContent);
                                                
			});
			
          
        }
    
    }
});



//angular service for tagging lists 
app.service('tags', function($q) {
    
  <?php   $tags = ($aLists) ? json_encode($aLists)  : "[]" ; ?>
  var tags = <?php echo $tags; ?>;
  
  this.load = function() {
    var deferred = $q.defer();
    deferred.resolve(tags);
    return deferred.promise;
  };
});
    

 })();
 
 

 
 
</script>


<!--javacript custom-->
<?php //echo $custom_js;  ?>

<div class="m-t-20" id="create-batch" ng-app="ams">

    <h2 class="heading-sty-2">Add a <?php echo BATCH; ?></h2>

















    <!--- Umair -->

    <?php
    //d($aBatchDetails);

    /*<div class="c-box">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Campaign: </label>
                    <p><?php echo $aWhiteLabelCampaignData['campaign_title']; */?><!--</p>
</div>
<div class="form-group">
    <label>Description: </label>
    <p><?php /*echo $aWhiteLabelCampaignData['campaign_description']; */?></p>
</div>
<div class="form-group">
    <label>Product: </label>
    <p><?php /*echo $aWhiteLabelCampaignData['product_title']; */?></p>
</div>
<div class="form-group">
    <label>Template: </label>
    <p><?php /*echo $aWhiteLabelCampaignData['template_title']; */?></p>
</div>
</div>
</div>
</div>-->



    <!--- Umair -->












    
    <div  class="row" ng-controller="MainCtrl">
        <div class="col-md-12 main-div">
            <div class="" id="">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm c-nav-tabs">
                    <li ng-class="addClass('1')" >
                        <a><span>CREATE</span></a>
                    </li>
                    <li  ng-class="addClass('2')">
                        <a ><span>UPLOAD CONTENT</span></a>
                    </li>
                    <li  ng-class="addClass('3')">
                        <a ><span>PREVIEW</span></a>
                    </li>
                    <li  ng-class="addClass('4')">
                        <a ><span>SUMMARY</span></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
<!-- tab 1 Create Batch start-->
                    <div id="tab1" ng-class="addClass('1')" class="tab-pane padding-20  m-p-l-r-0 slide-left">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div ng-class="{ 'has-error':error_batch_lists }" class="form-group">
                                    <label for="batch-list" class="batch-list">Choose a List to Schedule a Batch:</label>
                                    <tags-input ng-model="tags" 
                                                add-from-autocomplete-only="true" 
                                                add-on-enter="true" 
                                                add-on-space="false" 
                                                add-on-comma="false"
                                                placeholder="Add a List">
                                        <auto-complete source="loadTags($query)" 
                                                       min-length="1" 
                                                       highlight-matched-text="true"
                                                        >
                                        </auto-complete>
                                    </tags-input>
                                    <input id="batch_list" type="hidden" name="lists" value="{{tags}}">
                                    <label ng-show="error_batch_lists"  class="error m-t-10 error-static">Batch List is Required !</label>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
<!-- tab 1 Create Batch end-->
                    
<!-- tab 2 upload content start-->
                    <div upload-content id="tab3" ng-class="addClass('2')" class="tab-pane padding-20  m-p-l-r-0 slide-left">
                        
                    </div>
<!-- tab 2 upload content end-->
                    

<!-- tab 3 Preview start-->
                    
                    <div id="tab5" ng-class="addClass('3')" class="tab-pane padding-20  m-p-l-r-0 slide-left">
<!--                     imagePreview Directive   -->
                    <div image-preview class='row'></div>       
                        
                    </div>      

<!-- tab 3 Preview End-->



<!-- tab 4 Summary start-->                    
                    <div summary id="tab5" ng-class="addClass('4')" class="tab-pane padding-20  m-p-l-r-0 slide-left"></div>
                    
<!-- tab 4 Summary end-->
                    
                    <div class="padding-20 bg-white m-p-l-r-0">
                        <ul class="pager wizard">
                            <li ng-show="next_button" class="next">
                                <button ng-click="submit_form(active_tab)" type="button" class="btn btn-complete btn-cons btn-animated fa pull-right m-m-b-10">
                                    <span>Next</span>
                                </button>
                            </li>
                            <li ng-show="finish_button" class="next finish" >
                                <button onclick="location.href='<?php echo site_url('campaigns/view'); ?>'" type="button" class="btn btn-primary btn-cons from-left pull-right m-m-b-10">
                                    <span>Finish</span>
                                </button>
                            </li>
                            <li ng-show="previous_button" class="previous" ng-click="previous_tab()">
                                <button type="button" class="btn btn-default btn-cons pull-right m-m-b-10">
                                    <span>Previous</span>
                                </button>
                            </li>
                            <li class="previous first finish_button hidden" >
                                <button type="button" class="btn btn-default btn-cons btn-animated from-left fa fa-cog pull-right m-m-b-10">
                                    <span>First</span>
                                </button>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>