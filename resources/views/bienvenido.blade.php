@extends('layouts.plantilla')
@section('titulo')
    <h3>Pagina de bienvenida</h3>
@endsection
@section('contenido')
    <div class="x_title">
        <h2>Sistema de<b> matriculas y tesorería</b></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>

      <!-- Contenido -->

    <div class="x_content">
      <div class="col-md-12 col-sm-12  profile_left">
          <div class="profile_img col-lg-6">
              <div id="crop-avatar">
              <!-- Current avatar -->
              <img class="img-responsive avatar-view" src="adminlte/images/colegio.jpg" alt="Avatar" title="Change the avatar">
              </div>
          </div>
          {{-- <h1 class="col-lg-6">ADMISIONES ABIERTAS</h1> --}}
          <a class="col-lg-6" href="http://www.fleming.edu.pe/admisiones/"><h1>ADMISIONES ABIERTAS</h1></a>

          <ul class="list-unstyled user_data col-lg-6">
              <li><h3><i class="fa fa-map-marker user-profile-icon"></i> Av. América Sur 3701 - Trujillo, Perú</h3></li>

              <li><h3><i class="fa fa-briefcase user-profile-icon"></i> Escuela Privada</h3></li>

              <li class="m-top-xs"><h3></h3>
                  <h3><i class="fa fa-facebook user-profile-icon"></i><a href="https://www.facebook.com/flemingperu/" target="_blank"> Fleming College - Trujillo, Perú</a></h3>
              </li>
          </ul>
      </div>
  </div>  
@endsection