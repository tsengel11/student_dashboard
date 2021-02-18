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
global $DB;
$user_id = $USER->id;

$PAGE->set_url(new moodle_url('/blocks/student_dashboard/grade_detail.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Grade Details');

echo $user_id;