<?php
/*
Plugin Name: MyPlugin
Description: A starter plugin template.
Plugin URI:  https://nbagonoc.com/
Author:      Niccu Bagonoc
Version:     1.0
Text Domain: myplugin
License:     GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/


// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//include if admin
if(is_admin()){
	//require_once plugin_dir_path( __FILE__ ).'admin/menu.php';
}
// include if public
require_once plugin_dir_path( __FILE__ ).'includes/functions.php';