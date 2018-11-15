<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ipasme - examenes</title>
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/bootstrap-theme.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/estilos.css') ?>">
</head>
<body>
    <!--Navbar bootstrap  -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('Principal'); ?>"><img id="img_logo" src="<?php echo base_url('./assets/images/logo.png') ?>" alt="Logo" title="Principal"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!-- Perfil -->
                <ul class="nav navbar-nav navbar-right" id="navegacion">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-2x" aria-hidden="true"></i><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('Perfil'); ?>"><b><?php echo $_SESSION['Nombres'] . " " . $_SESSION['Apellidos']; ?></b></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url('Sesion/logout'); ?>"><i title="Cerrar sesion" class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Opciones tareas 1-->
                <ul class="nav navbar-nav navbar-right" id="navegacion">
                    <li><a href="<?php echo base_url('Pacientes'); ?>" title="Pacientes"><i class="fa fa-users fa-2x" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo base_url('Examenes'); ?>" title="Examenes"><i class="fa fa-heartbeat fa-2x" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo base_url('Estadisticas'); ?>" title="Estadisticas"><i class="fa fa-pie-chart fa-2x" aria-hidden="true"></i></a></li>
                    <li class="dropdown"><a href="#" title="Configuraciónes" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench fa-2x" aria-hidden="true"></i><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if($_SESSION['Nivel'] == 1){ ?> 
                            <li><a href="<?php echo base_url('Auditorias'); ?>"><b>Auditorias</b></a></li>
                            <li role="separator" class="divider"></li>
                            <?php } ?>
                            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 2){ ?>
                            <li><a href="<?php echo base_url('Empresas'); ?>"><b>Empresas</b></a></li>
                            <li role="separator" class="divider"></li>
                            <?php } ?>
                            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 2 || $_SESSION['Nivel'] == 3){ ?>
                            <li><a href="<?php echo base_url('Estudios'); ?>"><b>Estudios</b></a></li>
                            <li role="separator" class="divider"></li>
                            <?php } ?>
                            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 2){ ?>
                            <li><a href="<?php echo base_url('Especialidades'); ?>"><b>Especialidades</b></a></li> 
                            <li role="separator" class="divider"></li>
                            <?php } ?>
                            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 2){ ?>                         
                            <li><a href="<?php echo base_url('Medicos'); ?>"><b>Medicos</b></a></li> 
                            <li role="separator" class="divider"></li>
                            <?php } ?>
                            <?php if($_SESSION['Nivel'] == 1){ ?> 
                            <li><a href="<?php echo base_url('Usuarios'); ?>"><b>Usuarios</b></a></li>
                            <li role="separator" class="divider"></li>
                            <?php } ?>
                            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 2){ ?> 
                            <li><a href="<?php echo base_url('TiposDePacientes'); ?>"><b>Tipos de pacientes</b></a></li>
                            <?php } ?>
                        </ul>
                    </li>   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- Contenido -->
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Principal'); ?>">Principal</a></li>
      <li><a href="<?php echo base_url('Examenes'); ?>">Examenes</a></li>
      <li class="active">Index</li>
    </ol>
    <div class="container">
        <div class="col-md-10">
            <input type="text" onkeyup="filtro('#buscar_examenes', '#tabla_examenes');" id="buscar_examenes" class="form-control" name="buscar" placeholder="Buscar examenes">
        </div>
        <button type="button" data-toggle="modal" title="Agregar examenes" data-target="#agregarExamenes" class="btn"><i class="fa fa-plus " aria-hidden="true"></i></button>
        
        <!--Tabla de datos de pacientes-->
        <table class="table table-striped table-hover table-responsive" id="tabla_examenes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PACIENTE</th>
                    <th>ESTUDIO</th>
                    <th>MEDICO</th>
                    <th>FECHA</th>
                    <th>OPCIONES</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($Examenes as $examenes):?>
                <tr>
                    <td><?php echo $examenes['idestudiopac']; ?></td>
                    <td><?php echo $examenes['cedula'] . " - " . $examenes['nombres'] . " " . $examenes['apellidos']; ?></td>
                    <td><?php echo $examenes['estudio']; ?></td>
                    <td>Dr(a). <?php echo $examenes['medico']; ?></td>
                    <td><?php echo $examenes['fecha']; ?></td>
                    <td>
                        <a href="<?php echo base_url("Examenes/{$examenes['idestudiopac']}") ?>" class="btn-default" data-toggle="modal" title="Ver mas detalles"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a>
                        <a href="<?php echo base_url("Examenes/print/{$examenes['idestudiopac']}") ?>" target="_blank" class="btn-default" title="Ver informe"><i class="fa fa-print fa-2x" aria-hidden="true"></i></a>
