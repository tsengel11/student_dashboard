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


$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_dip_new.php'));
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
    $user->CPCCBC4004_q =get_grade_from_item($user->id, 726,array(3259));
    $user->CPCCBC4004_s =get_grade_from_item($user->id, 726,array(3260));
    $user->CPCCBC4005_q =get_grade_from_item($user->id, 727,array(3246));
    $user->CPCCBC4005_s =get_grade_from_item($user->id, 727,array(3247));
    $user->CPCCBC4008_q =get_grade_from_item($user->id, 730,array(2993));
    $user->CPCCBC4008_s =get_grade_from_item($user->id, 730,array(2995));
    $user->CPCCBC4009_q =get_grade_from_item($user->id, 731,array(3287));
    $user->CPCCBC4009_s =get_grade_from_item($user->id, 731,array(3288));
    $user->CPCCBC4010_q =get_grade_from_item($user->id, 732,array(3289));
    $user->CPCCBC4010_s =get_grade_from_item($user->id, 732,array(3290));
    $user->CPCCBC4012_q =get_grade_from_item($user->id, 733,array(3256));
    $user->CPCCBC4012_s =get_grade_from_item($user->id, 733,array(3257));
    $user->CPCCBC4013_q =get_grade_from_item($user->id, 734,array());
    $user->CPCCBC4013_s =get_grade_from_item($user->id, 734,array(3264));
    $user->CPCCBC4014_q =get_grade_from_item($user->id, 735,array(3322));
    $user->CPCCBC4014_s =get_grade_from_item($user->id, 735,array(3323));
    $user->CPCCBC4018_q =get_grade_from_item($user->id, 736,array(3302));
    $user->CPCCBC4018_s =get_grade_from_item($user->id, 736,array(3303));
    $user->CPCCBC4053_q =get_grade_from_item($user->id, 738,array());
    $user->CPCCBC4053_s =get_grade_from_item($user->id, 738,array());
    // Term 2 Units
    $user->CPCCBC5001_q =get_grade_from_item($user->id, 863,array());
    $user->CPCCBC5001_s =get_grade_from_item($user->id, 863,array());
    $user->CPCCBC5002_q =get_grade_from_item($user->id, 864,array());
    $user->CPCCBC5002_s =get_grade_from_item($user->id, 864,array());
    $user->CPCCBC5003_q =get_grade_from_item($user->id, 865,array());
    $user->CPCCBC5003_s =get_grade_from_item($user->id, 865,array());
    $user->CPCCBC5010_q =get_grade_from_item($user->id, 868,array());  
    $user->CPCCBC5010_q =get_grade_from_item($user->id, 868,array());  

    // Term 3 Units
    $user->CPCCBC5005_q =get_grade_from_item($user->id, 866,array());
    $user->CPCCBC5005_s =get_grade_from_item($user->id, 866,array());
    $user->CPCCBC5007_q =get_grade_from_item($user->id, 867,array());
    $user->CPCCBC5007_s =get_grade_from_item($user->id, 867,array());
    $user->CPCCBC5011_q =get_grade_from_item($user->id, 869,array());
    $user->CPCCBC5011_s =get_grade_from_item($user->id, 869,array());
    $user->CPCCBC5013_q =get_grade_from_item($user->id, 870,array());  
    $user->CPCCBC5013_s =get_grade_from_item($user->id, 870,array());  
    $user->CPCCBC5018_q =get_grade_from_item($user->id, 871,array());  
    $user->CPCCBC5018_s =get_grade_from_item($user->id, 871,array());  

    // Term 4 Units
    $user->CPCCBC4052_q =get_grade_from_item($user->id, 878,array());
    $user->CPCCBC4052_s =get_grade_from_item($user->id, 872,array());
    $user->CPCCBC5019_q =get_grade_from_item($user->id, 849,array());
    $user->CPCCBC5019_s =get_grade_from_item($user->id, 849,array());
    $user->BSBWHS513_q =get_grade_from_item($user->id, 869,array());
    $user->BSBWHS513_s =get_grade_from_item($user->id, 869,array());
    $user->BSBPMG538_q =get_grade_from_item($user->id, 848,array());  
    $user->BSBPMG538_s =get_grade_from_item($user->id, 848,array());  
    $user->BSBPMG532_q =get_grade_from_item($user->id, 847,array());  
    $user->BSBPMG532_s =get_grade_from_item($user->id, 847,array());   
    $user->BSBOPS504_q =get_grade_from_item($user->id, 846,array());  
    $user->BSBOPS504_s =get_grade_from_item($user->id, 846,array());  
    //print_object($user);
    array_push($users,$user);

$templatecontext = (object)[
    'studentname'=>$studentdata->firstname.' '.$studentdata->lastname,
    'studentemail'=>$studentdata->email,
    'coursename'=>'Diploma of Building and Construction (Building)',
    'users'=>array_values($users),
    'url'=>$CFG->wwwroot
    ];
}
catch(Exception $e)
{
    echo "Message:".$e->getMessage();
}

echo $OUTPUT->render_from_template('block_student_dashboard/report_dip_new',$templatecontext);


echo '<hr>';
//echo $content;

echo $OUTPUT->footer();