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

        
        $content = '';
        // $content .=' <a href="'.$attendance_url.'">Attendance |</a>';
        // $content .=' <a href="'.$online_lecture_url.'">Online Lectures |</a>';
        // $content .=' <a href="'.$askliberty_url.'">Ask Liberty(9am-5pm)</a>';


        $link_att= html_writer::link($attendance_url,'Attendance',array('style'=>'color: #1a1a1a'));
        $link_online=html_writer::link($online_lecture_url,'Online Lectures',array('style'=>'color: #1a1a1a'));
        $link_ask=html_writer::link($askliberty_url,'Ask Liberty(9am-5pm)',array('style'=>'color: #1a1a1a'));
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
        text-align: center;'));
        $content .= html_writer::div($menus,"grid-container",array('style'=>'  display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        padding: 5px;'));

        $couse_map = array(
            'Carpentry'=>212,
            'Carpentry N'=>212,
            'Wall'=>214,
            'Wall N'=>214,
            'Cert IV'=> 301,
        )
        ;
        # Hide for temporary
        $content .= '<h5>My Grade:</h5>';
        try{
            $plan_name_object = $DB->get_records('user_info_data', ['userid' => $user_id]);
            $plan_name = reset($plan_name_object)->data;

            $plan_name_array = explode(" + ",$plan_name);
                foreach($plan_name_array as $plan) {       
                    $course_code = $couse_map[$plan];                   
                    $sql = "SELECT count(2) as num FROM {user_enrolments} as u
                            left join {enrol} as e on u.enrolid=e.id
                            WHERE userid =:userid AND courseid=:courseid";                  
                    $param = ['userid'=>$user_id,'courseid'=>$course_code];       
                    $result = $DB->count_records_sql($sql,$param);      
                    if ($result>0){                
                        $grade_url = $link."/course/user.php?mode=grade&id=".$course_code."&user=".$user_id;
                        $grade_name = $DB->get_field('course','fullname',array('id' => $course_code));
                        # Hide for temporary
                        $content .= '<li>'.html_writer::link($grade_url,$grade_name).'</li>';
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
