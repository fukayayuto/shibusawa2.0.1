$('.navTrigger').on('click',function(){
  if($(this).hasClass('active')){
    $(this).removeClass('active');
    $('nav').fadeOut();
	$('body').removeClass('fixed');
  } else {
    $(this).addClass('active');
    $('nav').fadeIn();
	$('body').addClass('fixed');
  }
});

$(function () {
  $('.js-modal-open').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      $(modal).fadeIn();
        $("body").addClass("fixed");
      return false;
    });
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
        $("body").removeClass('fixed');
    return false;
  });
});


$(function () {
	$('.historyToggle').on('click',function(){
		$('#backHistory').slideToggle();
});
});