         <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

<div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                          <a href="{{route('home')}}" class="btn btn-success">  <i class="ace-icon fa fa-home"></i></a>
                          <a href="{{route('Director.Pago.Index')}}" class="btn btn-info">  <i class="ace-icon fas fa-money-bill-alt"></i></a>

                    
                        <a href="{{route('Director.User.Index')}}" class="btn btn-warning"> <i class="ace-icon fa fa-users"></i></a>

                        <a class="btn btn-danger" href="{{route('Director.Profile')}}">
                            <i class="ace-icon fa fa-id-badge"></i>
                        </a>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div>
            

                <ul class="nav nav-list">
                    <li class="" id="admin-home">
                        <a href="{{route('Director.Home')}}">
                            <i class="menu-icon fas fa-tachometer-alt "></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

<li id="menu-persona">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fas fa-user-cog "></i>
        <span class="menu-text">
          Personas
        </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">

        <li class="" id="menu-apoderado">
        <a href="#" class="dropdown-toggle">
        <i class="menu-icon ace-icon fas fa-user-tie"></i>
        <span class="menu-text"> Padre | Apoderado </span>

        <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
        <li class="" id="apoderado-todos">
        <a href="{{route('Director.Apoderado.Index')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Todos
        </a>

        <b class="arrow"></b>
        </li>

        <li class="" id="apoderado-create">
        <a href="{{route('Director.Apoderado.Create')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Nuevo
        </a>

        <b class="arrow"></b>
        </li>
        <li id="apoderado-edit" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Editar
        </a>

        <b class="arrow"></b>
        </li>
        <li id="apoderado-show" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Perfil
        </a>

        <b class="arrow"></b>
        </li>
        </ul>
        </li>   

        <li id="menu-alumno">
        <a href="#" class="dropdown-toggle">
        <i class="menu-icon ace-icon fas fa-user-graduate"></i>
        <span class="menu-text"> Alumno </span>

        <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
        <li  id="alumno-todos">
        <a href="{{route('Director.Alumno.Index')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Todos
        </a>

        <b class="arrow"></b>
        </li>

        <li id="alumno-create">
        <a href="{{route('Director.Alumno.Create')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Nuevo
        </a>

        <b class="arrow"></b>
        </li>
        <li id="alumno-edit" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Editar
        </a>

        <b class="arrow"></b>
        </li>
        <li id="alumno-show" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Perfil
        </a>

        <b class="arrow"></b>
        </li>
        </ul>
        </li>             

        <li class="" id="menu-docente">
        <a href="#" class="dropdown-toggle">
        <i class="menu-icon ace-icon fas fa-chalkboard-teacher"></i>
        <span class="menu-text"> Docente </span>

        <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
        <li class="" id="docente-todos"> 
        <a href="{{route('Director.Docente.Index')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Todos
        </a>

        <b class="arrow"></b>
        </li>

        <li class="" id="docente-create">
        <a href="{{route('Director.Docente.Create')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Nuevo
        </a>

        <b class="arrow"></b>
        </li>
        <li id="docente-edit" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Editar
        </a>

        <b class="arrow"></b>
        </li>
        <li id="docente-show" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Perfil
        </a>

        <b class="arrow"></b>
        </li>
        </ul>
        </li> 

        <li class="" id="menu-director">
        <a href="#" class="dropdown-toggle">
        <i class="menu-icon ace-icon  fas fa-briefcase "></i>
        <span class="menu-text"> Director</span>

        <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
        <li class="" id="director-todos"> 
        <a href="{{route('Director.Director.Index')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Todos
        </a>

        <b class="arrow"></b>
        </li>

        <li class="" id="director-create">
        <a href="{{route('Director.Director.Create')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Nuevo
        </a>

        <b class="arrow"></b>
        </li>
        <li id="director-edit" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Editar
        </a>

        <b class="arrow"></b>
        </li>
        <li id="director-show" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Perfil
        </a>

        <b class="arrow"></b>
        </li>
        </ul>
        </li> 

        <li class="" id="menu-secretaria">
        <a href="#" class="dropdown-toggle">
        <i class="menu-icon ace-icon fas fa-desktop "></i>
        <span class="menu-text">Secretaria</span>

        <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
        <li class="" id="secretaria-todos"> 
        <a href="{{route('Director.Secretaria.Index')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Todos
        </a>

        <b class="arrow"></b>
        </li>

        <li class="" id="secretaria-create">
        <a href="{{route('Director.Secretaria.Create')}}">
        <i class="menu-icon fa fa-caret-right"></i>
        Nuevo
        </a>

        <b class="arrow"></b>
        </li>
        <li id="secretaria-edit" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Editar
        </a>

        <b class="arrow"></b>
        </li>
        <li id="secretaria-show" class="hide">
        <a href="#">
        <i class="menu-icon fa fa-caret-right"></i>
        Perfil
        </a>

        <b class="arrow"></b>
        </li>
        </ul>
        </li> 

        <li class="" id="menu-user">
        <a href="{{route('Director.User.Index')}}">
        <i class="menu-icon fas fa-users "></i>
        <span class="menu-text"> Usuario </span>
        </a>

        <b class="arrow"></b>
        </li>                  
    </ul>

