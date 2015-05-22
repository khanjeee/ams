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
  $scope.batch_name         = '';
  $scope.batch_description  = '';
  $scope.batch_list         = '';
  $scope.campaign_id        = <?php echo $iCampaignId; ?>;
  $scope.schedule_date      = '';
  $scope.schedule_time      = '';
  $scope.image_preview_html = '';
  $scope.template_cuttoff_period = 0; 
  
  
  
  /*angular validation variables*/
  $scope.error_batch_name     = false;
  $scope.error_batch_desc     = false;
  $scope.error_batch_lists    = false;
  $scope.error_campaign_id    = false;
  $scope.error_template_id    = false;
  $scope.error_product_id     = false;
  $scope.error_schedule_date  = false;
  
  
  $scope.error_upload_content = [];
  
  $scope.previous_button    = false;
  $scope.next_button        = true;
  $scope.finish_button       = false;
  
  $scope.fold_default_images=  [];
  $scope.element_array      =  [];
  
  $scope.active_tab = 1;
  $scope.batch_id   = 0;
  $scope.aProducts  = [];
  $scope.aProducts  = <?php echo empty($aProducts)? '[]' : $aProducts ; ?>;
  $scope.selected_template_id = 0;
  $scope.selected_product_id = 0;
  
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
  
    $scope.getProductTemplate = function(productId)
    {
        //hiding the vaidation message 
        $scope.error_product_id = false;
        
        //reinitializing tempalte id before making ajax call to populate templates
        $scope.selected_product_id  = productId;
        $scope.selected_template_id = 0;
        
        var request = 
        {
           method: 'POST',
           url:    '<?php echo $sGetTempaltesUrl; ?>',
           data:   {call_from:'createCampaign',product_id:''+productId,method:'getTemplatesByProductId'}
        };
                       
        //ajax call for populationg tempaltes
        ajax_call(request,'populateTempaltes');
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
    
    
    // Watching if selected_template_id variable is changed
    $scope.$watch('selected_template_id', function() 
    {
       //empty element_array if template_id is changed 
	$scope.element_array = [];
        var models = document.getElementsByClassName("custom-elements");
                
        //setting all ng-model value to null on custon-elements when tempalte_id is changed
         angular.forEach(models, function(value,key) 
            {   
                   //getting model names to nullify their values
                   var val_ng_model = value.attributes['ng-model'].value;       //console.log(val_ng_model);  
                  
                  //setting null values to a model obtained in val_ng_model var
                  //$parse(val_ng_model).assign($scope, null);                    //console.log($parse(val_ng_model));
                  $scope[val_ng_model] = '';
                  
                  //removing previous validations 
                  $scope['error_'+val_ng_model] = false ;
                    
                  
            });
        
    });
    
    
     $scope.useDefaultImage =function (index,element,fold_id,element_id,image_url,element_position,html_element_id)
    {
     $scope.arrIndex = parseInt(index);
     $scope.default_image = '<?php echo site_url('media/fold_elements'); ?>/'+image_url;
     
     //removing item from array incae its false   
     if(element)
        {
            $scope.fold_default_images.splice($scope.arrIndex,1); 
            $('#element_'+html_element_id).addClass('ajax_uploaded_image');
            $('#element_img_'+html_element_id).html('');
            //enable the upaod field incase default is unchecked
            $('#element_'+html_element_id+' .JSFileChoos input').prop("disabled", false);
        }
      else
        {
            $('#element_'+html_element_id).removeClass('ajax_uploaded_image');
            $('#element_img_'+html_element_id).html('<img width="250" height="250" src="'+$scope.default_image+'" class="m-b-20 has-border">');
            
            //removing error class in case dafault image
            $('#element_'+html_element_id).removeClass('error');
            $('#element_'+html_element_id+' .JSpreveiw').text('').removeClass('error');
            //disable the upaod field incase default is selected
            $('#element_'+html_element_id+' .JSFileChoos input').prop("disabled", true);
            
            
            
            $scope.imgObj = {};
            $scope.imgObj.element_data         = image_url;
            $scope.imgObj.template_element_id  = element_id;
            $scope.imgObj.template_fold_id     = fold_id;
            $scope.imgObj.element_position     = element_position;
            $scope.imgObj.template_id          = $scope.selected_template_id;
            $scope.imgObj.campaign_batch_id    = $scope.batch_id;

            //$scope.element_array.splice(index,1, obj); 
            $scope.fold_default_images[$scope.arrIndex]= $scope.imgObj ;   
            
        }  
     console.log($scope.fold_default_images); 
    }
   
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
                // hiding previous error msg and rechecking again when user step back              
                $scope.error_batch_name = false; 
                $scope.error_batch_desc = false;
                $scope.error_batch_lists= false;
                $scope.error_campaign_id  = false;


                 if(angular.equals($scope.batch_name,'') || angular.isUndefined($scope.batch_name) )
                         {
                             $scope.error_batch_name = true;
                         }

                 //cleint side validation for batch name
                 if(angular.equals($scope.batch_description,'') || angular.isUndefined($scope.batch_description))
                         {
                             $scope.error_batch_desc = true;
                         }
                 // check for length of lists . which is 1 by default , there fore check with <=2        
                 if($scope.batch_list.length <= 2)
                         {
                             $scope.error_batch_lists = true;
                         }
                  if($scope.campaign_id == 0)
                         {
                             $scope.error_campaign_id = true;
                         }  

                  //return false if any of the validation fails   
                  if($scope.error_batch_desc || $scope.error_batch_name || $scope.error_batch_lists || $scope.error_campaign_id )
                         {
                          return false;
                         }

             
             
             
             //making ajax call only if validations are passed
             var request = 
             {
                 method: 'POST',
                 url:    '<?php echo $sFormAction; ?>',
                 data:   {method:'createBatch',campaign_id:''+$scope.campaign_id,name:$scope.batch_name,description:$scope.batch_description,list:$scope.batch_list,batch_id:$scope.batch_id}
              };
              
              
             //ajax call for creating batch 
             ajax_call(request,selected_tab);
         }

         /*step 2     
        * Called when Template selection tab is selected
        * */  
         else if (selected_tab==2)
         {
            //validate if product is not selected
            if($scope.selected_product_id == 0)
                {
                    $scope.error_product_id = true; 
                }
                
            //only make the call if template is selected
            else if($scope.selected_template_id > 0)
                {
                    //hidding both template and product validation messages before making the ajax call
                    $scope.error_template_id    = false;
                    $scope.error_product_id     = false;
                    
                    var request = {
                      method: 'POST',
                      url:    '<?php echo $sFormAction; ?>',
                      data:   {method:'setBatchTemplate',template_id:$scope.selected_template_id,product_id:$scope.selected_product_id,                                      campaign_batch_id:$scope.batch_id}
                                  };
                    
                    
                    //ajax call for updating teplate_id and product_id in campaign_batches table
                    ajax_call(request,selected_tab);
                }
                
             else
             
                {
                    $scope.error_template_id = true;
                }
             

         }   
         
         /*step 3     
        * Called when Upload Content tab is selected
        * */  
         else if (selected_tab==3)
         { 
            
           //image upload validations
              var aUploadedImages = $(".ajax_uploaded_image");
               
                $.each( aUploadedImages, function( key, value ) 
                {
                    if($(value).find('.custom_upload'))
                    {
                        $(value).addClass('error');
                        $( value ).find( '.JSpreveiw').text('<?php echo ERROR_FIELD_REQUIRED; ?>').addClass('error');
                    }
                 });
                 
            
         
         //console.log($scope.element_array); return;   
         //making ajax call only if validations are passed
            var models = document.getElementsByClassName("custom-elements");
            
            //nulling the validation array error_upload_content
            $scope.error_upload_content = [];
            
            var focus_animation = true;
            angular.forEach(models, function(value,key) 
                {   
                    //client side validation for empty fileds on upload content
                    var val_ng_model = value.attributes['ng-model'].value;       
                    
                    
                    //true if model is undefiend or empty
                    if(angular.isUndefined($scope[val_ng_model]) || angular.equals($scope[val_ng_model],'') )
                            {
                                if(focus_animation)
                                {
                                    $('html, body').animate({ scrollTop: $(value).offset().top - 100 }, 
                                                              'slow', function() { $(value).focus(); }
                                                           );  
                                    //disabling the animation for more errors
                                    focus_animation =   false;
                                }
                                
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
             if($scope.error_upload_content.length > 0 || $('.ajax_uploaded_image').length > 0 )
                {
                    return false;
                }
            
            $scope.temp = [];
            //removing undefined values set by default image chakboxes 
            angular.forEach($scope.fold_default_images, function(item) 
            {
                $scope.temp.push(item);
            });
            
             var request = 
             {
                 method: 'POST',
                 url:    '<?php echo $sFormAction; ?>',
                 data:   {
                          method:'setBatchElementsData',
                          fold_elements_data:$scope.element_array,
                          fold_images_data:$scope.temp,
                          meta_field:true
                         }
              };
              
              
             //ajax call for creating batch 
             ajax_call(request,selected_tab);
            //console.log(selected_tab);   

         } 
         
         
         /*step 4     
        * Called when Scheduling a batch
        * */  
         else if (selected_tab==4)
         {
           $scope.active_tab = 5;     

         }
         
         /*step 5     
        * Called when Scheduling a batch
        * */  
         else if (selected_tab==5)
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
                                    //autoselecting the first product in create mode {will be shown selected only for 1st time}
                                    if(angular.equals($scope.batch_id,0))
                                        {    
                                        $scope.selected_product_id = $scope.aProducts[0].product_id;
                                        $scope.getProductTemplate($scope.selected_product_id);
                                        }
                                    
                                    $scope.active_tab  = (isNaN(data.tab)) ? $scope.active_tab : data.tab;
                                    $scope.batch_id    = data.batch_id;

                                    $scope.error_batch_name   = false;
                                    $scope.error_batch_desc   = false;
                                    $scope.error_batch_lists  = false;
                                    $scope.error_campaign_id  = false;

                                    $scope.previous_button    = true;
                                    
                                    
                                                                        
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

                                                            //for batch name validation
                                                           if(angular.equals(item,'<?php echo ERROR_NAME_REQUIRED; ?>'))
                                                                {
                                                                    $scope.error_batch_name = true;

                                                                }

                                                            //batch description validation
                                                            if(angular.equals(item,'<?php echo ERROR_DESC_REQUIRED; ?>'))
                                                                {
                                                                    $scope.error_batch_desc = true;
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
                              
                                //html reveived for upload content tab in {hUploadContentHTML} object
                                //checking status
                                if(angular.equals(data.status,true))
                                    {
                                        $scope.active_tab  = (isNaN(data.tab)) ? $scope.active_tab : data.tab;
                                        //unserializing the json to get proper html
                                        var unSerializedJson = angular.fromJson(data.hUploadContentHTML);
                                        //compling the html for angular
                                        $scope.htmlUploadContent = $compile(unSerializedJson)($scope);
                                        $scope.template_cuttoff_period = data.cuttOffPeriod;
                                        //console.log(data);

                                    }
                                else{
                                        console.log(data.message);
                                    }      
                            
                            }
                  else if(selected_tab == 3)
                            {
                                
                                if(angular.equals(data.status,true))
                                    {
                                        $scope.active_tab  = (isNaN(data.tab)) ? $scope.active_tab : data.tab;
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
                  else if(selected_tab == 5)
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
                  else if(selected_tab == 'populateTempaltes')
                            {
                                //compling is necessary for binding ajax data's Angular attributes to current scope
                                $scope.htmlProductTemplate = $compile(data)($scope);
                            
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
app.directive("productTemplate",function($compile){
    return {
    
        link: function (scope, iElement, iAttrs) {
			
			scope.$watch('htmlProductTemplate', function() {
						
                                                iElement.html('');
						iElement.append(scope.htmlProductTemplate);
			});
			
           

        }
    
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
    
    <div  class="row" ng-controller="MainCtrl">
        <div class="col-md-12 main-div">
            <div class="" id="">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm c-nav-tabs">
                    <li ng-class="addClass('1')" >
                        <a><span>CREATE</span></a>
                    </li>
                    <li  ng-class="addClass('2')" >
                        <a ><span>TEMPLATE SELECTION</span></a>
                    </li>
                    <li  ng-class="addClass('3')">
                        <a ><span>UPLOAD CONTENT</span></a>
                    </li>
                    <li  ng-class="addClass('4')">
                        <a ><span>PREVIEW</span></a>
                    </li>
                    <li  ng-class="addClass('5')">
                        <a ><span>SCHEDULE</span></a>
                    </li>
                    <li  ng-class="addClass('6')">
                        <a ><span>SUMMARY</span></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
<!-- tab 1 Create Batch start-->
                    <div id="tab1" ng-class="addClass('1')" class="tab-pane padding-20  m-p-l-r-0 slide-left">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default" ng-class="{ 'has-error':error_batch_name }">
                                    <label for="batch-name" class="batch-name"><?php echo BATCH; ?> Name:</label>
                                    <input ng-model="batch_name" type="text" placeholder="Name" class="form-control" name="batch_name" required="" id="batch_name" required>
                                </div>
                                <label ng-show="error_batch_name"  class="error r-25">Batch Name is Required!</label>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div ng-class="{ 'has-error':error_batch_desc }" class="form-group form-group-default">
                                  <label for="batch-description" class="batch-description">Description:</label>
                                  <textarea ng-model="batch_description" placeholder="Add some description..." class="form-control m-t-4" name="batch_description" required="" id="batch-description"></textarea>
                                </div>
                                <label ng-show="error_batch_desc"  class="error r-25">Batch Description is Required !</label>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div ng-class="{ 'has-error':error_batch_lists }" class="form-group">
                                    <label for="batch-list" class="batch-list">List:</label>
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
                    
<!-- tab 2 Template selection start-->
                    <div id="tab2" ng-class="addClass('2')" class="tab-pane padding-20  m-p-l-r-0 slide-left">
                        <div class="row row-same-height">
                            <div class="col-md-12">
                                    
                                <!-- Template -->
                                <div class="panel panel-transparent">
                                    
                                  <label ng-show="error_product_id"  class="center alert alert-danger m-b-20"><button data-dismiss="alert" class="close"></button> Please Select a Product !</label>
                                  <label ng-show="error_template_id"  class="alert alert-danger m-b-20"><button data-dismiss="alert" class="close"></button> Please Select a Template !</label>

                                  <ul class="nav nav-tabs nav-tabs-simple nav-tabs-left bg-white" id="tab-3">
                                    <li ng-repeat="(key,product) in aProducts" ng-class="{active: key+1 == 1 }" >
                                      <a ng-click='getProductTemplate(product.product_id)' data-toggle="tab" href="#template-tab-{{key+1}}">
                                        {{product.title}}
                                      </a>
                                    </li>
                                  </ul>
                                    <!-- product template directive start-->
                                    <div product-template class="tab-content bg-white"> </div>
                                    <!-- product template directive end -->
                                </div>
                                <!-- / Template -->
                                

                            </div>
                        </div>
                    </div>
<!-- tab 2 Template selection End-->
                    
<!-- tab 3 upload content start-->
                    <div upload-content id="tab3" ng-class="addClass('3')" class="tab-pane padding-20  m-p-l-r-0 slide-left">
                        
                    </div>
<!-- tab 3 upload content end-->
                    

<!-- tab 4 Preview start-->
                    
                    <div id="tab5" ng-class="addClass('4')" class="tab-pane padding-20  m-p-l-r-0 slide-left">
<!--                     imagePreview Directive   -->
                    <div image-preview class='row'></div>       
                        
                    </div>      

<!-- tab 4 Preview End-->


<!-- tab 5 schedule start-->
                    <div  ng-class="addClass('5')" id="tab4" class="tab-pane p-t-20 p-b-20  m-p-l-r-0 slide-left">

                  
                  <div class="row">
                    <div class="col-md-5">
                    	<div class="form-group" ng-class="{ 'has-error':error_schedule_date }">
		                    <label class="schedule_date" for="schedule_date">Schedule Date</label>
		                    <div class="controls">
		                    	<div class="input-group date datepicker-future-date-only">
			                      <input readonly ng-model="schedule_date" type="text" id="schedule_date" required="" name="schedule" class="form-control">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                    </div>
                          <label ng-show="error_schedule_date"  class="error">Sorry ! At least {{template_cuttoff_period}} Days(required by printers).</label>
		                    </div>
		                  </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <p class="m-t-10"><strong>Note</strong> Cutoff period will be <strong class="c-blue">{{template_cuttoff_period}} days</strong></p>
                    </div>
                  </div>
                  

                </div>
<!-- tab 5 schedule end-->
                    

<!-- tab 6 Summary start-->                    
                    <div summary id="tab5" ng-class="addClass('6')" class="tab-pane padding-20  m-p-l-r-0 slide-left"></div>
                    
<!-- tab 6 Summary end-->
                    
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