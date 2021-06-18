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


$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_carp.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Grade Details');

// Retrieving CertIV Grades of student

$grades = get_gradecert4($user_id);
$studentdata = get_studentdata($user_id);

echo $OUTPUT->header();
try  
        {
$url = $CFG->wwwroot;
$users=get_userlist_carp_oneuser($user_id);

foreach($users as $user){
    $user->userlink=convert_userlink_without_td($user->userid,$user->firstname,$user->lastname,$url);
    // Quizes
    //Term 1
    $user->cpccwhs1001=convert_grade_quiz_carp($user->cpccwhs1001,$user->userid);
    $user->cpccohs2001a=convert_grade_quiz_carp($user->cpccohs2001a,$user->userid);
    $user->cpccohs2001a_practical=convert_grade_one_item_carp($user->cpccohs2001a_practical,$user->userid,2868,"PA");
    $user->cpcccm1012a=convert_grade_quiz_carp($user->cpcccm1012a,$user->userid);
    $user->cpcccm1012a_practical=convert_grade_one_item_carp($user->cpcccm1012a_practical,$user->userid,2442,"PA");
    $user->cpcccm1013a=convert_grade_quiz_carp($user->cpcccm1013a,$user->userid);
    $user->cpcccm1013a_practical=convert_grade_one_item_carp($user->cpcccm1013a_practical,$user->userid,2803,"PA",2804,"PH");
    $user->cpcccm1014a=convert_grade_quiz_carp($user->cpcccm1014a,$user->userid);
    $user->cpcccm1014a_practical=convert_grade_one_item_carp($user->cpcccm1014a_practical,$user->userid,2561,"PA");
    // Term 2
    $user->cpcccm1015a=convert_grade_quiz_carp($user->cpcccm1015a,$user->userid);
    $user->cpcccm1015a_practical=convert_grade_one_item_carp($user->cpcccm1015a_practical,$user->userid,2695,"PA");
    $user->cpcccm2001a=convert_grade_quiz_carp($user->cpcccm2001a,$user->userid);
    $user->cpcccm2001a_practical=convert_grade_one_item_carp($user->cpcccm2001a_practical,$user->userid,2697,"PA");
    $user->cpccca2011a=convert_grade_quiz_carp($user->cpccca2011a,$user->userid);
    $user->cpccca2011a_practical=convert_grade_carp($user->cpccca2011a_practical,$user->userid,2807,"SW",2805,"PH");
    $user->cpccca2002b=convert_grade_quiz_carp($user->cpccca2002b,$user->userid);
    $user->cpccca2002b_practical=convert_grade_carp($user->cpccca2002b_practical,$user->userid,2808,"SW",2806,"PH");
    $user->cpccca3002a=convert_grade_quiz_carp($user->cpccca3002a,$user->userid);
    $user->cpccca3002a_practical=convert_grade_carp($user->cpccca3002a_practical,$user->userid,2801,"SW",2802,"PH");
    // Term 3

    $user->cpccca3003a=convert_grade_quiz_carp($user->cpccca3003a,$user->userid);
    $user->cpccca3003a_practical=convert_grade_carp($user->cpccca3003a_practical,$user->userid,2809,"SW",2810,"PH");
    $user->cpccca3004a=convert_grade_quiz_carp($user->cpccca3004a,$user->userid);
    $user->cpccca3004a_practical=convert_grade_carp($user->cpccca3004a_practical,$user->userid,2811,"SW",2812,"PH");
    $user->cpccsh3008=convert_grade_quiz_carp($user->cpccsh3008,$user->userid);
    $user->cpccsh3008_practical=convert_grade_carp($user->cpccsh3008_practical,$user->userid,2813,"SW",2815,"PH");
    $user->cpccca3010a=convert_grade_quiz_carp($user->cpccca3010a,$user->userid);
    $user->cpccca3010a_practical=convert_grade_carp($user->cpccca3010a_practical,$user->userid,2814,"SW",2816,"PH");
    $user->cpccca3017b=convert_grade_quiz_carp($user->cpccca3017b,$user->userid);
    $user->cpccca3017b_practical=convert_grade_carp($user->cpccca3017b_practical,$user->userid,2817,"SW",2818,"PH");
    // TERM 4
    $user->cpccca3007c=convert_grade_quiz_carp($user->cpccca3007c,$user->userid);
    $user->cpccca3007c_practical=convert_grade_carp($user->cpccca3007c_practical,$user->userid,2819,"SW",2828,"PH");
    $user->cpccca3005b=convert_grade_quiz_carp($user->cpccca3005b,$user->userid);
    $user->cpccca3005b_practical=convert_grade_carp($user->cpccca3005b_practical,$user->userid,2820,"SW",2824,"PH");
    $user->cpccca3008b=convert_grade_quiz_carp($user->cpccca3008b,$user->userid);
    $user->cpccca3008b_practical=convert_grade_carp($user->cpccca3008b_practical,$user->userid,2821,"SW",2825,"PH");
    $user->cpccca3006b=convert_grade_quiz_carp($user->cpccca3006b,$user->userid);
    $user->cpccca3006b_practical=convert_grade_carp($user->cpccca3006b_practical,$user->userid,2822,"SW",2826,"PH");
    $user->cpccca3023a=convert_grade_quiz_carp($user->cpccca3023a,$user->userid);
    $user->cpccca3023a_practical=convert_grade_carp($user->cpccca3023a_practical,$user->userid,2823,"SW",2827,"PH");
    // TERM 5
    $user->cpcccm2007b=convert_grade_quiz_carp($user->cpcccm2007b,$user->userid);
    $user->cpcccm2007b_practical=convert_grade_carp($user->cpcccm2007b_practical,$user->userid,2829,"SW",2837,"PH");
    $user->cpcccm2002a=convert_grade_quiz_carp($user->cpcccm2002a,$user->userid);
    $user->cpcccm2002a_practical=convert_grade_carp($user->cpcccm2002a_practical,$user->userid,2833,"SW",2838,"PH");
    $user->cpcccm2010b=convert_grade_quiz_carp($user->cpcccm2010b,$user->userid);
    $user->cpcccm2010b_practical=convert_grade_carp($user->cpcccm2010b_practical,$user->userid,2830,"SW",2834,"PH");
    $user->cpcccm2008b=convert_grade_quiz_carp($user->cpcccm2008b,$user->userid);
    $user->cpcccm2008b_practical=convert_grade_carp($user->cpcccm2008b_practical,$user->userid,2831,"SW",2836,"PH");
    $user->cpccca3001a=convert_grade_quiz_carp($user->cpccca3001a,$user->userid);
    $user->cpccca3001a_practical=convert_grade_carp($user->cpccca3001a_practical,$user->userid,2832,"SW",2835,"PH");
    // TERM 6
    $user->cpccsf2004a=convert_grade_quiz_carp($user->cpccsf2004a,$user->userid);
    $user->cpccsf2004a_practical=convert_grade_carp($user->cpccsf2004a_practical,$user->userid,2839,"SW",2844,"PH");
    $user->cpccco2013a=convert_grade_quiz_carp($user->cpccco2013a,$user->userid);
    $user->cpccco2013a_practical=convert_grade_carp($user->cpccco2013a_practical,$user->userid,2840,"SW",2842,"PH");
    $user->cpccca2003a=convert_grade_quiz_carp($user->cpccca2003a,$user->userid);
    $user->cpccca2003a_practical=convert_grade_carp($user->cpccca2003a_practical,$user->userid,2841,"SW",2843,"PH");
    $user->bsbsmb406=convert_grade_quiz_carp($user->bsbsmb406,$user->userid);
    $user->bsbsmb301=convert_grade_quiz_carp($user->bsbsmb301,$user->userid);
    $user->bsbsmb301_practical=convert_grade_one_item_carp($user->bsbsmb301_practical,$user->userid,2161,"PA");
}

    //print_object($user);

$templatecontext = (object)[
    'studentname'=>$studentdata->firstname.' '.$studentdata->lastname,
    'studentemail'=>$studentdata->email,
    'coursename'=>'Certificate III in Carpentry',
    'users'=>array_values($users),
    'url'=>$CFG->wwwroot
    ];
}
catch(Exception $e)
{
    echo "Message:".$e->getMessage();
}

echo $OUTPUT->render_from_template('block_student_dashboard/report_carp',$templatecontext);


echo '<hr>';
//echo $content;

echo $OUTPUT->footer();