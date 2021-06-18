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


$user_id = $USER->id;

if(isset($_GET['id'])){
    $user_id = $_GET['id'];
}


$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_cert4.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Grade Details');

// Retrieving CertIV Grades of student

$grades = get_gradecert4($user_id);
$studentdata = get_studentdata($user_id);

echo $OUTPUT->header();
try
        {
//print_object($grades);

$grades_term1 = array();
$grades_term2 = array();
$grades_term3 = array();
$grades_term4 = array();

$url = $CFG->wwwroot;
foreach($grades as $grade)
{
    $grade->overall = convert_overall($grade->overall);
    $grade->summative = get_grade_letter_1($grade->summative);
    $grade->written = get_grade_letter_1($grade->written);
    $grade->previous1 = get_grade_letter_1(max($grade->previous1,$grade->previous2) ) ;
    $grade->link = greate_link($grade->id,$grade->fullname,$url);
    

    if (($grade->id==380||$grade->id==381||$grade->id==382||$grade->id==383||$grade->id==468)  ) {
        array_push($grades_term1,$grade);
    }
    if (($grade->id==384||$grade->id==385||$grade->id==386||$grade->id==387)  ) {
        array_push($grades_term2,$grade);
    }
    if (($grade->id==388||$grade->id==389||$grade->id==390||$grade->id==391)  ) {
        array_push($grades_term3,$grade);
    }
    if (($grade->id==392||$grade->id==394||$grade->id==466)  ) {
        array_push($grades_term4,$grade);
    }
}

//print_object($studentdata);

$templatecontext = (object)[
    'studentname'=>$studentdata->firstname.$studentdata->lastname,
    'studentemail'=>$studentdata->email,
    'coursename'=>'Certificate IV in Building and Construction (Building)',
    'grades'=>array_values($grades),
    'grades_term1'=>array_values($grades_term1),
    'grades_term2'=>array_values($grades_term2),
    'grades_term3'=>array_values($grades_term3),
    'grades_term4'=>array_values($grades_term4),
    'url'=>$CFG->wwwroot
];
}
catch(Exception $e)
{
    echo "Message:".$e->getMessage();
}

echo $OUTPUT->render_from_template('block_student_dashboard/report_cert4',$templatecontext);


echo '<hr>';
//echo $content;

echo $OUTPUT->footer();