</li> 

               
<li class="" id="menu-curso">
    <a href="{{route('Director.Curso.Index')}}">
        <i class="menu-icon ace-icon fa fa-book"></i>
       Curso
    </a>

    <b class="arrow"></b>
</li>

<li class="" id="menu-criterioevaluacion">
    <a href="{{route('Director.CriterioEvaluacion.Index')}}">
        <i class="menu-icon ace-icon fas fa-ruler-combined"></i>
    Criterio Evaluacion
    </a>

    <b class="arrow"></b>
</li>

<li class="" id="menu-grado">
    <a href="{{route('Director.Grado.Index')}}">
        <i class="menu-icon fas fa-list-ol"></i>
    Grado
    </a>

    <b class="arrow"></b>
</li>

                    
<li class="" id="menu-plan_academico">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fab fa-elementor"></i>
        <span class="menu-text"> Plan Academico </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">
        <li class="" id="menu-plan_academico-todos">
            <a href="{{route('Director.PlanAcademico.Index')}}">
                <i class="menu-icon fa fa-caret-right"></i>
                Todos
            </a>

            <b class="arrow"></b>
        </li>
                                                              
        <li id="menu-plan_academico-ver" class="hide">
            <a href="#">
                <i class="menu-icon fa fa-caret-right"></i>
             Ver
            </a>

            <b class="arrow"></b>
        </li>
                              
        <li  id="menu-plan_academico-asignar-grado" class="hide"> 
            <a href="#">
                <i class="menu-icon fa fa-caret-right"></i>
            Grado
            </a>

            <b class="arrow"></b>
        </li>

        <li class="hide" id="menu-plan_academico-asignar-grado-curso">
            <a href="#">
                <i class="menu-icon fa fa-caret-right"></i>
               Curso a grado
            </a>

            <b class="arrow"></b>
        </li>
        <li id="menu-plan_academico-curso-criterio" class="hide">
            <a href="#">
                <i class="menu-icon fa fa-caret-right"></i>
               Curso - Criterio de evaluacion 
            </a>

            <b class="arrow"></b>
        </li>        
    
    </ul>
