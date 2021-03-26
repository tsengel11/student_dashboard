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

global $DB, $USER, $CFG;

require_once($CFG->dirroot . '/blocks/student_dashboard/lib.php');

$user_id = $USER->id;

if(isset($_GET['id'])){
    $user_id = $_GET['id'];
}


$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_dip.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Grade Details');

// Retrieving Diploma Grades of student


$grades_dip = get_gradedip($user_id);
$studentdata = get_studentdata($user_id);

echo $OUTPUT->header();

//print_object($grades);

$grades_term1 = array();
$grades_term2 = array();
$grades_term3 = array();
$grades_term4 = array();

$url = $CFG->wwwroot;

foreach($grades_cert4 as $grade)
{
    $grade->overall = get_grade_letter_overall($grade->overall);
    $grade->summative = get_grade_letter($grade->summative);
    $grade->written = get_grade_letter($grade->written);
    $grade->previous1 = get_grade_letter(max($grade->previous1,$grade->previous2) ) ;
    $grade->link = greate_link($grade->id,$grade->fullname,$url);
    

    if (($grade->id==380||$grade->id==381||$grade->id==382||$grade->id==383||$grade->id==384||$grade->id==468||$grade->id==389)  ) {
        array_push($grades_term1,$grade);
    }
}

if($USER->id==237){
    print_object($grades_dip);
}

foreach($grades_dip as $grade)
{
    $grade->overall = get_grade_letter_overall($grade->overall);
    $grade->summative = get_grade_letter($grade->summative);
    $grade->written = get_grade_letter($grade->written);
    $grade->link = greate_link($grade->id,$grade->fullname,$url);
    if (($grade->id==487||$grade->id==457||$grade->id==451||$grade->id==450)  ) {
        array_push($grades_term2,$grade);
    }
    if (($grade->id==547||$grade->id==458||$grade->id==453||$grade->id==452)  ) {
        array_push($grades_term3,$grade);
    }
    if (($grade->id==441||$grade->id==440||$grade->id==439)  ) {
        array_push($grades_term4,$grade);
    }
}

$templatecontext = (object)[
    'studentname'=>$studentdata->firstname.$studentdata->lastname,
    'studentemail'=>$studentdata->email,
    'coursename'=>'Diploma in Building and Construction (Building)',
    'grades'=>array_values($grades),
    'grades_term1'=>array_values($grades_term1),
    'grades_term2'=>array_values($grades_term2),
    'grades_term3'=>array_values($grades_term3),
    'grades_term4'=>array_values($grades_term4),
    'url'=>$CFG->wwwroot
];

echo $OUTPUT->render_from_template('block_student_dashboard/report_diploma',$templatecontext);
echo '<hr>';
//echo $content;
echo $OUTPUT->footer();