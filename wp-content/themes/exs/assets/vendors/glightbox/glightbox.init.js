'use strict';
//IIFE
;(function(d,w,gid) {
	var galleryBlockBox = new GLightbox({
		selector: '.blocks-gallery-item  figure a'
	});
	var imageVideoLinkBlockBox = new GLightbox({
		selector: 'a[href*="youtube"], a[href*="youtu.be"]'
	});
})(document,window,document.getElementById.bind(document));