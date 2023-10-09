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

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once($CFG->dirroot . '/mod/mootimeter/backup/moodle2/restore_mootimeter_stepslib.php');

/**
 * Restore class for mod_mootimeter
 *
 * @package     mod_mootimeter
 * @copyright   2023, ISB Bayern
 * @author      Stefan Hanauska <stefan.hanauska@csg-in.de>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_mootimeter_activity_task extends restore_activity_task {

    /**
     * No specific settings for this activity
     *
     * @return void
     */
    protected function define_my_settings(): void {
    }

    /**
     * Defines the restore step for mootimeter
     *
     * @return void
     */
    protected function define_my_steps(): void {
        $this->add_step(new restore_mootimeter_activity_structure_step('mootimeter_structure', 'mootimeter.xml'));
    }

    /**
     * Calls decode functions of other plugins for the intro field.
     *
     * @return array
     */
    public static function define_decode_contents(): array {
        $contents = [];
        $contents[] = new restore_decode_content('mootimeter', ['intro'], 'mootimeter');
        return $contents;
    }

    /**
     * Defines rules for decoding links to view.php in restore step
     *
     * @return array
     */
    public static function define_decode_rules(): array {
        $rules = [];
        $rules[] = new restore_decode_rule('MOOTIMETERVIEWBYID', '/mod/mootimeter/view.php?id=$1', 'course_module');
        return $rules;
    }
}
