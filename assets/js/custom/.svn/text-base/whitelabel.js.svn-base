/*@Description:white label color picker js */

var app = angular.module('ColorApp',['colorpicker.module']);

app.controller('ColorCtrl',function($scope)
{
   $scope.hexPicker = '';
   

}); 

$(document).ready(function (){
    $.validator.addMethod("regx", function(value, element, regexpr) 
    { 
     var hexColorCode = new RegExp(regexpr);
     return hexColorCode.test(value);
     
    }, "Invalid Color Code");
    
    ERROR_MESSAGE_COLOR =   {required: "Invalid Color Code"};
    REGEX               =   {required: true,regx:'^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$'};
                        
    
     $(".form-validate-whitelabel").validate({
        ignore: '[type=hidden]',
        rules: {
                'whitelabel[selected_theme][logo_background]':REGEX,
                'whitelabel[selected_theme][menu_color]': REGEX,
                'whitelabel[selected_theme][theme_primary_color]': REGEX,
                'whitelabel[selected_theme][theme_secondary_color]': REGEX,
                'whitelabel[email_address]': { required: true,
                                               email: true
                                              }
                
                              
                        
              },
        messages: {
                    'whitelabel[selected_theme][logo_background]': ERROR_MESSAGE_COLOR,
                    'whitelabel[selected_theme][menu_color]': ERROR_MESSAGE_COLOR,
                    'whitelabel[selected_theme][theme_primary_color]': ERROR_MESSAGE_COLOR,
                    'whitelabel[selected_theme][theme_secondary_color]': ERROR_MESSAGE_COLOR
                             
                            
                  }    
    });
    
});
  
                    
    






    
    