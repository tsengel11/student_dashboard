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


$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_carp_new.php'));
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
    $user->CPCCCM2006_q =get_grade_from_item($user->id, 830,array());
    $user->CPCCCM2008_q =get_grade_from_item($user->id, 831,array());
    

    //print_object($user);
    array_push($users,$user);

$templatecontext = (object)[
    'studentname'=>$studentdata->firstname.' '.$studentdata->lastname,
    'studentemail'=>$studentdata->email,
    'coursename'=>'Certificate III in Carpentry',
    'users'=>array_values($users),
    'url'=>$CFG->wwwroot
    ];
}
catch(Exception $e)
{
    echo "Message:".$e->getMessage();
}

echo $OUTPUT->render_from_template('block_student_dashboard/report_carp_new',$templatecontext);


echo '<hr>';
//echo $content;

echo $OUTPUT->footer();