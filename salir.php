<?php
/**
 * Wkidudas - salir.php
 * 
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2007 Bartolomé Sintes Marco
 * @license   http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @version   2007-03-14
 * @link      http://www.mclibre.org
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  any later version.
 *   
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *   
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
session_start();
session_unset();
session_destroy();
*/
session_start();
session_unset();
session_destroy();
//session_regenerate_id(true);
header('Location:index.php');
exit();
?>
