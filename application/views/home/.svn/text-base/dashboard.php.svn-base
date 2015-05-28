<script data-require="angular.js@1.2.x" src="<?php echo getAssetsPath(); ?>js/angular/angular.js" data-semver="1.2.15"></script>
<script src="<?php echo getAssetsPath(); ?>js/custom/dashboard.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="dashboard-title">
            <span>Welcome to</span><br><strong><?php echo SITE_TITLE; ?></strong>
        </div>
    </div>
</div>

<?php
if(isSuperAdmin())
{
    global $aBatchStatus;
?>

    
<div class="row" >
    <div class="col-md-8 col-lg-7 main-div">
        <div class="c-box">
            <div class="c-box__head">
                <div class="fl">
                    <h4 class="heading">Orders <span>Ready For Printing</span></h4>
                </div>
                <div class="fr">
                    <?php

                    $iTotalBatches = count($aCutOffBatches);
                    
                    ?>

                    <div class="count"><?php echo $iTotalBatches; ?></div>
                </div>
            </div>
            <div class="c-box__body " >
                <div ng-app="ams" ng-controller="DownloadContent">
                <ul class="c-box__list">

                    <?php
                    if($iTotalBatches > 0)
                    {
                        for($b=0; $b <$iTotalBatches; $b++ )
                        {
                            $aBatch                 = (object) $aCutOffBatches[$b];
                            //debug($aBatch);
                            $PreviewImages          = json_decode($aBatch->last_preview_images);
                            $TemplateDefaultImage   = $aBatch->folds[0]['default_fold_image'];
                        ?>

                        <li class="sty-1">
                            <div class="t-layout">
                                <div class="t-row">
                                    <div class="t-col col-1">


                                        <!-- Previe Images -- START-->

                                        <script type="text/javascript">
                                        
                                        $(window).ready(function ()
                                        {
                                            $('.magnific-popup-<?php echo $b; ?>').magnificPopup
                                            ({
                                                items:
                                                [
                                                    <?php

                                                    if($PreviewImages)
                                                    {
                                                        $Script ='';
                                                        for($p=0; $p<count($PreviewImages);$p++)
                                                        {
                                                            $src    = site_url($PreviewImages[$p]->file_server_path);
                                                            $title  = $PreviewImages[$p]->fold_title;

                                                            echo $Script = <<<DATA

                                                            {
                                                                src     : '$src',
                                                                title   : '$title'
                                                            },
DATA;
                                                        }
                                                    }

                                                    ?>
                                                ],
                                                gallery: {
                                                    enabled: true
                                                },
                                                type: 'image' // this is a default type
                                            });
                                        });
                                        </script>


                        <div data-img="<?php echo site_url($TemplateDefaultImage); ?>" class="img cover-img pos-rel">
                            <a href="<?php echo site_url($TemplateDefaultImage); ?>" class="fa img-preview magnific-popup-<?php echo $b; ?>"></a>
                        </div>


                                        <!-- Previe Images -- END -->

                                    </div>
                                    <div class="t-col col-2">
                                        <div class="title">
                                            <a href="#"><?php echo $aBatch->batch_title; ?></a>
                                            <div class="info">Campaign: <a href="<?php echo site_url('campaigns/show/'.$aBatch->campaign_id); ?>"><?php echo $aBatch->campaign_title; ?></a>, User: <a ><?php echo $aBatch->first_name; ?> <?php echo $aBatch->last_name; ?></a></div>
                                        </div>
                                        <div id="edit-section-1" class="editable show">
                                            <div class="status">
                                                <div class="value">
                                                    <strong>Status</strong>
                                                    <span>Ready for printing</span>
                                                </div>
                                            </div>
                                        </div>
                                        <strong>Product:</strong> <span><?php echo $aBatch->product_title; ?></span> (<?php echo $aBatch->template_title; ?>)
                                        <br>
                                        <strong>Cost:</strong> <span><?php echo formatAmount($aBatch->total_printing_cost); ?></span>
                                        <br>
                                        <strong>Scheduled For:</strong> <span><?php echo displayDate($aBatch->schedule_date); ?></span>
                                        <br>
                                        <strong>Created On:</strong> <span><?php echo displayDate($aBatch->created_on); ?></span>
                                        <br>
                                        <strong>Cutoff Date:</strong> <span><?php echo displayDate($aBatch->cut_off_date); ?></span>
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-primary edit is-editable-section m-t-10" data-target="edit-section-<?php echo $b; ?>">Edit Status</a>
                                        <a href="#" class="btn btn-success m-t-10" ng-click="DownloadBatchContent('<?php echo $aBatch->campaign_batch_id; ?>')">Download Content</a>
                                    </div>
                                    <div class="t-col text-right t-col--mid col-3">
                                        <a href= "<?php echo site_url('orders/view'); ?>" class="fa arrow"></a>
                                    </div>
                                </div>
                            </div>

                            <div id="edit-section-<?php echo $b; ?>-target" class="edit-mode hide">
                                <div class="edit">
                                    <!-- <h5>Change Status</h5> -->
                                    <div class="form-group form-group-default form-group-default-select2">
                                        <label>status</label>
                                        <?php echo form_dropdown('status', $aBatchStatus, "$aBatch->current_status", "class='select--no-search full-width status$b'");  ?>
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label class="address_mailing">Notes:</label>
                                        <div class="controls">
                                            <textarea type='text' class='comment<?php echo $b; ?> form-control h-90' placeholder="Write a note to keep track of changes in status."></textarea>
                                        </div>
                                    </div>

                                    <a onclick="cancelEdit('edit-section-<?php echo $b; ?>');" href="javascript:void(0);" class="btn btn-danger">Cancel</a>
                                    <input type="button" name="btnSubmit" value="Update Status" ng-click="updateBatchStatus('<?php echo $aBatch->campaign_batch_id; ?>','<?php echo $b; ?>')" class="create_campagin btn btn-success m-btn-full w-auto">
                                </div>
                            </div>

                        </li>
                        <?php
                        }
                    }else{

                    ?>
                        <li>
                            <p>No orders ready for printing.</p>
                        </li>
                    <?php 

                    }

                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   <!-- <div class="col-md-4 col-lg-5">
        <div class="c-box">
            <div class="c-box__head">
                <div class="fl">
                    <h4 class="heading">Notification</h4>    
                </div>
                <div class="fr">
                    <div class="count">0</div>
                </div>
            </div>
            <div class="c-box__body">
                <br>
                <p>No Notification Found!</p>

            </div>
        </div>
    </div>-->
</div>
<?php
}
else
{

    if(true)
    {

?>



    <hr>
    <h3>Schdules</h3>
    <p>Select a date to see the schedules for <?php echo BATCHES; ?>.</p>
    <!-- START CALENDAR -->
    <div class="calendar">
        <!-- START CALENDAR HEADER-->
        <div class="options">
            <div class="row">
                <div class="col-md-3">
                    <div class="calendar-header">
                      <div class="drager">
                        <div class="years" id="years"></div>
                      </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="months-drager drager">
                        <div class="months" id="months"></div>
                    </div>
                </div>
            </div>
          <h4 class="semi-bold date" id="currentDate"></h4>
          <div class="drager week-dragger">
            <div class="weeks-wrapper" id="weeks-wrapper">
            </div>
          </div>
        </div>
        <!-- START CALENDAR GRID-->
        <div id="calendar" class="calendar-container">
        </div>
        <!-- END CALENDAR GRID-->

        <!-- Calendar Based Batches -->
        <div id="calendar-custom" class="calendar-custom-content-container">
        </div>
        <!-- END Calendar Based Batches -->

    </div>
    <!-- END CALENDAR -->
    <div id="batchListAngularController" ng-app="scheduleBatches" ng-controller="batchesList">
        
        <br>

        <div id="noBatchFound" class="no_record"><p>Nothing schdule on this date.</p></div>

        <ul class="batch-preview_sty-1" id="batchList">
            <li ng-repeat="x in batchesData">
                <div class="batch">
                    <div class="t-layout h-auto">
                        <div class="t-row">
                            <div class="t-col t-col-compress t-col--align-top p-r-20">
                                <div class="product">
                                    <div class="cover-img img" data-img="{{x.imgUrl}}"></div>
                                </div>
                            </div>
                            <div class="t-col t-col--align-top">
                                <h4 class="m-t-0 heading-sty-3">{{x.name}}</h4>
                                <p>{{x.description}}</p>
                                <div class="row">
                                    <div class="col-md-4 bor-r-1">
                                        <ul class="meta">
                                            <li><strong>Campaign : </strong>
                                                {{x.campaign}}
                                            </li>
                                           <!-- <li><strong>Status : </strong>
                                                {{x.status}}
                                            </li>
                                            <li><strong>Cut Off Date : </strong>
                                                {{x.cutOff}}
                                            </li>-->
                                            <li><strong>Created on : </strong>
                                                {{x.createdOn}}
                                            </li>
                                            <li><strong>Schedule on : </strong>
                                                {{x.scheduleOn}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 bor-r-1">
                                        <ul class="meta">
                                            <li><strong>Product : </strong>
                                                {{x.product}}
                                            </li>
                                            <li><strong>Template : </strong>
                                                {{x.template}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="meta">
                                            <li><strong>Template Cost: </strong> 
                                                {{x.templateCost}}
                                            </li>

                                            <li><strong>Total Printing Cost: </strong>
                                                {{x.totalCost}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <br>
                                <a href="{{x.editUrl}}" class="btn btn-primary">Edit</a>
                                <a href="javascript:void(0)" ng-click="deleteBatch(x.deleteUrl)" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        
    </div>

    <script>
        scheduleBatches = angular.module('scheduleBatches', []);
        scheduleBatches.controller('batchesList', function($scope) {
            $scope.updateBatchesData = function(_s){
                $scope.batchesData = _s;
            };
            $scope.deleteBatch = function (url) {
                return confirmDelete('delete_batch', url);
            };
        });
    </script>

    <!-- For Calendar -->
    <script src="<?php echo getAssetsPath(); ?>plugins/classie/classie.js" type="text/javascript"></script>
    <!-- For Mobile Touch drag and drop -->
    <script src="<?php echo getAssetsPath(); ?>/plugins/jquery-ui-touch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- Loading Dates to calendar -->
    <script src="<?php echo getAssetsPath(); ?>/plugins/moment/moment.min.js"></script>
    <!-- Language Options -->
    <!-- <script src="<?php echo getAssetsPath(); ?>/plugins/moment/moment-with-locales.min.js"></script> -->
    <!-- Horizontal Touch drag-->
    <script src="<?php echo getAssetsPath(); ?>/plugins/hammer.min.js"></script>

    <script src="<?php echo getAssetsPath(); ?>/pages/js/pages.calendar.js"></script>

    <script src="<?php echo getAssetsPath(); ?>/js/calendar.js" type="text/javascript"></script>

    <script type="text/javascript">
        /* ================================================================
         * Calendar
         * This is a Demo App that was created using Pages Calendar Plugin
         * We have demonstrated a few function that are useful in creating
         * a custom calendar. Please refer docs for more information
         * ================================================================ */

        (function($) {

            'use strict';

            $(document).ready(function() {

                var selectedEvent;
                $('body').pagescalendar({
                    //Loading Dummy EVENTS for demo Purposes, you can feed the events attribute from 
                    //Web Service
                    events: [<?php

                        if($aScheduledBatches)
                        {
                            foreach($aScheduledBatches as $aBatch)
                            {
                                $sTitle                     = $aBatch['BatchDetails']['batch_title'];
                                $sDesc                      = $aBatch['BatchDetails']['batch_description'];
                                $sCampaignTitle             = $aBatch['BatchDetails']['campaign_title'];
                                $dScheduleDate              = $aBatch['BatchDetails']['schedule_date'];
                                $dCreatedOn                 = $aBatch['BatchDetails']['created_on'];
                                $sProductTitle              = $aBatch['BatchDetails']['product_title'];
                                $sTemplateTitle             = $aBatch['BatchDetails']['template_title'];
                                $sBatchTotalPrintingPrice   = formatAmount($aBatch['BatchTotalPrintingPrice']);
                                $TemplatePrintingPrice      = formatAmount($aBatch['BatchDetails']['template_printing_price']);

                                $EditUrl                    = site_url('batches/edit/'.$aBatch['BatchDetails']['campaign_batch_id']);
                                $DeleteUrl                  = site_url('batches/delete/'.$aBatch['BatchDetails']['campaign_batch_id']);

                               echo  $JS = <<<JS
                                {
                                    imgUrl: "http://localhost/ams/assets/img/batch-default.jpg",
                                    name: "$sTitle",
                                    description: "$sDesc",
                                    campaign: "$sCampaignTitle",
                                    status: "Lorem",
                                    cutOff: "Lorem",
                                    createdOn: "$dCreatedOn",
                                    scheduleOn: "$dScheduleDate",
                                    list: "Lorem",
                                    product: "$sProductTitle",
                                    template: "$sTemplateTitle",
                                    templateCost: "$TemplatePrintingPrice",
                                    printingCost: "$sBatchTotalPrintingPrice",
                                    totalCost: "$sBatchTotalPrintingPrice",
                                    card: "Lorem",
                                    editUrl: "$EditUrl",
                                    deleteUrl: "$DeleteUrl",
                                    start: "$dScheduleDate"
                                },
JS;
                            }
                        }

                        ?>

                    ],
                    onViewRenderComplete: function() {
                        //You can Do a Simple AJAX here and update 
                    },
                    onEventClick: function(event) {
                        //Open Pages Custom Quick View
                        if (!$('#calendar-event').hasClass('open'))
                        $('#calendar-event').addClass('open');
                        selectedEvent = event;
                        setEventDetailsToForm(selectedEvent);
                    },
                    onEventDragComplete: function(event) {
                        selectedEvent = event;
                        setEventDetailsToForm(selectedEvent);
                    },
                    onEventResizeComplete: function(event) {
                        selectedEvent = event;
                        setEventDetailsToForm(selectedEvent);
                    },
                    onTimeSlotDblClick: function(timeSlot) {
                        //Adding a new Event on Slot Double Click
                        var newEvent = {
                            title: 'my new event',
                            class: 'bg-success-lighter',
                            start: timeSlot.date,
                            end: moment(timeSlot.date).add(1, 'hour').format(),
                            allDay: false,
                            other: {
                                //You can have your custom list of attributes here
                                note: 'test'
                            }
                        };
                        selectedEvent = newEvent;
                        $('body').pagescalendar('addEvent', newEvent);

                        //Open Pages Custom Quick View
                        if (!$('#calendar-event').hasClass('open'))
                            $('#calendar-event').addClass('open');
                        setEventDetailsToForm(selectedEvent);
                    }
                });

                //After the settings Render you Calendar
                $('body').pagescalendar('render');

                // Some Other Public Methods That can be Use are below \
                //console.log($('body').pagescalendar('getEvents'))
                //get the value of a property
                //console.log($('body').pagescalendar('getDate','MMMM'));

                function setEventDetailsToForm(event) {
                    $('#eventIndex').val();
                    $('#txtEventName').val();
                    $('#txtEventCode').val();
                    $('#txtEventLocation').val();
                    //Show Event date
                    $('#event-date').html(moment(event.start).format('MMM, D dddd'));

                    $('#lblfromTime').html(moment(event.start).format('h:mm A'));
                    $('#lbltoTime').html(moment(event.end).format('H:mm A'));

                    //Load Event Data To Text Field
                    $('#eventIndex').val(event.index);
                    $('#txtEventName').val(event.title);
                    $('#txtEventCode').val(event.other.code);
                    $('#txtEventLocation').val(event.other.location);
                }

                $('#eventSave').on('click', function() {
                    selectedEvent.title = $('#txtEventName').val();

                    //You can add Any thing inside "other" object and it will get save inside the plugin.
                    //Refer it back using the same name other.your_custom_attribute

                    selectedEvent.other.code = $('#txtEventCode').val();
                    selectedEvent.other.location = $('#txtEventLocation').val();

                    $('body').pagescalendar('updateEvent', $('#eventIndex').val(), selectedEvent);

                    $('#calendar-event').removeClass('open');
                });
                $('#eventDelete').on('click', function() {
                    $('body').pagescalendar('removeEvent', $('#eventIndex').val());
                    selectedEvent.other.code = $('#txtEventCode').val();
                    selectedEvent.other.location = $('#txtEventLocation').val();

                    $('#element').pagescalendar('updateEvent', $('#eventIndex').val(), selectedEvent);
                    $('#calendar-event').removeClass('open');

                });
                $('#eventDelete').on('click', function() {
                    $('#element').pagescalendar('removeEvent', $('#eventIndex').val());
                    $('#calendar-event').removeClass('open');
                });
            });

        })(window.jQuery);
    </script>

<?php

    }
}
?>