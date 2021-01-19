<?php
if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configcheckbox(
        'block_student_dashboard/showcourses',
        get_string('showcourses', 'block_student_dashboard'),
        get_string('showcoursesdesc', 'block_student_dashboard'),
        0
    ));
}
