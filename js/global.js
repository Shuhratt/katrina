$(document).ready(function(){
	$('.user_forms button').on('click touchend', function() {


	});


	$('#categories-selector #placeholder').on('click touchend', function(event){
		$('#categories-selector>ul').toggleClass('closed');
	});

	$('#categories-selector a').on('click touchend', function(event){
		event.preventDefault();
		e=$(this);
		$('#categories-selector>input').val(e.attr('data-cid'));
		$('#categories-selector #placeholder').html(e.html());
		$('#categories-selector>ul').addClass('closed');
	});

	var url = window.location.toString();

		$('.user_account #sidebar li a').each(function(){
		var myhref= $(this).attr('href');
		if( url == myhref) {
		  $(this).parent('li').addClass('active');
		}
	});

	// Show/hide Report as
	$("#report").hover(function(){
		$(this).find("span").show();
	},
	function(){
		$(this).find("span").hide();
	});

	// phone, email
	 $.fn.textToggle = function(d, b, e) {
	    return this.each(function(f, a) {
	        a = $(a);
	        var c = $(d),
	            g = c.eq(0).text();
	        c.text(b).show();
	        $(a).click(function(b) {
	            b.preventDefault();
	            c.text(g);
	        })
	    })
	};

// map item
$('.showmap').click(function() {
	$(".maps").addClass('opeen');
	$(".close").show();

});
$('.close').click(function() {
	$(".maps").removeClass('opeen');
	$(".close").hide();
});

//hide text phone
$(".click-tel").click(function() {
	$(".textm").hide();
});
 $(".click-ema").click(function() {
	$(".textem").hide();
});

$(".alert_form .sub_button").addClass('alertbut');

$('.bottom').click(function() {
		 $('.dropdown-header-2').hide();
        var target_category = $(this).attr('data-id');
        $('.dropdown-header-2[data-subcategory=' + target_category + ']').show();
        return false;
    });

	jQuery(function($){
	$(document).mouseup(function (e){
		var div = $(".dropdown-header-2");
		if (!div.is(e.target)
		    && div.has(e.target).length === 0) {
			div.hide();
		}
	});
	});

	   $(".bottom").click(function(e) {
  e.preventDefault();
  $(".bottom").removeClass('selected');
  $(this).addClass('selected');
	});

	$('html').on('click', function(e){
  if (!$(event.target).closest('.bottom').length) {
    $('.bottom').removeClass('selected')}
	});

	 var url = window.location.toString();

  $('.header-mobile .header-line-mobile-next .tab a').each(function(){
    var myHref= $(this).attr('href');
    if( url == myHref) {
      $(this).parent('.tab').addClass('active');
    }
  });
});
