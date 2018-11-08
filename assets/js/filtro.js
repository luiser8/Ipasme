'use strict';

//Filtro de la tabla pacientes
function filtro(btnBuscar, tabla){
	$(btnBuscar).on("keyup", function() {
	   var value = $(this).val().toLowerCase();
	   $(`${tabla} tr`).filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	   });
  });
}