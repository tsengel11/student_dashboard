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

$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_detail.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Grade Details');

function print_term_head($termno){
    $result='';
    $result.='<h4><b>'.$termno.'</b></h4>';
    $result='<thead>
                <tr>
                    <th style="width: 500px">UNIT NAME</th>
                    <th style="width: 80px">Written Activity</th>
                    <th style="width: 80px">Summative Assessment</th>
                    <th style="width: 80px">Overrall</th>
                </tr>
            </thead>';
    return $result ;
}

function get_grade_letter($grade)
{
    $result = '';
    if($grade==50){
        $result = 'Submitted';
    }
    if else ($grade>50||$grade<100){
        $result = 'Require Re-submission';
    }
    if else ($grade==100){
        $result = 'Satisfactory';
    }
    return $result;
}

function print_unit($course_id){
    global $DB;
    $result = '';
    $course_data = $DB->get_record('course',array('id'=>$course_id),'*', MUST_EXIST);
    //*print_r($course_data);
    
    $writen_grade = $DB->get_record_sql('
        SELECT  round(finalgrade/rawgrademax*100,2) as grade FROM {grade_grades} as g
        left join {grade_items} as i on g.itemid = i.id
        where i.courseid = :courseid
        and userid = :userid
        and itemname = "Written Activity"',['courseid'=>$course_id,'userid'=>2]);


    $result.= '
    <tbody>
        <tr>
            <th>'.$course_data->fullname.'</th>
            <th>'.get_grade_letter($writen_grade).'</th>
            <th>Submitted</th>
            <th>Require Re-submission</th>
        </tr>
    </tbody>';

    return $result;
}

echo $OUTPUT->header();


$content='';
$content.=html_writer::start_div('container');


$content.='<table class="table">';

$content.=print_term_head('Term 1');

$content.= print_unit(382);
$content.= '</table>';

$content.= '<h4><b>Term 2</b></h4>';
$content.= '<h4><b>Term 3</b></h4>';
$content.= '<h4><b>Term 4</b></h4>';
$content.=html_writer::end_div();

echo $content;
echo '<hr>';
//echo $content;

echo $OUTPUT->footer();