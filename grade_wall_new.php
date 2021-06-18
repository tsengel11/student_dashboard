<?php
// This file is part of Moodle - http://moodle.org/
//

/**
 * Version details
 *
 * @package    block_student_progress
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(dirname(__FILE__) . '/../../config.php');

require_login();

global $DB, $USER, $CFG;
require_once($CFG->dirroot . '/blocks/student_dashboard/locallib.php');
require_once($CFG->dirroot . '/blocks/grading_report/locallib.php');
//require_once(__DIR__. '/blocks/grading/locallib.php');

$user_id = $USER->id;

if(isset($_GET['id'])){
    $user_id = $_GET['id'];
}


$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_wall_new.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Grade Details');

// Retrieving CertIV Grades of student

$studentdata = get_studentdata($user_id);

echo $OUTPUT->header();
try  
        {
$url = $CFG->wwwroot;
            $users = array();

$user = new stdClass();
$user->id=$user_id;

    $user->CPCCWHS2001_q =get_grade_from_item($user->id, 844,array(3127));
    $user->CPCCOM1012_q =get_grade_from_item($user->id, 835,array(3129));
    $user->CPCCOM1013_q =get_grade_from_item($user->id, 836,array(3131));
    $user->CPCCOM1013_s =get_grade_from_item($user->id, 836,array(3132));
    $user->CPCCOM1014_q =get_grade_from_item($user->id, 837,array(3137));
    $user->CPCCOM1014_s =get_grade_from_item($user->id, 837,array(3263));
    $user->CPCCOM1015_q =get_grade_from_item($user->id, 838,array(3248));
    $user->CPCCOM1015_s =get_grade_from_item($user->id, 838,array(3262));
    $user->CPCCCM2006 =get_grade_from_item($user->id, 830,array());
    $user->CPCCCM2008 =get_grade_from_item($user->id, 831,array());

    $user->CPCCWF3001 =get_grade_from_item($user->id, 771,array());
    $user->CPCCWF2001 =get_grade_from_item($user->id, 769,array());
    $user->CPCCOM2001_q =get_grade_from_item($user->id, 768,array(3280));
    $user->CPCCOM2001_s =get_grade_from_item($user->id, 768,array(3281));
    $user->CPCCWF2002 =get_grade_from_item($user->id, 770,array());

    $user->CPCCWF3009 =get_grade_from_item($user->id, 778,array());
    $user->CPCCWF3002 =get_grade_from_item($user->id, 772,array());
    $user->CPCCWF3003 =get_grade_from_item($user->id, 773,array());
    $user->CPCCWF3004 =get_grade_from_item($user->id, 774,array());

    $user->CPCCWF3007 =get_grade_from_item($user->id, 777,array());
    $user->CPCCWF3006 =get_grade_from_item($user->id, 776,array());
    $user->CPCCWF3005 =get_grade_from_item($user->id, 775,array());
    $user->BSBESB301 =get_grade_from_item($user->id, 761,array());
    $user->BSBESB407_q =get_grade_from_item($user->id, 762,array(3270));
    $user->BSBESB407_s =get_grade_from_item($user->id, 762,array(3271));
    //print_object($user);
    array_push($users,$user);

$templatecontext = (object)[
    'studentname'=>$studentdata->firstname.' '.$studentdata->lastname,
    'studentemail'=>$studentdata->email,
    'coursename'=>'Certificate III in Wall and Floor Tiling',
    'users'=>array_values($users),
    'url'=>$CFG->wwwroot
    ];
}
catch(Exception $e)
{
    echo "Message:".$e->getMessage();
}

echo $OUTPUT->render_from_template('block_student_dashboard/report_wall_new',$templatecontext);


echo '<hr>';
//echo $content;

echo $OUTPUT->footer();