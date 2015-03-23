$(document).ready(function() {

    Laravel.initialize();

    Form.csrf();

    Form.observer();

    $('body').on('submit', 'form.ajax-form', function () {

        return Form.submit($(this));

    });

    Form.floatLabel($('.form-float-label input, .form-float-label textarea'));

    $('body').on('focus keyup blur change', '.form-float-label input, .form-float-label textarea',  function(event){
		Form.floatLabel($(this), event.type);
    });

    $('.dashboard .collections').on('click', '.collection-drop', function() {
        $(this).siblings('.collection-actions').fadeToggle();
    })

    Form.wysiwyg($('.field-wysiwyg'));

    Form.date($('.field-date'));

    Form.time($('.field-time'));

    Form.phone($('.field-phone'));

    Form.currency($('.field-currency'));
	
    Form.number($('.field-number'));

    $('body').on('click', '.minimize', function() {
        $(this).fadeOut(function(){
            if($(this).text() == '-') {
                $(this).addClass('active').text('+');
            } else {
                $(this).removeClass('active').text('-');
            }
            $(this).fadeIn();
        })
        $(this).parent().siblings().slideToggle();
    });

    $('body').on('click', '.analytics-charts .maximize', function() {
        $(this).fadeOut(function(){
            if($(this).text() == '+') {
                $(this).addClass('active').text('-');
            } else {
                $(this).removeClass('active').text('+');
            }
            $(this).fadeIn();
        });

        $('.analytics-page-views').slideToggle();
    });

    $('.bars').on('click', function() {
        $('.menu-list').slideToggle();
    });

    $('.list-line .drop').on('click', function() {
        $(this).parent().toggleClass('active');
    });

    $('.menu-list li').on('click', function() {
        if($(window).width() <= 768) {
            $(this).find('ul').slideToggle();
        }
    });
	
	
	Form.setActionBar();
	$(window).scroll(function(event){
		Form.setActionBar();
	});
	
	
	$('form.ajax-form').on('submit', function() {
		if($('.action-bar').length){
			var loadWidth = $('.action-bar input[type="submit"]').width()+102;
			$('.action-bar input[type="submit"]').before('<span class="loader"></span>');
			$( ".loader" ).animate({
				width: loadWidth,
				marginRight: "-"+(loadWidth+7)
			}, 500, function(){
				$( ".loader" ).remove();
			});
		}
    });
	
	$('body').on('click', '.field-boolean label', function() {$(this).toggleClass('checked');});
	
	
	$('select').selectize();
	Form.collectionOptions();
	
	
	
	$('.sortable-list').sortable({
		handle: ".handle",
		stop: function( event, ui ) {
			var reordered = [];
			var slug = $(this).data('slug');
			$('.list-line').each(function(){
				var rel = $(this).attr('rel');
				reordered.push(rel);
			});
			$.post(BASEURL + "/registers/"+ slug +"/reorder", {
				reordered: reordered,
			}).done(function(data){
				
			});
		}
	});
	$('.sortable-list').disableSelection();
	
	
});