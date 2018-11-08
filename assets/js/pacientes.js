'use strict';

function editarPaciente(index)
{
    //Nodos tabla
    var idpaciente = index.parentNode.parentNode.cells[0].textContent;
    var cedula = index.parentNode.parentNode.cells[1].textContent;
    var nombres = index.parentNode.parentNode.cells[2].textContent;
    var apellidos = index.parentNode.parentNode.cells[3].textContent;
    var sexo = index.parentNode.parentNode.cells[4].textContent;
    var correo = index.parentNode.parentNode.cells[5].textContent;
    var idempresa = index.parentNode.parentNode.cells[6].textContent;

    //Pego en el formulario
    document.getElementById('idpaciente').value = idpaciente;
    document.getElementById('cedula').value = cedula;
    document.getElementById('nombres').value = nombres;
    document.getElementById('apellidos').value = apellidos;
    //document.getElementById('sexo').value = sexo;
    document.getElementById('correo').value = correo;
    //document.getElementById('idempresa').value = idempresa;
}

function eliminarPaciente(index)
{
	var idpaciente = index.parentNode.parentNode.cells[0].textContent;
    var cedula = index.parentNode.parentNode.cells[1].textContent;
    var nombres = index.parentNode.parentNode.cells[2].textContent;
    var apellidos = index.parentNode.parentNode.cells[3].textContent;

    //Pego en el formulario
    document.getElementById('idpacienteEliminar').value = idpaciente;
    document.getElementById('datos_paciente').innerHTML = `${nombres} ${apellidos}`;
}