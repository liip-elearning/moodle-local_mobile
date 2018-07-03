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
 * Redirect to the new URL, to defeat cookies or caching
 *
 * @package    local_mobile
 * @copyright  2018 Didier Raboud <odyx@liip.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');

global $CFG;

$serviceshortname  = required_param('service',  PARAM_ALPHANUMEXT);
$passport          = required_param('passport',  PARAM_RAW);    // Passport send from the app to validate the response URL.
$urlscheme         = optional_param('urlscheme', 'moodlemobile', PARAM_NOTAGS); // The URL scheme the app supports.
$confirmed         = optional_param('confirmed', false, PARAM_BOOL);  // If we are being redirected after user confirmation.
$oauthsso          = optional_param('oauthsso', 0, PARAM_INT); // Id of the OpenID issuer (for OAuth direct SSO).

$params = array();
$params['service']   = $serviceshortname;
$params['passport']  = $passport;
$params['urlscheme'] = $urlscheme;
$params['confirmed'] = $confirmed;
$params['oauthsso']  = $oauthsso;

error_log('local/mobile: launch.php called for '.$serviceshortname);
// Voluntarily sleep for 10 seconds, to increase incentive to fix this.
sleep(10);

redirect(new moodle_url('/admin/tool/mobile/launch.php', $params));
