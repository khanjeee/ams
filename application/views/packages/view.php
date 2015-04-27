<div class="row">
    <div class="col-md-2">
        <h1 class="heading-sty-1">Package</h1>
    </div>
    <div class="col-md-10">
        <div class="contact-search-n-actions-panel">
            <a href="<?php echo site_url('packages/create'); ?>" class="btn btn-complete btn-cons hidden-sm hidden-xs">Create New Package</a>
        </div>
    </div>
</div>

<!-- <div class="m-t-10 m-b-10">
    <div class="row row--sty-1">
        <div class="col-md-2">
              <div class="form-group">
                <label for="filter1">Filter</label>
                <select id="filter1" class="full-width select--no-search" data-init-plugin="select2">
                    <option value="date">By Date</option>
                    <option value="name">By Name</option>
                    <option value="name">By Batches</option>
                </select>
              </div>
        </div>
        <div class="col-md-10">
            <div class="pull-right m-t-27 tablet-m-t-10">
                <a href="<?php echo site_url('packages/create'); ?>" class="btn btn-complete btn-cons hidden-sm hidden-xs">Create New Package</a>
            </div>
        </div>
    </div>
</div> -->
<div class="c-box m-t-20 m-b-20">
    <ul class="list-sty-3">
       
        <?php

            if($aPackages)
            {
                global $gPackageStatus;

                $this->load->helper('text');
                $iTotalPackages = count($aPackages);


                for($p=0; $p < $iTotalPackages; $p++)
                {
                    $oPackagesInfo  =   $aPackages[$p];
                    $EditUrl        =   site_url('packages/save/'.$oPackagesInfo->package_id);
                    $DeleteUrl      =   site_url('packages/delete/'.$oPackagesInfo->package_id);    
        ?>
                    <li>
                        <div class="t-layout t-layout--cover">
                            <div class="t-row">
                                <div class="t-col">
                                    <div class="name-and-actions">
                                        <a href="#" class="name"><?php echo word_limiter($oPackagesInfo->title,4); ?></a>
                                        <div class="actions">
                                            <a href="#" class="fa edit"></a>
                                            <a href="javascript:void(0);" class="fa delete" onclick="return confirmDelete('<?php echo $sCallFrom; ?>','<?php echo $sDeleteAction.'/'.$oPackagesInfo->package_id; ?>');"></a>
                                        </div>
                                    </div>
                                    <p><?php echo word_limiter($oPackagesInfo->description,8); ?></p>
                                    <ul class="meta">
                                        <li><strong>Price:</strong> <?php echo formatAmount($oPackagesInfo->price); ?></li>
                                        <li><strong>Status:</strong> <?php echo $gPackageStatus[$oPackagesInfo->status]; ?></li>
                                        <li><strong>Created:</strong> <?php echo displayDateTime($oPackagesInfo->created_on); ?></li>
                                    </ul>
                                </div>
                                <div class="t-col text-right t-col--mid">
                                    <a href="#" class="fa arrow"></a>
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