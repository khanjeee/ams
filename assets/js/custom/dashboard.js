/*@Description:Batch status update */

var app = angular.module('ams',[]);

app.controller('DownloadContent',function($scope,$http,$window)
{
    
  $scope.ajax_url = $('.site_url').text()+'ajax/batches';
  
  $scope.DownloadBatchContent = function(CampaignBatchId)
    {
        $scope.loading(true);
        
        
        
        
        $http.post($scope.ajax_url, {campaign_batch_id:CampaignBatchId,method:'downloadBatchContent'}).
                            success(function(data)
                            {
                                if(data.status)
                                {
                                    $scope.loading(false);
                                    $window.location.href =data.url;
                                }
                                else
                                {
                                    $scope.loading(false);
                                    alert("No uploaded content files.");
                                    return false;
                                }
                            }).
                            error(function(data)
                            {
                                console.log("Failure");
                                return false;
                            });
   }
                    
     $scope.updateBatchStatus = function (CampaignBatchId,ClassName)
     {
     
     $scope.status   = $('.status'+ClassName+' option:selected').val();
     $scope.comments = $('.comment'+ClassName).val();
     $scope.element  = 'edit-section-'+ClassName;
     
     
     if(angular.equals($scope.comments,''))
         {
            alert('Comments are required'); 
            return ;
         }
     
     
     
     
     $http.post($scope.ajax_url, {  campaign_batch_id:CampaignBatchId,
                                    comments:$scope.comments,
                                    status:$scope.status,
                                    method:'updateBatchStatus'
                                }
                ).
                            success(function(data)
                            {
                                if(angular.equals(data.status,true))
                                {
                                  $window.location.reload();
                                  
                                  // $scope.hideElement($scope.element); 
                                 }
                                else
                                {
                                 console.log(data);    
                                }
                            }).
                            error(function(data)
                            {
                                console.log("Failure");
                                return false;
                            });
     
     $scope.loading(false);

     }  
     
     
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
                    
//    $scope.hideElement = function (target) {
//    $('#'+target).removeClass('hide');
//    $('#'+target+'-target').addClass('hide');
//}               
//                    

});   
  
                    
    






    
    