<!--                         <a class="btn-default" onclick="editar('examenes', this);" data-toggle="modal" title="Editar examen" data-target="#editarExamen" href="#"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
 -->                        <?php if($_SESSION['Nivel'] == 1){ ?>    
                            <a class="btn-default" onclick="eliminar('idestudiopacEliminar', <?php echo $examenes['idestudiopac']; ?>);" data-toggle="modal" title="Eliminar examen" data-target="#eliminarExamen" href="#"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!--Modal datos del paciente--> 
    <div class="modal fade" id="agregarExamenes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            title="Cerrar">&times;</button>
                    <h4 class="modal-title">Agregar Examenes</h4>
                </div>
                <div class="modal-body">
                    <form id="formAgregarExamen" action="<?php echo base_url('Examenes/create'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <select name="idpaciente" class="form-control">
                                <option>Selecciona un paciente</option>
                                <?php foreach ($Pacientes as $paciente):?>
                                    <option value="<?php echo $paciente['idpaciente']; ?>"><?php echo $paciente['cedula'] . " - " . $paciente['nombres'] . " " . $paciente['apellidos']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="idestudio" class="form-control">
                                <option>Selecciona un estudio</option>
                                <?php foreach ($Estudios as $estudio):?>
                                    <option value="<?php echo $estudio['idestudio']; ?>"><?php echo $estudio['nombre']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="idmedico" class="form-control">
                                <option>Selecciona el medico</option>
                                <?php foreach ($Medicos as $medico):?>
                                    <option value="<?php echo $medico['idmedico']; ?>">Dr(a). <?php echo $medico['nombres'] . " " . $medico['apellidos']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="tecnica" required placeholder="Técnica" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="hallazgo" required placeholder="Hallazgo" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="conclusion" placeholder="Conclusión" cols="10" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="descripcion" placeholder="Descripción" cols="10" rows="3"></textarea>
                        </div> 
                        <div class="form-group">
                            <input class="form-control" type="date" name="fecha" required autocomplete="off">
                        </div>                 
                        <div class="form-group">
                            <input class="form-control" type="file" name="imagen" required autocomplete="off">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal editar paciente-->
    <div class="modal fade" id="editarExamen">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            title="Cerrar">&times;</button>
                    <h4 class="modal-title">Editar Examen</h4>
                </div>
                <div class="modal-body">
                    <form id="formEditarExamen" action="<?php echo base_url('Examenes/editar'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="idestudiopac" name="idestudiopac">
                        <input type="hidden" id="idpaciente" name="idpaciente">     
                        <div class="form-group">
                            <select name="idestudio" class="form-control">
                                <option>Selecciona un estudio</option>
                                <?php foreach ($Estudios as $estudio):?>
                                    <option value="<?php echo $estudio['idestudio']; ?>"><?php echo $estudio['nombre']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="idmedico" class="form-control">
                                <option>Selecciona el medico</option>
                                <?php foreach ($Medicos as $medico):?>
                                    <option value="<?php echo $medico['idmedico']; ?>">Dr(a). <?php echo $medico['nombres'] . " " . $medico['apellidos']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="tecnica_examen" name="tecnica" required placeholder="Técnica" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="hallazgo_examen" name="hallazgo" required placeholder="Hallazgo" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="conclusion_examen" name="conclusion" placeholder="Conclusión" cols="10" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="descripcion_examen" name="descripcion" placeholder="Descripción" cols="10" rows="3"></textarea>
                        </div> 
                        <div class="form-group">
                            <input class="form-control" type="date" id="fecha_examen" name="fecha" required autocomplete="off">
                        </div>                 
                        <div class="form-group">
                            <input class="form-control" type="file" id="imagen_examen" name="imagen" required autocomplete="off">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <input class="btn btn-primary" type="submit" value="Guardar cambios">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal elimnar paciente-->
        <div class="modal fade" tabindex="-1" role="dialog" id="eliminarExamen">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Examen</h4>
              </div>
              <div class="modal-body">
                <p><b><span id="datos_examen"></span></b></p>
                <p>Seguro que desea eliminar este examen. Los cambios no se podran deshacer.&hellip;</p>
              </div>
              <div class="modal-footer">
                <form action="<?php echo base_url('Examenes/eliminar'); ?>" method="post">
                    <input type="hidden" id="idestudiopacEliminar" name="idestudiopac">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <!-- Scripts -->
    <script src="<?php echo base_url('./assets/js/jquery-1.12-4.min.js') ?>"></script>
    <script src="<?php echo base_url('./assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('./assets/js/filtro.js') ?>"></script>
    <script src="<?php echo base_url('./assets/js/editar.js') ?>"></script>
    <script src="<?php echo base_url('./assets/js/eliminar.js') ?>"></script>
</body>
</html>