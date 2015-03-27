var Form = (function(){

    var _public = {};
    var _private = {};

    _private.ajaxSettings = {
        beforeSubmit: function (arr, $form, options) {

            $form.find("input, select, textarea")
                 .removeClass('form-error');

            $form.find("input[type='submit']").prop('disabled', true);
			
			
			$('.loading').fadeIn(300);

            $form.find('.form-status')
                 .show()
                 .removeClass('form-error')
                 .removeClass('form-success')
                 .addClass('form-sending')
                 .html('');

            $form.find('.form-message')
                 .html('');
 
            if(_private.callback.on == 'beforeSubmit') {
                _private.callback.callback({
                    arr: arr,
                    $form: $form,
                    options: options,
                });
            }

        },
        success: function (result, status, xhr, $form) {

            $form.find('.form-status')
                 .removeClass('form-sending')
                 .addClass('form-success');

            setTimeout(function() {
                $('.form-success').slideUp('slow', function() {
                    $(this).html('').removeClass('form-success');
                });
            }, 5000);

            if($form.hasClass('form-clear')){
                $form.trigger('reset');
            }

            $form.find("input[type='submit']").prop('disabled', false);

            if(_private.callback.on == 'success') {
                _private.callback.callback({
                    result: result, 
                    status: status, 
                    xhr: xhr, 
                    $form: $form,
                });
            }
			
        },
        error: function (result, status, xhr, $form) {

            $form.find('.form-status')
                 .removeClass('form-sending')
                 .addClass('form-error');

            if (result.responseJSON.errors) {
                $.each(result.responseJSON.errors, function (key, value) {
                    if(key.search('.') !== -1) {
                        var key = key.split(".");
                        $.each(key, function(i, value) {
                            if(i == 0) {
                                key = value;
                            } else {
                                key+= "[" + value + "]";
                            }
                        });
                    }

                    var element = $form.find("input[name='" + key + "'], textarea[name='" + key + "'], select[name='" + key + "']");
                    
                    element.addClass('form-error')
                           .siblings('.form-message')
                           .addClass('error')
                           .text(value);
                });
            } 

            if (result.responseJSON.errorMessage) {
                $form.find('.form-status')
                     .removeClass('form-error')
                     .text(result.responseJSON.errorMessage);
            }

            $form.find("input[type='submit']").prop('disabled', false);

            if(_private.callback.on == 'error') {
                _private.callback.callback({
                    result: result, 
                    status: status, 
                    xhr: xhr, 
                    $form: $form,
                });
            }
			
			$('.loading').fadeOut(300);
        }
    }

    _public.submit = function(form, callback){

        _private.callback = callback || 'undefined';
        form.ajaxSubmit(_private.ajaxSettings);

        return false;

    }

    _public.observer = function() {

        $(document).ajaxComplete(function(event, xhr) {
            
            if(xhr.responseText === 'undefined') {
                return false;
            }

            var response = JSON.parse(xhr.responseText);

            if(response.redirect && response.timeout) {
                setTimeout(function() {
                    window.location = response.redirect;
                }, response.timeout);
            } else if(response.redirect) {
                window.location = response.redirect;
            }

        });

    }

    _public.slug = function(str, $to, separator) {

        separator  = separator  || '-';

        $to.val(getSlug(str, separator)).trigger('change');

    }

    _public.setActionBar = function() {
		var sibheight=$('.siblings').height();
		var profooter=$(window).height()-(70+sibheight);
		$('body > .container').css('min-height',profooter);
		
		var foot = $('.footer').position().top;
		var scroll=$(window).scrollTop()+$(window).height();

		if(foot>(scroll)){
			$('.action-bar').css('position','fixed');
			$('.action-bar').css('top','initial');
		}else{
			$('.action-bar').css('position','absolute');
			$('.action-bar').css('top',foot-90);
		}

    }

    _public.floatLabel = function($inputs, event) {
        event = event || '';

        $inputs.each(function() {
			if(!$(this).parent().hasClass('fixed-label')){
				if($(this).val() !== '' || event == 'focus') {
					$(this).siblings('label').css('color',"#929292");
					$(this).siblings('label').animate({
						top: 0,
						fontSize: 13
					}, 500);
					
				} else {
					if ($(this).parents('.form-fieldset').length){
						$(this).siblings('label').css('color',"#FFFFFF");
					}else{
						$(this).siblings('label').css('color',"#354052");
					}
					$(this).siblings('label').animate({
						top: 28,
						fontSize: 18
					}, 500);
				}
            }
        });
    }

    _public.select = function() {

        $('select').each(function() {
			$(this).selectize();
		});

    }
	
    _public.collectionOptions = function() {

        $('.collection-options input').selectize({
			plugins: ['remove_button','drag_drop'],
			delimiter: ';',
			persist: false,
			create: function(input) {
				return {
					value: input,
					text: input
				}
			}
		});

    }

    _public.bindCollections = function() {

        $('#bind_collections').selectize({
			plugins: ['remove_button','drag_drop'],
			delimiter: ';',
			persist: false,
			create: function(input) {
				return {
					value: input,
					text: input
				}
			}
		});

    }

    _public.wysiwyg = function($element) {

        $element.trumbowyg({btns: ['bold', 'italic', 'link']});

    }

    _public.date = function($element) {

        $element.datetimepicker({
            timepicker: false,
            mask: true,
            format: 'd/m/Y',
        });

    }

    _public.time = function($element) {

        $element.datetimepicker({
            datepicker: false,
            mask: true,
            format: 'H:i',
        });

    }

    _public.currency = function($element) {

        $element.mask('000.000.000.000.000,00', {
            reverse: true
        });

    }

    _public.phone = function($element) {

        $element.mask('(00) 0000-00009');

    }

    _public.number = function($element) {

        $element.mask('0#');

    }

    _public.csrf = function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content'),
            },
            cache: true,
        });

    }

    return _public;

}());