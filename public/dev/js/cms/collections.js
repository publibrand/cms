var Collections = (function() {

    var _private = {};
    var _public = {};
    
    _public.addField = function(fieldNumber) {

        $.post(BASEURL + "/collections/addField", {
            fieldNumber: fieldNumber,
        }).done(function(data){
			var posi=$('.add-field').position().top;
			$('html, body').animate({scrollTop:(posi)},300);
            $('.form-fields').append('<div class="mu" style="float:left;width: 100%;height:299px;display:none;"></div>');
			$('.mu').slideDown(300,function(){
				$('.mu').remove();
				$('.form-fields').append(data.view);
				
				Form.setActionBar();
				Form.select();
			});
        });

    }

    _public.addCollectionFields = function(fieldNumber, collection_id) {

        $.post(BASEURL + "/collections/addCollectionFields", {
            fieldNumber: fieldNumber,
            collection_id: collection_id,
        }).done(function(data){
            $('.form-fields').append(data.view);
			Form.setActionBar();
			Form.select();
			Form.collectionOptions();
        });

    }

    _public.removeField = function($formField) {

        $formField.remove();

    }

    _public.search = function(query) {

        $.post(BASEURL + "/collections/search", {
            query: query,
        }).done(function(data) {
            $collections = $('.dashboard-collections .collections');
            $collections.children()
                        .remove()
                        .end()
                        .append(data.view);
        });

    }


    return _public;

}());


$('form.collection-form').on('click', '.add-field', function () {

    var fieldNumber = $(this).attr('data-field-number');
    
    $(this).attr('data-field-number', parseInt(fieldNumber) + 1);

    Collections.addField(fieldNumber);

});

$('form.collection-form').on('click', '.remove-field', function () {

    $formField = $(this).parent().parent();

    Collections.removeField($formField);

});

$('form.collection-form').on('keyup', '#name', function () {

    Form.slug($(this).val(), $('#slug'));

});

$('form.collection-form').on('keyup', '.field-name', function () {

    var $field = $(this).parent().parent().find('.field-label');

    Form.slug($(this).val(), $field, '_');

});

$('form.collection-form').on('change', 'select', function () {
    var $options = $(this).parent().parent().find('.collection-options');

    if($(this).hasClass("collection-type") && $(this).val() == 'select') {
        $options.fadeIn();
		Form.collectionOptions();
    } else {
        $options.fadeOut();
        $options.find('input')
                .val('');
    }

});

$('form.search-form').on('submit', function (event) {
    
    event.preventDefault();

    Collections.search($(this).val());

});

$('form.search-form').on('keyup', "input[name='query']", function () {
    
    Collections.search($(this).val());

});