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

$user_id = $USER->id;

$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_cert4.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Grade Details');




function get_written_grade($course_id,$user_id){
    global $DB;
    //die($user_id);
    $writen_grade = $DB->get_record_sql('
        SELECT  round(finalgrade/rawgrademax*100,2) as grade FROM {grade_grades} as g
        left join {grade_items} as i on g.itemid = i.id
        where i.courseid = :courseid
        and userid = :userid
        and itemname = "Written Activity"',['courseid'=>$course_id,'userid'=>$user_id]);

    return $writen_grade->grade;
}

function get_summative_grade($course_id,$user_id){
    global $DB;
    $summative_grade = $DB->get_record_sql('
        SELECT  round(finalgrade/rawgrademax*100,2) as grade FROM {grade_grades} as g
        left join {grade_items} as i on g.itemid = i.id
        where i.courseid = :courseid
        and userid = :userid
        and itemname = "Summative Activities"',['courseid'=>$course_id,'userid'=>$user_id]);

    return $summative_grade->grade;
}


echo $OUTPUT->header();

$templatecontext = (object)[
    'texttodisplay'=>'Diploma of Building and Construction (Building)',
    'users'=>array_values($users),
    'cohorts'=>array_values($dip_cohorts),
    'groupname'=>$dip_cohorts[$selected_groupid]->name
];

echo $OUTPUT->render_from_template('block_student_dashboard/report_cert4',$templatecontext);


echo '<hr>';
//echo $content;

echo $OUTPUT->footer();