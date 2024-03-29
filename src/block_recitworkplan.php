<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


include_once($CFG->dirroot . '/course/lib.php');
include_once($CFG->dirroot . '/local/recitworkplan/lib.php');

class block_recitworkplan extends block_list {
    function init() {
        global $CFG;
        $url = new moodle_url($CFG->wwwroot . '/local/recitworkplan/view.php');
        $this->title = "<a href='".$url->out()."'>".get_string('pluginname', 'block_recitworkplan')."</a>";
    }

    function has_config() {
        return true;
    }
    
    public function hide_header() {
        return true;
    }

    function get_content() {
        global $USER, $PAGE, $CFG;
        $PAGE->requires->css(new moodle_url($CFG->wwwroot . '/local/recitworkplan/react/build/index.css'), true);
        $PAGE->requires->js(new moodle_url($CFG->wwwroot . '/local/recitworkplan/react/build/index.js'), true);
        $studentId = $USER->id;
        $mode = $this->isTeacher() ? 'ab' : 'sb';
        

        $this->content = new stdClass;
        $this->content->footer = sprintf("<h5>%s</h5>", $this->title) . sprintf("<div id='recit_workplan' data-user-id='%ld' data-mode='%s'></div>", $studentId, $mode);
        $this->content->text = '';
        return $this->content;
    }

    function isTeacher(){
        global $DB, $USER;
        return $DB->record_exists_sql('select id from {role_assignments} where userid=:userid and roleid in (select roleid from {role_capabilities} where capability=:name1 or capability=:name2)', ['userid' => $USER->id, 'name1' => RECITWORKPLAN_ASSIGN_CAPABILITY, 'name2' => RECITWORKPLAN_MANAGE_CAPABILITY]);
    }

}


