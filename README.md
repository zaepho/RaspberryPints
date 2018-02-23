RaspberryPints (RPints) is a digital upgrade to the conventional chalkboard taplist, created just for the home brewer. Display your current beers on tap with a sleek, digital presentation. Manage your beers, recipes, kegs, and taps with our built-in tracking system.

# Installation
* Install Composer (https://getcomposer.org/installer)
* Download RPints source to desired web directory
* Import sql/schema.sql
* Create includes/dbconfig.php:
```
<?php
global $dbconfig;
$dbconfig['dbhost'] = 'localhost';
$dbconfig['dbprefix'] = '';
$dbconfig['dbuser'] = 'Username';
$dbconfig['dbpass'] = 'Password';
?>
```

# Licensing

	GNU GENERAL PUBLIC LICENSE
	Version 3, 29 June 2007

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.

Full license text available in 'LICENSE.md'.


Questions? Comments? Want to Contribute?
http://www.homebrewtalk.com/f51/initial-release-raspberrypints-digital-taplist-solution-456809/

Inspired by Kegerface:
http://github.com/kegerface/kegerface
