/*
	Copyright Gregory Tomlinson 2009
	gregory.tomlinson [at] gmail [dot] com
	http://www.gregorytomlinson.com/encoded/
	
	Dependencies : jQuery 1.2.6
	
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

var LastFMPipe = {
	url : 'http://ws.audioscrobbler.com/2.0/?method=user.getRecentTracks', 
	page : 'http://www.last.fm/user/',
	user : 'gregory80', // default, override via options
	pageName : 'Recently on Last.fm',
	count : 5,
	bx : '',
	init : function( bx, options ) {
		this.bx = jQuery( bx );	
		this.user = options && options.user || this.user;
		this.count = options && options.count || this.count;
		this.connector();	
	},

	connector : function() {
		var self = this;
		jQuery.ajax({
		  dataType: 'jsonp',
		  data : 'limit=' + this.count + '&format=json&api_key=0e08a37f63207afd22b959c4ba7a2c3e&user=' + this.user,
		  jsonp: 'callback',
		  url: this.url,
		  success: function ( jsonObj ) {
			self.display( jsonObj );
		  }
		});
	},
	
	display : function( jo ) {		
		var ul = this.bx;
		for( i=0;i<jo.recenttracks.track.length;i++ ) {
			this.renderItems( jo.recenttracks.track[i] ).appendTo( ul );
		}
	},
	
	renderItems : function( itm ) {
		var li = jQuery("<li />"), n = new Date(), t = Math.round( (n.getTime() / 1000 - parseInt( itm.date.uts )) / 60 ),
			ago = " ",
			a = jQuery("<a />")
				.html( itm.name ).attr( "href", itm.url ).attr("target", "_blank").appendTo( li );

			ago += ( t <= 1 ) ? "Now" : ( t < 60 ) ? t + " mins ago" : ( t < 3600 ) ? Math.round( t/60) + " hours ago" : Math.ceil( t/3600) + " days ago";
		var span = jQuery("<span />").html( "<i>" + itm.artist['#text'] + "</i>" + ago ).addClass("sp_list_itm_span").appendTo( li );
		
		return li;
	}
}

/* Init the Buttons for Action */
jQuery(document).ready( function($) {
	try{
		var t= jQuery('#recent_on_last_fm_itm_list')[0];
		var options = { user : t.getAttribute('user'), count : t.getAttribute('count') };
		LastFMPipe.init( t, options );	
	} catch(e) {}
});