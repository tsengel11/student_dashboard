<?php
// This file is part of Moodle - http://moodle.org/

/**
 * Form for editing HTML block instances.
 *
 * @package   block_student_dashboard
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */




class block_student_dashboard extends block_base
{

    function init()
    {
        $this->title = 'Student Dashboard';
    }

    function has_config()
    {
        return true;
    }

    public function get_total_unit()
    {
    }
    function get_content()
    {

        global $DB, $USER, $CFG;
        require_once(__DIR__ . '/../../config.php');
       

        if ($this->content !== NULL) {
            return $this->content;
        }

        //$content .= $USER->firstname;
        //$showcourses = get_config('block_student_dashboard', 'showcourses');
        $user_id = $USER->id;
        $link = $CFG->wwwroot;
        
        $attendance_url = $link."/course/view.php?id=297";
        $online_lecture_url = $link."/course/view.php?id=436";
        $askliberty_url = $link."/message/index.php?id=2";
        $resources_url = $link."/course/view.php?id=435";
        $tutorial_url = $link."/course/view.php?id=879";

        
        $content = '';
        // $content .=' <a href="'.$attendance_url.'">Attendance |</a>';
        // $content .=' <a href="'.$online_lecture_url.'">Online Lectures |</a>';
        // $content .=' <a href="'.$askliberty_url.'">Ask Liberty(9am-5pm)</a>';


        $link_att= html_writer::link($attendance_url,'Attendance',array('style'=>'color: #1a1a1a'));
        $link_online=html_writer::link($online_lecture_url,'Online Lectures',array('style'=>'color: #1a1a1a'));
        $link_ask=html_writer::link($askliberty_url,'Ask Liberty(9am-5pm)',array('style'=>'color: #1a1a1a'));
        $link_res=html_writer::link($resources_url,'Resources',array('style'=>'color: #1a1a1a'));
        $link_tutorial= html_writer::link($tutorial_url,'Tutorials',array('style'=>'color: #1a1a1a'));

        $menus = 
         html_writer::div($link_att,'grid-item1',array('style'=>'  background-color: #62b1dc;
         border: 2px solid #e5e4e2;
         padding: 10px;
         font-size: 20px;
         text-align: center;'))
        .html_writer::div($link_online,'grid-item2',array('style'=>'  background-color: #f4c34a;
        border: 2px solid #e5e4e2;
        padding: 10px;
        font-size: 20px;
        text-align: center;'))
        .html_writer::div($link_ask ,'grid-item3',array('style'=>'  background-color: #f3903b;
        border: 2px solid #e5e4e2;
        padding: 10px;
        font-size: 20px;
        text-align: center;'))
         .html_writer::div($link_tutorial,'grid-item1',array('style'=>'  background-color: #62b1dc;
         border: 2px solid #e5e4e2;
         padding: 10px;
         font-size: 20px;
         text-align: center;'))
        .html_writer::div($link_res ,'grid-item4',array('style'=>'  background-color: #A7C957;
        border: 2px solid #e5e4e2;
        padding: 10px;
        font-size: 20px;
        text-align: center;'));
        $content .= html_writer::div($menus,"grid-container",array('style'=>'  display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        padding: 5px;'));


        $couse_map = array(
            'Whitecard'=>0,
            'Carpentry'=>212,
            'Carpentry N'=>212,
            'Wall'=>214,
            'Wall N'=>214,
            'Cert IV'=> 301,
            'Dip'=>668
        );
        $couse_map_newcpc = array(
            'Whitecard'=>0,
            'Carpentry'=>873,
            'Wall'=>874,
            'Cert IV'=> 876,
            'Dip'=>875
        );

        
        # Hide for temporary
        $content .= '<hr>';
        $content .= '<h5>My Grade:</h5>';
        try{

            $check_new_cpc_student = 0;

            $plan_name_object = $DB->get_records('user_info_data', ['userid' => $user_id]);
            $plan_name = reset($plan_name_object)->data;
            $plan_name_array = explode(" + ",$plan_name);
                foreach($plan_name_array as $plan) {       
                    "";

                    $check_newcpc_sql = "SELECT 
                        *
                    FROM
                        {cohort_members}
                    WHERE
                        cohortid IN (SELECT 
                                id
                            FROM
                                {cohort}
                            WHERE
                                name LIKE 'new%')
                    AND userid =:user_id";
                    $check_newpcpc_para = ['user_id'=>$user_id];
                    $check_new_cpc_student = $DB->record_exists_sql($check_newcpc_sql,$check_newpcpc_para);

                    $carpentry_coursecode=212;
                    $wall_coursecode=214;
                    $carpentry_totalunit=30;
                    $wall_totalunit=19;
                    $course_code = $couse_map[$plan];
                    
                    if($check_new_cpc_student==1){
                        $course_code = $couse_map_newcpc[$plan];
                        $wall_totalunit=19;
                    }
                    //$content.= $course_code ;

                    //$content.= $couse_map[$plan];


                    // $carpentry_coursecode=212;
                    // $wall_coursecode=214;
                    // $carpentry_totalunit=30;
                    // $wall_totalunit=19;
                    
                    // Checking enrollment of Grading reports
                    $sql = "SELECT count(2) as num FROM {user_enrolments} as u
                            left join {enrol} as e on u.enrolid=e.id
                            WHERE userid =:userid AND courseid=:courseid";                  
                    $param = ['userid'=>$user_id,'courseid'=>$course_code];     
                    $result = $DB->count_records_sql($sql,$param);

                    // If student enrolled in grading report, it will show the grading report link
                    if ($result>0){
                        $grade_url = $link."/course/user.php?mode=grade&id=".$course_code."&user=".$user_id;
                        $grade_name = $DB->get_field('course','fullname',array('id' => $course_code));
                        # Hide for temporary

                        switch ($course_code) {
                            case 301:
                                $grade_url = $link."/blocks/student_dashboard/grade_cert4.php";
                              break;
                            case 668:
                                $grade_url = $link."/blocks/student_dashboard/grade_dip.php";
                              break;
                            case 212:
                                $grade_url = $link."/blocks/student_dashboard/grade_carp.php";
                              break;
                            case 874:
                                $grade_url = $link."/blocks/student_dashboard/grade_wall_new.php";
                              break;
                            case 873:
                                $grade_url = $link."/blocks/student_dashboard/grade_carp_new.php";
                              break;
                            case 876:
                                $grade_url = $link."/blocks/student_dashboard/grade_cert4_new.php";
                              break;
                            case 875:
                                $grade_url = $link."/blocks/student_dashboard/grade_dip_new.php";
                              break;         
                            default:
                              echo "Your favorite color is neither red, blue, nor green!";
                          }
                        

                        $content .= '<li>'.html_writer::link($grade_url,$grade_name).'</li>';
                        #$content.=$DB->set_debug(true);

                        ## Counting satesfied unit number

                        # The carpentry units have diffrent sturtures.
                        if(($course_code==$carpentry_coursecode)||($course_code==$wall_coursecode))
                        {
                            $sql_count = "SELECT 
                            COUNT(*) as units
                        FROM
                            (SELECT 
                                SUM(finalgrade) / SUM(rawgrademax) AS grade,
                                    SUBSTRING_INDEX(i.itemname, ':', 1) AS unit_code
                            FROM
                            {grade_grades} AS g
                            LEFT JOIN {grade_items} AS i ON g.itemid = i.id
                            WHERE
                                i.courseid = :courseid AND g.userid = :userid
                                    AND i.itemtype = 'mod'
                            GROUP BY unit_code) AS grade_count
                        WHERE
                            grade >= 1";
                        $total_units=$carpentry_totalunit;
                        // Checking the Wall and Floor Course
                        $param_count=array('userid'=>$user_id,'courseid'=>$course_code);

                        }
                        else{
                            $sql_count="SELECT 
                            COUNT(2) as units
                        FROM
                            {grade_grades} AS g
                                LEFT JOIN
                            {grade_items} AS i ON g.itemid = i.id
                        WHERE
                        courseid=:courseid AND i.itemtype = 'mod'
                                AND userid =:userid
                                AND g.finalgrade / g.rawgrademax >= 1 ";

                        $param_count_total=array('courseid'=>$course_code,'itemtype'=>'mod');
                        $total_units=$DB->count_records('grade_items',$param_count_total);

                        }

                        if($couse_map[$plan]==214)
                        {
                            echo "wall";
                            $total_units=19;
                        }

                        $param_count=array('userid'=>$user_id,'courseid'=>$course_code);
                        $satisfy_units=$DB->get_record_sql($sql_count,$param_count);

                        $percent= round($satisfy_units->units/$total_units*100);
                         
                        $print_progress_bar = '';
                        $print_progress_bar.=html_writer::start_div('progress');
                        
                        $print_progress_bar.=html_writer::start_div('progress-bar progress-bar-warning progress-bar-striped',
                                array(
                                    'role'=>"progressbar",
                                    'aria-valuenow'=>$percent,
                                    'aria-valuemin'=>"0",
                                    'aria-valuemax'=>"100",
                                    'style'=>"width:".$percent."%"
                                ));
                            $completed_text="Completed ";
                            $percent_text='';
                            if($percent>=20){
                                $percent_text=$completed_text.strval($satisfy_units->units)." of ".$total_units." Units";   
                            }

                            elseif ($percent<20){
                                $completed_text = "";
                                $percent_text=$completed_text.strval($satisfy_units->units)." of ".$total_units." Units";   
                                if($percent<10)
                                {
                                    $percent_text='';
                                }
                            }
                  
                            $print_progress_bar.=$percent_text;

                            $print_progress_bar.=html_writer::end_div();

                            $print_progress_bar.=html_writer::end_div();
                            $content.='<table style="width:90%"><tr><th style="width:130px;text-align:right">Study Progress: </th><th>'.$print_progress_bar.'</th></tr></table>';
                            $content.='<p></p>';
                    }      
                    else{

                    }
                    
                }
        }
            catch(Exception $e){
                echo "Message:".$e->getMessage();
            }
        $this->content = new stdClass;
        $this->content->text = $content;
        
        //$this->content->footer = 'this is the footera';
        return $this->content;
        print_object($plan_name_object);
        
    }
}
