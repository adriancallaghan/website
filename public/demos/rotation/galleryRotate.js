/*
 * 
 * crappy bit of Js, by ade
 * 
 * just preloads an array of images, 
 * when change is fired, the target element specified will be updated with the next image in the array
 * loops through
 * 
 * Usage:
 * 1. instantiate with an array of images
 * 2. bind change to an event, such as mousedown/click specifiying the target element 
 */
function GalleryRotate ($images){  
	
	
	this.preload = function () {
		
	    $(this.images).each(function(){
	        $('<img/>')[0].src = this;
	    });
	}
	
	this.change = function($element){

		$img = this.images[this.imgNo];
		
		if ($element){
			$($element).attr("src", $img);
		}
		else alert($img);
		
		this.imgNo++;
		
		if (this.imgNo==this.images.length){
			this.imgNo=0;
		}
		
		return false;
	}
	
	this.init = function ($images) {
		
		this.images = $images;
		this.imgNo=0;
		this.preload();	
		
	}

	this.init($images);
}