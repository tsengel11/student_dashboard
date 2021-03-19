<?php

/**
 * Version details
 *
 * @package    local_grade_notification
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function get_grade_letter($grade)
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
            style = "
            ">Satisfactory</div>';
        }
        elseif ($grade==50){
            $result = '<div
            class =" text-center" 
            style = "
            ">Submitted</div>';
        }
        elseif ($grade==0){
            $result = '<div 
            class = " text-center"
            style = ";
            ">Not Submitted</div>';
        }
        elseif ($grade>50 || $grade<100){
            $result = '<div 
            class =" text-center "
            style = " color:red"
            ">Require Re-submission</div>';
        }
        
     }
     return $result;

}

function greate_link($id,$name,$url){
    return '<b><a href="'.$url.'/course/view.php?id='.$id.'">'.$name.'</a></b>';
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
    ROUND(SUM(IF(i.itemname = 'Practical Assessment',
                g.finalgrade / g.rawgrademax * 100,
                NULL)),
            1) AS 'previous2',
    ROUND(SUM(IF(i.itemtype = 'course',
                g.finalgrade / g.rawgrademax * 100,
                NULL)),
            1) AS 'overrall'
FROM
    lcau999_moodle_test.mdl_grade_grades AS g
        LEFT JOIN
    mdl_grade_items AS i ON g.itemid = i.id
        LEFT JOIN
    mdl_course AS c ON i.courseid = c.id
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
GROUP BY i.courseid";


$para = ['user_id'=>$userid];
$result = $DB->get_records_sql($sql,$para);
return $result;
}




