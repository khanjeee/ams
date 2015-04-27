<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 4/13/15
 * Time: 5:46 PM
 */

?>


<div class="row">
    <div class="col-md-6">
        <h1 class="heading-sty-1"> <?php echo FREE_TEMPLATES; ?></h1>
    </div>
</div>


<div class="c-box m-t-20 m-b-20">
    <ul class="list-sty-3">

        <?php

        if($aPredefinedSolutions)
        {

            #  global $gPackageStatus;

            $this->load->helper('text');
            $iTotalTemplate = count($aPredefinedSolutions);

            for($p=0; $p < $iTotalTemplate; $p++)
            {
                $oTemplateInfo  =   (object) $aPredefinedSolutions[$p];

                $WhiteLabelDetailUrl        =   site_url('batches/whitelabel_create/'.$oTemplateInfo->campaign_id);
                ?>
                <li>
                    <div class="t-layout t-layout--cover">
                        <div class="t-row">
                            <div class="t-col">
                                <div class="name-and-actions">
                                    <a href="<?php echo $WhiteLabelDetailUrl; ?>" class="name"><?php echo $oTemplateInfo->title; ?></a>
                                </div>
                                <p><?php echo word_limiter($oTemplateInfo->description,8); ?></p>
                            </div>
                            <div class="t-col text-right t-col--mid">
                                <a href="<?php echo $WhiteLabelDetailUrl; ?>" class="fa arrow"></a>
                            </div>
                        </div>
                    </div>
                </li>

            <?php
            }
        }
        else
        {
            ?>
            <li>

            <p><?php echo MSG_NO_RECORD_FOUND; ?></p>

            </li><?php
        }
        ?>
    </ul>
</div>

<div class="custom-pagination text-center"><?php echo $this->pagination->create_links(); ?></div>
