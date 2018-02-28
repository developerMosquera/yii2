/*
* @Author: amosquera
* @Date:   2018-02-22 09:21:06
* @Last Modified by:   amosquera
* @Last Modified time: 2018-02-28 08:16:10
*/

var stepsOptions = [
	{
		element: "#menuLeftApp",
    	title: "Menú de navegación",
    	content: "Aquí puedes acceder a los diferentes modulos de la aplicación",
    	backdrop: true,
    	duration: 5,
	},
	{
		element: "#accessApp",
    	title: "Accesos",
    	content: "Aquí puedes configurar los roles y operaciones que tendrán los usuarios",
    	backdrop: true
	},
	{
		element: "#usersApp",
    	title: "Usuarios",
    	content: "Aquí puedes crear, editar, eliminar los usuarios y sus roles",
    	backdrop: true
	}
]

$(function() {

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

	$(document).on('click', '#initTour', function() {
      	tour.restart();
	});

});