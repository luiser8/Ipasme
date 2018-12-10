<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ipasme - Familiares</title>
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
                    <li><a href="<?php echo base_url('Estadisticas'); ?>" title="Estadísticas"><i class="fa fa-pie-chart fa-2x" aria-hidden="true"></i></a></li>
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
      <li><a href="<?php echo base_url('Pacientes'); ?>">Pacientes</a></li>
      <li class="active">Familiares</li>
    </ol>
    <div class="container">
        <div class="col-md-10">
            <input type="text" onkeyup="filtro('#buscar_familiares', '#tabla_familares');" id="buscar_familiares" class="form-control" name="buscar" placeholder="Buscar familiar">
        </div>
        <button type="button" data-toggle="modal" title="Agregar familiar" data-target="#agregarFamiliar" class="btn"><i class="fa fa-plus " aria-hidden="true"></i></button>
        
        <!--Tabla de datos de pacientes-->
        <table class="table table-striped table-hover table-responsive" id="tabla_familares">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CEDULA</th>
                    <th>PARENTESCO</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>SEXO</th>
                    <th>CORREO</th>
                    <th>OPCIONES</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($Familiar as $familiar):?>
                <tr>
                    <td><?php echo $familiar['idfamiliar']; ?></td>
                    <td><?php echo $familiar['cedula']; ?></td>
                    <td><?php echo $familiar['parentesco']; ?></td>
                    <td><?php echo $familiar['nombres']; ?></td>
                    <td><?php echo $familiar['apellidos']; ?></td>
                    <td><?php if($familiar['sexo'] == 1){echo 'Masculino';}else{echo 'Femenino';} ?></td>
                    <td><?php echo $familiar['correo']; ?></td>
                    <td>
                        <a class="btn-default" onclick="editar('familiar', this);" data-toggle="modal" title="Editar familiar" data-target="#editarFamiliar" href="#"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                        <?php if($_SESSION['Nivel'] == 1){ ?>    
                            <a class="btn-default" onclick="eliminar('idfamiliarEliminar', <?php echo $familiar['idfamiliar']; ?>);" data-toggle="modal" title="Eliminar familiar" data-target="#eliminarFamiliar" href="#"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!--Modal datos del paciente--> 
    <div class="modal fade" id="agregarFamiliar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            title="Cerrar">&times;</button>
                    <h4 class="modal-title">Agregar Familiar</h4>
                </div>
                <div class="modal-body">
                    <form id="formAgregarFamiliar" action="<?php echo base_url('Familiares/create'); ?>" method="post">
                        <input type="hidden" name="idpaciente" value="<?php echo $this->uri->segment(2); ?>">
                        <div class="form-group">
                            <select name="parentesco" class="form-control">
                                <option>Selecciona el parentesco</option>
                                <option value="Madre">Madre</option>
                                <option value="Padre">Padre</option>
                                <option value="Hijo(a)">Hijo(a)</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="cedula" required placeholder="Cedula" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="nombres" required placeholder="Nombres" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="apellidos" required placeholder="Apellidos" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <select name="sexo" class="form-control">
                                <option>Selecciona un sexo</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="date" name="fechaNacimiento" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="telefono" required placeholder="Teléfono" autocomplete="off">
                        </div> 
                        <div class="form-group">
                            <textarea class="form-control" name="direccion" placeholder="Dirección" autocomplete="off"></textarea>
                        </div>                    
                        <div class="form-group">
                            <input class="form-control" type="email" name="correo" required placeholder="Correo" autocomplete="off">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal editar paciente-->
    <div class="modal fade" id="editarFamiliar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            title="Cerrar">&times;</button>
                    <h4 class="modal-title">Editar Familiar</h4>
                </div>
                <div class="modal-body">
                    <form id="formEditarPaciente" action="<?php echo base_url('Familiares/editar'); ?>" method="post">
                        <input type="hidden" id="idfamiliar" name="idfamiliar">
                        <input type="hidden" name="idpaciente" value="<?php echo $this->uri->segment(2); ?>">
                        <div class="form-group">
                            <select name="parentesco" class="form-control">
                                <option>Selecciona el parentesco</option>
                                <option value="Madre">Madre</option>
                                <option value="Padre">Padre</option>
                                <option value="Hijo(a)">Hijo(a)</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="cedula_familiar" name="cedula" required placeholder="Cedula" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="text" id="nombres_familiar" name="nombres" required placeholder="Nombres" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="apellidos_familiar" name="apellidos" required placeholder="Apellidos" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <select name="sexo" class="form-control">
                                <option>Selecciona un sexo</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="date" id="fechaNacimiento_familiar" name="fechaNacimiento" required autocomplete="off">
                        </div>
                   
                        <div class="form-group">
                            <input class="form-control" type="email" id="correo_familiar" name="correo" required placeholder="Correo" autocomplete="off">
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
        <div class="modal fade" tabindex="-1" role="dialog" id="eliminarFamiliar">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Familiar</h4>
              </div>
              <div class="modal-body">
                <p><b><span id="datos_familiar"></span></b></p>
                <p>Seguro que desea eliminar este familiar. Los cambios no se podran deshacer.&hellip;</p>
              </div>
              <div class="modal-footer">
                <form action="<?php echo base_url('Familiares/eliminar'); ?>" method="post">
                    <input type="hidden" id="idfamiliarEliminar" name="idfamiliar">
                    <input type="hidden" name="idpaciente" value="<?php echo $this->uri->segment(2); ?>">
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