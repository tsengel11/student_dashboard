<?php

/**
 * Version details
 *
 * @package    local_grade_notification
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function convert_overall($grade)
{
    //die($grade);
    $result = '';
     if($grade == null){
        $result = '<div
        class "class="text-center" 
        style = "
        "> - </div>';
     }
     else
     {
        if($grade==100){
            //$result = 'Satisfactory';
            $result = '<div
            class =" text-center" 
            style = " color:green"
            ">Satisfactory</div>';
        }
        elseif ($grade==0){
            $result = '<div 
            class = " text-center"
            style = " ;
            ">Not Enrolled</div>';
        }
        else{
            $result = '<div
            class =" text-center text-danger" 
            style = "
            ">Not Yet Completed</div>';
        }

        
     }
     return $result;

}




function get_grade_letter_1($grade)
{
    //die($grade);
    $result = '';
     if($grade == null){
        $result = '<div
        class "class="text-center" 
        style = "
        "> - </div>';
     }
     else
     {
        if($grade==100){
            //$result = 'Satisfactory';
            $result = '<div
            class =" text-center" 
            style = " color:green"
            ">Satisfactory</div>';
        }
        elseif ($grade==50){
            $result = '<div
            class =" text-center text-primary" 
            style = "
            ">Submitted</div>';
        }
        elseif ($grade==0){
            $result = '<div 
            class = " text-center"
            style = " ;
            ">Not Submitted</div>';
        }
        elseif ($grade>50 || $grade<100){
            $result = '<div 
            class =" text-center  "
            style = " color:red"
            ">Require Re-submission</div>';
        }
        
     }
     return $result;

}

function greate_link($id,$name,$url){
    return '<b><small><a href="'.$url.'/course/view.php?id='.$id.'">'.$name.'</a></small></b>';
}

function get_studentdata($userid)
{
    global $DB;
    return $DB->get_record('user',['id'=>$userid]);

}


function get_gradecert4($userid)
    { 
    global $DB;
    $sql = "SELECT
    c.id, 
    c.fullname,
    ROUND(SUM(IF(i.itemname = 'Written Activities',
                g.finalgrade / g.rawgrademax * 100,
                NULL)),
            1) AS 'written',
    ROUND(SUM(IF(i.itemname = 'Summative Activities',
                g.finalgrade / g.rawgrademax * 100,
                NULL)),
            1) AS 'summative',
    ROUND(SUM(IF(i.itemname = 'Summative and Performance Activities',
                g.finalgrade / g.rawgrademax * 100,
                NULL)),
            1) AS 'previous1',
    ROUND(SUM(IF((i.itemname = 'Practical Assessment')||(i.itemname = 'Practical')||(i.itemname = 'Practical Assessment Version 1')||(i.itemname = 'Practical Assessment Version 2')||(i.itemname = 'Work Health & Safety Incident Report Form'),
                g.finalgrade / g.rawgrademax * 100,
                NULL)),
            1) AS 'previous2',
    ROUND(SUM(IF(i.itemtype = 'course',
                g.finalgrade / g.rawgrademax * 100,
                NULL)),
            1) AS 'overall'
FROM
    {grade_grades} AS g
        LEFT JOIN
    {grade_items} AS i ON g.itemid = i.id
        LEFT JOIN
    {course} AS c ON i.courseid = c.id
WHERE
    i.courseid IN (380 , 381,
        382,
        383,
        384,
        385,
        386,
        387,
        388,
        389,
        390,
        391,
        392,
        394,
        466,
        468)
        AND userid = :user_id
GROUP BY i.courseid
order by c.fullname";


$para = ['user_id'=>$userid];
$result = $DB->get_records_sql($sql,$para);
return $result;
}

function get_gradedip($userid){
    global $DB;
 $sql = "SELECT c.id,
 c.fullname,
 ROUND(SUM(IF(i.itemname = 'Written Activities'||(i.itemname = 'Written Assessment'),
             g.finalgrade / g.rawgrademax * 100,
             NULL)),
         1) AS 'written',
 ROUND(SUM(IF((i.itemname = 'Summative Activities')||(i.itemname = 'Summative Assessment'),
             g.finalgrade / g.rawgrademax * 100,
             NULL)),
         1) AS 'summative',
 ROUND(SUM(IF(i.itemtype = 'course',
             g.finalgrade / g.rawgrademax * 100,
             NULL)),
         1) AS 'overall'
FROM
 {grade_grades} AS g
     LEFT JOIN
 {grade_items} AS i ON g.itemid = i.id
     LEFT JOIN
 {course} AS c ON i.courseid = c.id
WHERE
 i.courseid IN (
    450,
    451,
    457,
    487,
    452,
    453,
    458,
    547,
    439,
    440,
    441)
 AND userid = :user_id
GROUP BY i.courseid";
$para = ['user_id'=>$userid];
$result = $DB->get_records_sql($sql,$para);
return $result;
}


function get_activity_grade($courseid,$quizid,$user_id){
    $result = grade_get_grades($courseid, 'mod', 'quiz',$quizid, $user_id);
    print_object($result);
    return $result->items[0];
}





