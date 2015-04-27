<?php

/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 6/16/14
 * Time: 4:39 PM
 */

$sSiteTitle = SITE_TITLE;

global $sSubjectPrefix, $sEmailFooter;

$sSubjectPrefix = '['. $sSiteTitle .'] ';
$sEmailFooter = 'Thanks,<br/> Team '.$sSiteTitle;

function Email($sCallFrom = '', $aData = array())
{
        $EmailData      = getEmailContent($sCallFrom, $aData);

        $To             = $EmailData['to'];
        $From           = $EmailData['from'];
        $sSubject       = $EmailData['subject'];
        $sContent       = $EmailData['content'];

        #Shoot Email
        debug($EmailData);
    //SendEmail($To,$From,$sSubject,$sContent);
}

function getEmailContent($sCallFrom = '',$aData = array())
{
    global $sSubjectPrefix, $sEmailFooter;
    $sSiteTitle = SITE_TITLE;

    if($sCallFrom == 'coursesrequest')
    {
        $ReceivedData   =    (object) $aData['data'];

        $Subject        =    $sSubjectPrefix.'You request has been received.';
        $Content        =    <<<CONTENT

            Dear $ReceivedData->trainee,

            Your request has been received for the course $ReceivedData->course and $sSiteTitle will let you know after reviewing.

             $sEmailFooter
CONTENT;
    }

    $aData['subject'] = $Subject;
    $aData['content'] = $Content;

    return $aData;
}




/*

Sample

$aEmailData = array(
                        'to'        => 'trainee@email.com',
                        'from'      => 'admin@nesma.com',
                        'data'      => array(
                                                'course'    => 'PHP',
                                                'trainee'   => 'Minhaj'
                                            )
                    );
ShootMail('coursesrequest',$aEmailData);
*/