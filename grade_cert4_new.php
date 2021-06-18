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


$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_cert4_new.php'));
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
    // Term 1 Units
    $user->CPCCBC4001_q =get_grade_from_item($user->id, 723,array(2999));
    $user->CPCCBC4001_s =get_grade_from_item($user->id, 723,array(3001));
    $user->CPCCBC4002_q =get_grade_from_item($user->id, 724,array(3003));
    $user->CPCCBC4002_s =get_grade_from_item($user->id, 724,array(3004));
    $user->CPCCBC4003_q =get_grade_from_item($user->id, 725,array(3254));
    $user->CPCCBC4003_s =get_grade_from_item($user->id, 725,array(3255));
    $user->CPCCBC4053_q =get_grade_from_item($user->id, 738,array());
    $user->CPCCBC4053_s =get_grade_from_item($user->id, 738,array());
    // Term 2 Units
    $user->CPCCBC4004_q =get_grade_from_item($user->id, 726,array(3259));
    $user->CPCCBC4004_s =get_grade_from_item($user->id, 726,array(3260));
    $user->CPCCBC4005_q =get_grade_from_item($user->id, 727,array(3246));
    $user->CPCCBC4005_s =get_grade_from_item($user->id, 727,array(3247));
    $user->CPCCBC4006_q =get_grade_from_item($user->id, 728,array(3258));
    $user->CPCCBC4006_s =get_grade_from_item($user->id, 728,array(3261));
    $user->CPCCBC4007_q =get_grade_from_item($user->id, 729,array(3268));
    $user->CPCCBC4007_s =get_grade_from_item($user->id, 729,array(3269));
    $user->CPCCBC4008_q =get_grade_from_item($user->id, 730,array(2993));
    $user->CPCCBC4008_s =get_grade_from_item($user->id, 730,array(2995));
    // Term 3 Units
    $user->CPCCBC4009_q =get_grade_from_item($user->id, 731,array(3287));
    $user->CPCCBC4009_s =get_grade_from_item($user->id, 731,array(3288));
    $user->CPCCBC4010_q =get_grade_from_item($user->id, 732,array(3289));
    $user->CPCCBC4010_s =get_grade_from_item($user->id, 732,array(3290));
    $user->CPCCBC4012_q =get_grade_from_item($user->id, 733,array(3256));
    $user->CPCCBC4012_s =get_grade_from_item($user->id, 733,array(3257));
    $user->CPCCBC4014_q =get_grade_from_item($user->id, 735,array(3322));
    $user->CPCCBC4014_s =get_grade_from_item($user->id, 735,array(3323));
    $user->CPCCBC4018_q =get_grade_from_item($user->id, 736,array(3302));
    $user->CPCCBC4018_s =get_grade_from_item($user->id, 736,array(3303));
    // Term 3 Units
    $user->CPCSUS4002_q =get_grade_from_item($user->id, 740,array(2997));
    $user->CPCSUS4002_s =get_grade_from_item($user->id, 740,array(3000));
    $user->CPCCBC4013_q =get_grade_from_item($user->id, 734,array());
    $user->CPCCBC4013_s =get_grade_from_item($user->id, 734,array(3264));
    $user->CPCCBC4021_q =get_grade_from_item($user->id, 737,array(3297));
    $user->CPCCBC4021_s =get_grade_from_item($user->id, 737,array(3298));
    $user->BSBPMG422_q =get_grade_from_item($user->id, 722,array());
    $user->BSBPMG422_s =get_grade_from_item($user->id, 722,array());
    $user->BSBESB407_q =get_grade_from_item($user->id, 762,array(3270));
    $user->BSBESB407_s =get_grade_from_item($user->id, 762,array(3270));   

    //print_object($user);
    array_push($users,$user);

$templatecontext = (object)[
    'studentname'=>$studentdata->firstname.' '.$studentdata->lastname,
    'studentemail'=>$studentdata->email,
    'coursename'=>'Certificate IV in Building and Construction',
    'users'=>array_values($users),
    'url'=>$CFG->wwwroot
    ];
}
catch(Exception $e)
{
    echo "Message:".$e->getMessage();
}

echo $OUTPUT->render_from_template('block_student_dashboard/report_cert4_new',$templatecontext);


echo '<hr>';
//echo $content;

echo $OUTPUT->footer();