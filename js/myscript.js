jQuery(document).ready(function($) {
$timer = setInterval(showNextTestimonial, 3000);
$('.gx-it-team-testimonial').hover(function () {
clearInterval($timer);
},function (){
$timer = setInterval(showNextTestimonial, 3000);
});

$('.left-button').click(function(){
var prevItem = $('.quote-block .item.active').prev();
if(prevItem.length==0){
prevItem = $('.quote-block .item:last-child');
}
$('.quote-block .item.active').hide();
$('.quote-block .item.active').removeClass('active');
prevItem.fadeIn();
prevItem.addClass('active');
});

function showNextTestimonial(){
var item = $('.quote-block .item.active');
var nextItem = $('.quote-block .item.active').next();
if(nextItem.length==0){
nextItem = $('.quote-block .item:first-child');
}
$('.quote-block .item.active').hide();
$('.quote-block .item.active').removeClass('active');
nextItem.fadeIn();
nextItem.addClass('active');
}

$('.right-button').click(showNextTestimonial);


});