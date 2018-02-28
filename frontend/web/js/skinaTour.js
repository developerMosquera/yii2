/*
* @Author: amosquera
* @Date:   2018-02-16 09:56:43
* @Last Modified by:   amosquera
* @Last Modified time: 2018-02-16 13:51:36
*/

$(function() {

	var stepsOptions = new Array();
	$.each($('.skinaTour'), function(index, el) {
		var element = '#' + $(this).attr('id');
		var title = $(this).attr('titleTour');
		var content = $(this).attr('textTour');
		var placement = $(this).attr('placementTour');

		stepsOptions.push({element: element, title: title, content: content, placement: placement, backdrop: true});

	});

	var $menuTour, tour;
	$menuTour = $('#initTour');

	tour = new Tour({
		onStart: function() {
        	return $menuTour.addClass("disabled", true);
	    },
	    onEnd: function() {
			return $menuTour.removeClass("disabled", true);
		},
		debug: true,
		steps: stepsOptions
	}).init();

	$(document).on('click', '[data-tour]', function() {
		if ($(this).hasClass("disabled"))
		{
        	return;
      	}

      	tour.restart();
	});

});