//<![CDATA[

/*
    name : lastfm
    file : jquery.lastfm.js
    author : gregory tomlinson
    (c) gregory tomlinson
    Dual licensed under the MIT and GPL licenses.
    ///////////////////////////
    ///////////////////////////        
    dependencies : jQuery 1.3.2
    ///////////////////////////
    ///////////////////////////    

*/

(function($) {

    $.fn.lastfm = function( options ) {
        // extend the defaults settings
        var el, o = $.extend(true, {}, defaults, options);
        $bod = $( document.body );
        el = this;
        connector( o.url, o.params, success );
        return this;        
        
        /**
        *    Declare any functions that require local scoping
        *
        */
        function success(jo) {
            // access to el & o here
            if( o.params.limit > 1 && jo.recenttracks.track.length ) {
                for( i=0;i<jo.recenttracks.track.length;i++ ) {
                    renderItems( jo.recenttracks.track[i] ).appendTo( el );
                }
            } else {
                // handle the non array returned
                renderItems( jo.recenttracks.track ).appendTo( el );
            }
        }
        
        function handleDate( itm ) {
            var n=new Date(), t, ago = " ";
            if( itm.date && itm.date.uts ) {
              t =   Math.round( (n.getTime()/1000 - parseInt( itm.date.uts ) )/60 );
              ago += handleSinceDateEndings( t, itm.date.uts );
            } else {
                ago += "Now";
            }
            return ago;            
            
        }
   

        function handleSinceDateEndings( t, original_timestamp ) {
            var ago = " ", date;
            if( t <= 1 ) {
                ago += "Now";
            } else if( t<60) {
                ago += t + " mins ago";
            } else if( t>= 60 && t<= 120) {
                ago += Math.floor( t / 60 ) + " hour ago"
            } else if( t<1440 ) {
                //console.log(t)
                ago += Math.floor( t / 60 )  + " hours ago";
            } else if( t< 2880) {
                ago +=  "1 day ago";
            } else if( t > 2880  && t < 4320 ) {
                ago +=  "2 days ago";
            } else {
                date = new Date( parseInt( original_timestamp )*1000 ) 
                //console.log(date)
                ago += o.months[ date.getMonth() ] + " " + date.getDate();
            }
            return ago;
        }        
        
        function renderItems( itm ) {
            var li = $("<li />"), ago = handleDate(itm),
                a = $("<a />")
                    .html( itm.name ).attr( "href", itm.url )
                    .attr("target", "_blank").appendTo( li );
    
            var span = $("<span />").html( "<i>" + itm.artist['#text'] + "</i>" + ago )
                                    .addClass("sp_list_itm_span").appendTo( li );
            
            return li;
        }        
        
    /* end the plugin function */
    }
    
    /**
    *    Declare the defaults here
    */
    var defaults = {
    
        url : 'http://ws.audioscrobbler.com/2.0/?method=user.getRecentTracks',
        page : 'http://www.last.fm/user/',        
        user : 'gregory80', // default, override via options
        pageName : 'Recently on Last.fm',
        params : {
            limit : 5,
            format : 'json',            
            api_key : '0e08a37f63207afd22b959c4ba7a2c3e',
            user : 'gregory80'
        },
        months : ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        
    }, $bod;
    
    /**
    *    JSONP Connector, get data from a remote source
    */
    
    function connector(url, params, callback) {
        var str = $.param( params );
        $.ajax({
            dataType: 'jsonp',
            data : str,
            jsonp: 'callback',
            'url' : url,
            success: callback            
        });
    }

})(jQuery);

//]]>