</li>       


      
                   
 <li class="" id="menu-anio-academico">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fas fa-calendar-alt"></i>
                            <span class="menu-text">Año Academico</span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="" id="menu-anio-academico-todos">
                                <a href="{{route('Director.AnioAcademico.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Todos
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="" id="menu-anio-academico-activar">
                                <a href="{{route('Director.AnioAcademico.Activar')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                 Habilitar
                                </a>

                                <b class="arrow"></b>
                            </li>
                                        
                  


                        </ul>
                    </li>  

                 <li class="" id="menu-seccion">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fas fa-boxes"></i>
                            <span class="menu-text"> Seccion </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="" id="menu-seccion-todos">
                                <a href="{{route('Director.Seccion.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Todos
                                </a>

                                <b class="arrow"></b>
                            </li>
                             <li id="seccion-show" class="hide">
                                <a href="#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                 Ver
                                </a>

                                <b class="arrow"></b>
                            </li>
   <li id="menu-seccion-docentecurso">
                                <a href="{{route('Director.SeccionDocenteCurso.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                               Docente Curso
                                </a>

                                <b class="arrow"></b>
                            </li>
                       
                        
                        </ul>
                    </li>    

                                      <li id="menu-trimestre">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fas fa-map-signs"></i>
                            <span class="menu-text">Trimestre </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li  id="menu-trimestre-index">
                                <a href="{{route('Director.Trimestre.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                 Todos
                                </a>

                                <b class="arrow"></b>
                            </li>
              
     </ul>
                    </li>
                                               <li id="menu-horario">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon ace-icon fas fa-calendar-day"></i>
                            <span class="menu-text"> Horario </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu" >
                    

<li class="" id="menu-horario_config">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fas fa-cog"></i>
        <span class="menu-text">Horario config. </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">
        <li class="" id="menu-horario_config-todos">
            <a href="{{route('Director.HorarioConfig.Index')}}">
                <i class="menu-icon fa fa-caret-right"></i>
                Todos
            </a>

            <b class="arrow"></b>
        </li>
                    

    <li id="menu-horario_config-edit" class="hide">
        <a href="#">
            <i class="menu-icon fa fa-caret-right"></i>
        Editar
        </a>

        <b class="arrow"></b>
    </li>

    </ul>
</li> 

<li class="" id="menu-horario-main">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
Asignacion
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                <b class="arrow"></b>

                                <ul class="submenu nav-show" >
                                          <li id="menu-horario-asignar">
                                <a href="{{route('Director.Horario.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                              Asignar
                                </a>

                                <b class="arrow"></b>
                            </li>

                <li id="menu-horario-asignar-edit" class="hide" >
                                <a href="#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                               Editar
                                </a>

                                <b class="arrow"></b>
                            </li>

                                </ul>
                            </li>


                 

                        </ul>
                    </li>

                                     <li class="" id="menu-matricula">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fas fa-school"></i>
                            <span class="menu-text"> Matricula </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="" id="menu-matricula-todos">
                                <a href="{{route('Director.Matricula.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Todos
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>
                  
        

       




          

           
                       
                   
                    <li id="menu-notas">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fas fa-scroll"></i>
                            <span class="menu-text">Notas </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li id="menu-notas-index">
                                <a href="{{route('Director.Notas.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                Todos
                                </a>

                                <b class="arrow"></b>
                            </li>
                        <li id="menu-notas-asignar" class="hide">
                                <a href="#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                               Asignar
                                </a>

                                <b class="arrow"></b>
                            </li>
               
                        </ul>
                    </li>
       
  
                         <li id="menu-pago">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fas fa-money-bill-alt"></i>
                            <span class="menu-text">Pagos </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li id="menu-pago-index">
                                <a href="{{route('Director.Pago.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                Todos
                                </a>

                                <b class="arrow"></b>
                            </li>
  <li id="menu-pago-descuento">
                                <a href="{{route('Director.Descuento.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                              Descuentos
                                </a>

                                <b class="arrow"></b>
                            </li>
                      
    <li id="menu-pago-deuda">
                                <a href="{{route('Director.Deuda.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                Deuda
                                </a>

                                <b class="arrow"></b>
                            </li> 

               
                        </ul>
                    </li> 


                                       <li id="menu-caja">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fas fa-cash-register"></i>
                            <span class="menu-text">Caja </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li id="menu-caja-index">
                                <a href="{{route('Director.Caja.Index')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                Todos
                                </a>

                                <b class="arrow"></b>
                            </li>

                                <li id="menu-caja-boleta" class="hide">
                                <a href="#">
                                    <i class="menu-icon fa fa-caret-right"></i>
                               Boleta
                                </a>

                                <b class="arrow"></b>
                            </li>

  
               
                        </ul>
                    </li>  
</ul>

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>