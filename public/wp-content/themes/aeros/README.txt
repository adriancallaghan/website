WORDPRESS THEME 
AEROS	

Installation:

1) Extract the zip-file on your Desktop Computer

2) Upload your aeros directory on your Webhosting Account into the directory /wp-content/themes/

3) Activate the Theme from your Wordpress admin area, click "DESIGN" resp. "Presentation" and select the theme



To change the BACKGROUND IMAGE:

Make your custom Background Image. Size it to 1024px height to make it fit also for larger screens. 
JPG-Files with lower quality ensure fast loading times - quality doesn't need to be too high in browsers. 
File size should be under 100 KB in the end. Copy your image into the /images folder of the theme. 

Then look for

	body {
        	background: url(images/default.jpg) no-repeat 0 0 #fff;
        	background-attachment:fixed;
        	color: #000;
        	font-family: Arial, Verdana, sans-serif;
        	margin: 0;
        	padding: 0;
	}

in the style.css file and replace

        	background: url(images/default.jpg) no-repeat 0 0 #fff;

with your own image file. This may look like

        	background: url(images/myimage.jpg) no-repeat 0 0 #fff;

and safe the style.css file. 
     


See CHANGELOG.txt for the version history.


LICENSE:

    Aeros is a WordPress theme
    Copyright (C) 2008  TheBuckmaker.com

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
