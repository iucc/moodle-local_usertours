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

/**
 * Tour helper.
 *
 * @package    local_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_usertours;

/**
 * Tour helper.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {

    /**
     * @var MOVE_UP
     */
    const MOVE_UP = -1;

    /**
     * @var MOVE_DOWN
     */
    const MOVE_DOWN = 1;

    /**
     * Get the link to edit the step.
     *
     * If no stepid is specified, then a link to create a new step is provided. The $targettype must be specified in this case.
     *
     * @param   int     $tourid     The tour that the step belongs to.
     * @param   int     $stepid     The step ID.
     * @param   int     $targettype The type of step.
     *
     * @return moodle_url
     */
    public static function get_edit_step_link($tourid, $stepid = null, $targettype = null) {
        $link = new \moodle_url('/local/usertours/configure.php');

        if ($stepid) {
            $link->param('action', manager::ACTION_EDITSTEP);
            $link->param('id', $stepid);
        } else {
            $link->param('action', manager::ACTION_NEWSTEP);
            $link->param('tourid', $tourid);
            $link->param('targettype', $targettype);
        }

        return $link;
    }

    /**
     * Get the link to move the tour.
     *
     * @param   int     $tourid     The tour ID.
     * @param   int     $direction  The direction to move in
     *
     * @return moodle_url
     */
    public static function get_move_tour_link($tourid, $direction = self::MOVE_DOWN) {
        $link = new \moodle_url('/local/usertours/configure.php');

        $link->param('action', manager::ACTION_MOVETOUR);
        $link->param('id', $tourid);
        $link->param('direction', $direction);
        $link->param('sesskey', sesskey());

        return $link;
    }

    /**
     * Get the link to move the step.
     *
     * @param   int     $stepid     The step ID.
     * @param   int     $direction  The direction to move in
     *
     * @return moodle_url
     */
    public static function get_move_step_link($stepid, $direction = self::MOVE_DOWN) {
        $link = new \moodle_url('/local/usertours/configure.php');

        $link->param('action', manager::ACTION_MOVESTEP);
        $link->param('id', $stepid);
        $link->param('direction', $direction);
        $link->param('sesskey', sesskey());

        return $link;
    }

    /**
     * Get the link ot create a new step.
     *
     * @param   int         $tourid     The ID of the tour to attach this step to.
     * @param   int         $targettype The type of target.
     *
     * @return  moodle_url              The required URL.
     */
    public static function get_new_step_link($tourid, $targettype = null) {
        $link = new \moodle_url('/local/usertours/configure.php');
        $link->param('action', manager::ACTION_NEWSTEP);
        $link->param('tourid', $tourid);
        $link->param('targettype', $targettype);

        return $link;
    }

    /**
     * Get the link used to show/hide a tour.
     *
     * @param   int         $tourid     The ID of the tour to display.
     * @param   int         $visibility The intended visibility.
     * @return  moodle_url              The URL.
     */
    public static function get_show_hide_tour_link($tourid, $visibility) {
        $url = new \moodle_url('/local/usertours/configure.php', [
                'id' => $tourid,
                'sesskey' => sesskey(),
            ]);

        if ($visibility) {
            $url->param('action', manager::ACTION_SHOWTOUR);
        } else {
            $url->param('action', manager::ACTION_HIDETOUR);
        }

        return $url;
    }

    /**
     * Get the link used to view the tour.
     *
     * @param   int         $tourid     The ID of the tour to display.
     * @return  moodle_url              The URL.
     */
    public static function get_view_tour_link($tourid) {
        return new \moodle_url('/local/usertours/configure.php', [
                'id'        => $tourid,
                'action'    => manager::ACTION_VIEWTOUR,
            ]);
    }

    /**
     * Get the link used to edit the tour.
     *
     * @param   int         $tourid     The ID of the tour to edit.
     * @return  moodle_url              The URL.
     */
    public static function get_edit_tour_link($tourid = null) {
        $link = new \moodle_url('/local/usertours/configure.php');

        if ($tourid) {
            $link->param('action', manager::ACTION_EDITTOUR);
            $link->param('id', $tourid);
        } else {
            $link->param('action', manager::ACTION_NEWTOUR);
        }

        return $link;
    }

    /**
     * Get the link used to import the tour.
     *
     * @return  moodle_url              The URL.
     */
    public static function get_import_tour_link() {
        $link = new \moodle_url('/local/usertours/configure.php', [
                'action'    => manager::ACTION_IMPORTTOUR,
            ]);

        return $link;
    }

    /**
     * Get the link used to export the tour.
     *
     * @param   int         $tourid     The ID of the tour to export.
     * @return  moodle_url              The URL.
     */
    public static function get_export_tour_link($tourid) {
        $link = new \moodle_url('/local/usertours/configure.php', [
                'action'    => manager::ACTION_EXPORTTOUR,
                'id'        => $tourid,
            ]);

        return $link;
    }

    /**
     * Get the link used to delete the tour.
     *
     * @param   int         $tourid     The ID of the tour to delete.
     * @return  moodle_url              The URL.
     */
    public static function get_delete_tour_link($tourid) {
        return new \moodle_url('/local/usertours/configure.php', [
                'id'        => $tourid,
                'action'    => manager::ACTION_DELETETOUR,
                'sesskey'   => sesskey(),
            ]);
    }

    /**
     * Get the link for listing tours.
     *
     * @return  moodle_url              The URL.
     */
    public static function get_list_tour_link() {
        $link = new \moodle_url('/local/usertours/configure.php');
        $link->param('action', manager::ACTION_LISTTOURS);

        return $link;
    }

    /**
     * Get a filler icon for display in the actions column of a table.
     *
     * @param   string      $url            The URL for the icon.
     * @param   string      $icon           The icon identifier.
     * @param   string      $alt            The alt text for the icon.
     * @param   string      $iconcomponent  The icon component.
     * @param   array       $options        Display options.
     * @return  string
     */
    public static function format_icon_link($url, $icon, $alt, $iconcomponent = 'moodle', $options = array()) {
        global $OUTPUT;

        return $OUTPUT->action_icon(
                $url,
                new \pix_icon($icon, $alt, $iconcomponent, [
                        'title' => $alt,
                    ]),
                null,
                $options
                );

    }

    /**
     * Get a filler icon for display in the actions column of a table.
     *
     * @param   array       $options        Display options.
     * @return  string
     */
    public static function get_filler_icon($options = array()) {
        global $OUTPUT;

        return \html_writer::span(
            $OUTPUT->pix_icon('t/filler', '', 'local_usertours', $options),
            'action-icon'
        );
    }

    /**
     * Get the link for deleting steps.
     *
     * @param   int         $stepid     The ID of the step to display.
     * @return  moodle_url              The URL.
     */
    public static function get_delete_step_link($stepid) {
        return new \moodle_url('/local/usertours/configure.php', [
                'action'    => manager::ACTION_DELETESTEP,
                'id'        => $stepid,
                'sesskey'   => sesskey(),
            ]);
    }

    /**
     * Get all of the tours.
     *
     * @return  stdClass[]
     */
    public static function get_tours() {
        global $DB;

        $tours = $DB->get_records('usertours_tours', array(), 'enabled DESC, sortorder ASC');
        $return = [];
        foreach ($tours as $tour) {
            $return[$tour->id] = tour::load_from_record($tour);
        }
        return $return;
    }

    /**
     * Get the specified tour.
     *
     * @param   int         $tourid     The tour that the step belongs to.
     * @return  stdClass
     */
    public static function get_tour($tourid) {
        return tour::instance($tourid);
    }

    /**
     * Fetch the tour with the specified sortorder.
     *
     * @param   int         $sortorder  The sortorder of the tour.
     * @return  tour
     */
    public static function get_tour_from_sortorder($sortorder) {
        global $DB;

        $tour = $DB->get_record('usertours_tours', array('sortorder' => $sortorder));
        return tour::load_from_record($tour);
    }

    /**
     * Return the count of all tours.
     *
     * @return  int
     */
    public static function count_tours() {
        global $DB;

        return $DB->count_records('usertours_tours');
    }

    /**
     * Reset the sortorder for all tours.
     */
    public static function reset_tour_sortorder() {
        global $DB;
        $tours = $DB->get_records('usertours_tours', null, 'sortorder ASC, pathmatch DESC', 'id, sortorder');

        $index = 0;
        foreach ($tours as $tour) {
            if ($tour->sortorder != $index) {
                $DB->set_field('usertours_tours', 'sortorder', $index, array('id' => $tour->id));
            }
            $index++;
        }
    }


    /**
     * Get all of the steps in the tour.
     *
     * @param   int         $tourid     The tour that the step belongs to.
     * @return  stdClass[]
     */
    public static function get_steps($tourid) {
        global $DB;

        $order = 'sortorder ASC';

        $steps = $DB->get_records('usertours_steps', array('tourid' => $tourid), $order);
        $return = [];
        foreach ($steps as $step) {
            $return[$step->id] = step::load_from_record($step);
        }
        return $return;
    }

    /**
     * Fetch the specified step.
     *
     * @param   int         $stepid     The id of the step to fetch.
     * @return  step
     */
    public static function get_step($stepid) {
        return step::instance($stepid);
    }

    /**
     * Fetch the step with the specified sortorder.
     *
     * @param   int         $tourid     The tour that the step belongs to.
     * @param   int         $sortorder  The sortorder of the step.
     * @return  step
     */
    public static function get_step_from_sortorder($tourid, $sortorder) {
        global $DB;

        $step = $DB->get_record('usertours_steps', array('tourid' => $tourid, 'sortorder' => $sortorder));
        return step::load_from_record($step);
    }

    /**
     * Handle addition of the tour into the current page.
     */
    public static function bootstrap() {
        global $PAGE;

        if ($tour = manager::get_current_tour()) {
            $PAGE->requires->js_call_amd('local_usertours/usertours', 'init', [
                    $tour->get_id(),
                    $tour->should_show_for_user(),
                    $PAGE->context->id,
                ]);
        }
    }

    /**
     * Add the reset link to the current page.
     */
    public static function bootstrap_reset() {
        if (manager::get_current_tour()) {
            echo \html_writer::link('', get_string('resettouronpage', 'local_usertours'), [
                    'data-action'   => 'local_usertours/resetpagetour',
                ]);
        }
    }
}
