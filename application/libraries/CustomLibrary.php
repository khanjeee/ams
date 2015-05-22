<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('LISTING_PER_PAGE',10);

global $gPagination;
$gPagination['per_page']     = LISTING_PER_PAGE;

$gPagination['full_tag_open'] = '<ul class="pagination">';
$gPagination['full_tag_close'] = '</ul>';

$gPagination['num_tag_open'] = '<li>';
$gPagination['num_tag_close'] = '</li>';

$gPagination['first_link'] = 'First';
$gPagination['first_tag_open'] = '<li>';
$gPagination['first_tag_close'] = '</li>';

$gPagination['last_link'] = 'Last';
$gPagination['last_tag_open'] = '<li>';
$gPagination['last_tag_close'] = '</li>';

$gPagination['next_link'] = 'Next &raquo;';
$gPagination['next_tag_open'] = '<li>';
$gPagination['next_tag_close'] = '</li>';

$gPagination['prev_link'] = '&laquo; Prev';
$gPagination['prev_tag_open'] = '<li>';
$gPagination['prev_tag_close'] = '</li>';

$gPagination['cur_tag_open'] = '<li class="active"><span>';
$gPagination['cur_tag_close'] = '</span></li>';
class CustomLibrary
{
	function __construct()
	{
        //include('Custom/global/emails.php');

        # Api Files...
        include('Custom/core/api.admin.php');
        include('Custom/core/api.crons.php');
        include('Custom/core/api.batches.php');
        include('Custom/core/api.media.php');
        include('Custom/core/api.campaign.php');
        include('Custom/core/api.package.php');
        include('Custom/core/api.product.php');
        include('Custom/core/api.register.php');
        include('Custom/core/api.contact.php');
        include('Custom/core/api.image.rendering.php');
        include('Custom/core/api.whitelabel.php');
        include('Custom/core/api.flag.php');
        include('Custom/core/api.predefined.campaigns.php');
		include('Custom/core/api.predefined.batches.php');
		include('Custom/core/api.payment.php');
		include('Custom/core/api.crm.php');
		
        
        
    }
}