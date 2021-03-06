#!/bin/sh
#
# Copyright (c) 2003 Gunars Benga (e-mail: benga@parks.lv; gbenga@users.sourceforge.net)
# 
# This file is part of SANE Web Interface.
# 
# SANE Web Interface is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 		
# SANE Web Interface is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 		
# You should have received a copy of the GNU General Public License
# along with SANE Web Interface; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#

spooldir="/usr/local/httpd/htdocs/scanner/spool/"	# <-- adjust if needed

rm -f $spooldir/*.png
rm -f $spooldir/*.tiff
rm -f $spooldir/*.bmp
rm -f $spooldir/*.gif
