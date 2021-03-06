'use strict';

function editar(valor, index){
    switch(valor){
        case 'paciente':
            editarPaciente(index);
        break;
        case 'usuario':
            editarUsuario(index);
        break;
        case 'medico':
            editarMedico(index);
        break;
        case 'especialidad':
            editarEspecialidad(index);
        break;
        case 'empresa':
            editarEmpresa(index);
        break;
        case 'estudio':
            editarEstudio(index);
        break;
        case 'tipopaciente':
            editarTipopaciente(index);
        break;        
        case 'examenes':
            editarExamenes(index);
        break;        
        case 'familiar':
            editarFamiliar(index);
        break;
        default:
            "Ninguno";
        break;
    }
}

function cambiarclave(valor, index)
{
    //Pego en el formulario
    document.getElementById(valor).value = index;
}

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
    document.getElementById('cedula_paciente').value = cedula;
    document.getElementById('nombres_paciente').value = nombres;
    document.getElementById('apellidos_paciente').value = apellidos;
    //document.getElementById('sexo').value = sexo;
    document.getElementById('correo_paciente').value = correo;
    //document.getElementById('idempresa').value = idempresa;
}

function editarFamiliar(index)
{
    //Nodos tabla
    var idfamiliar = index.parentNode.parentNode.cells[0].textContent;
    var cedula = index.parentNode.parentNode.cells[1].textContent;
    var nombres = index.parentNode.parentNode.cells[3].textContent;
    var apellidos = index.parentNode.parentNode.cells[4].textContent;
    var correo = index.parentNode.parentNode.cells[6].textContent;

    //Pego en el formulario
    document.getElementById('idfamiliar').value = idfamiliar;
    document.getElementById('cedula_familiar').value = cedula;
    document.getElementById('nombres_familiar').value = nombres;
    document.getElementById('apellidos_familiar').value = apellidos;
    //document.getElementById('sexo').value = sexo;
    document.getElementById('correo_familiar').value = correo;
    //document.getElementById('idempresa').value = idempresa;
}

function editarUsuario(index)
{
    //Nodos tabla
    var idusuario = index.parentNode.parentNode.cells[0].textContent;
    var cedula = index.parentNode.parentNode.cells[1].textContent;
    var nombres = index.parentNode.parentNode.cells[2].textContent;
    var apellidos = index.parentNode.parentNode.cells[3].textContent;
    var nivel = index.parentNode.parentNode.cells[4].textContent;
    var correo = index.parentNode.parentNode.cells[5].textContent;
    var cuenta = index.parentNode.parentNode.cells[6].textContent;

    //Pego en el formulario
    document.getElementById('idusuario').value = idusuario;
    document.getElementById('cedula_usuario').value = cedula;
    document.getElementById('nombres_usuario').value = nombres;
    document.getElementById('apellidos_usuario').value = apellidos;
    //document.getElementById('sexo').value = sexo;
    document.getElementById('correo_usuario').value = correo;
    document.getElementById('cuenta_usuario').value = cuenta;
    //document.getElementById('idempresa').value = idempresa;
}

function editarMedico(index)
{
    //Nodos tabla
    var idmedico = index.parentNode.parentNode.cells[0].textContent;
    var cedula = index.parentNode.parentNode.cells[1].textContent;
    var nombres = index.parentNode.parentNode.cells[2].textContent;
    var apellidos = index.parentNode.parentNode.cells[3].textContent;
    var firma = index.parentNode.parentNode.cells[4].textContent;
    //var especialidad = index.parentNode.parentNode.cells[5].textContent;

    //Pego en el formulario
    document.getElementById('idmedico').value = idmedico;
    document.getElementById('cedula_medico').value = cedula;
    document.getElementById('nombres_medico').value = nombres;
    document.getElementById('apellidos_medico').value = apellidos;
    //document.getElementById('sexo').value = sexo;
    document.getElementById('firma_medico').value = firma;
}

function editarEspecialidad(index)
{
    //Nodos tabla
    var idespecialidad = index.parentNode.parentNode.cells[0].textContent;
    var nombre = index.parentNode.parentNode.cells[1].textContent;
    var descripcion = index.parentNode.parentNode.cells[2].textContent;
    //var especialidad = index.parentNode.parentNode.cells[5].textContent;

    //Pego en el formulario
    document.getElementById('idespecialidad').value = idespecialidad;
    document.getElementById('nombre_especialidad').value = nombre;
    document.getElementById('descripcion_especialidad').value = descripcion;
}

function editarEmpresa(index)
{
    //Nodos tabla
    var idempresa = index.parentNode.parentNode.cells[0].textContent;
    var nombre = index.parentNode.parentNode.cells[1].textContent;
    var descripcion = index.parentNode.parentNode.cells[2].textContent;
    //var especialidad = index.parentNode.parentNode.cells[5].textContent;

    //Pego en el formulario
    document.getElementById('idempresa').value = idempresa;
    document.getElementById('nombre_empresa').value = nombre;
    document.getElementById('descripcion_empresa').value = descripcion;
}

function editarEstudio(index)
{
    //Nodos tabla
    var idestudio = index.parentNode.parentNode.cells[0].textContent;
    var nombre = index.parentNode.parentNode.cells[1].textContent;
    var descripcion = index.parentNode.parentNode.cells[2].textContent;
    //var especialidad = index.parentNode.parentNode.cells[5].textContent;

    //Pego en el formulario
    document.getElementById('idestudio').value = idestudio;
    document.getElementById('nombre_estudio').value = nombre;
    document.getElementById('descripcion_estudio').value = descripcion;
}

function editarTipopaciente(index)
{
    //Nodos tabla
    var idtipopaciente = index.parentNode.parentNode.cells[0].textContent;
    var nombre = index.parentNode.parentNode.cells[1].textContent;
    var descripcion = index.parentNode.parentNode.cells[2].textContent;
    //var especialidad = index.parentNode.parentNode.cells[5].textContent;

    //Pego en el formulario
    document.getElementById('idtipopaciente').value = idtipopaciente;
    document.getElementById('nombre_tipopaciente').value = nombre;
    document.getElementById('descripcion_tipopaciente').value = descripcion;
}

function editarExamenes(index)
{
    //Nodos tabla
    var idestudiopac = index.parentNode.parentNode.cells[0].textContent;
    var tecnica = index.parentNode.parentNode.cells[1].textContent;

    //var descripcion = index.parentNode.parentNode.cells[2].textContent;
    //var especialidad = index.parentNode.parentNode.cells[5].textContent;

    //Pego en el formulario
    document.getElementById('tecnica_examen').value = tecnica;
    document.getElementById('idpaciente').value = idpaciente;
    //document.getElementById('descripcion_tipopaciente').value = descripcion;
}