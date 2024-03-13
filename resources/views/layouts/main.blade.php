<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> @yield('title-content')</title>
    

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('assetsadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar   sidebar-light accordion" id="accordionSidebar" style="background-color:rgb(238,238,238)">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center  mt-2 mb-2 " href="">
                <div class="sidebar-brand-icon mt-3 mb-2 ">
                   <img src="{{asset('images/logo.png')}}" alt="" style="width:75%;height:auto">
                </div>
             
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
         
           
           


            <!-- Nav Item - Pages Collapse Menu -->
            @if(Auth::user()->role==1)
            <li class="nav-item active">
                <a class="nav-link" href="{{route('RespRh')}}">
                <i class="fa-solid fa-table-columns" style="color:#952D98"></i>
                    <span style="color:#952D98">Tableau de bord</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseemp"
                    aria-expanded="true" aria-controls="collapseemp">
                    <i class="fa-solid fa-users" style="color:#952D98"></i> 
                    <span style="color:#952D98">
                    Employés
                    </span>
                </a>
                <div id="collapseemp" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Employés</h6>
                        <a class="collapse-item" href="{{route('admin.employe')}}">liste des employés</a>
                        <a class="collapse-item" href="{{route('admin.ajouter.employe')}}">Ajouter un employé</a>
                    </div>
                </div>
               </li>
               <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseresp"
                    aria-expanded="true" aria-controls="collapseresp">
                    <i class="fa-solid fa-users" style="color:#952D98"></i>
                    <span style="color:#952D98">
                   Les responsables Rh
                    </span>
                </a>
                <div id="collapseresp" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Les responsables</h6>
                        <a class="collapse-item" href="{{route('admin.RespRh')}}">liste des responsables</a>
                        <a class="collapse-item" href="{{route('admin.ajouterResp')}}">Ajouter un responsable</a>
                    </div>
                </div>
               </li>
               
            @endif

            @if(Auth::user()->role==2)
            <li class="nav-item active">
                <a class="nav-link" href="{{route('RespRh')}}" >
                <i class="fa-solid fa-table-columns" style="color:#952D98"></i>
                    <span style="color:#952D98">Tableau de bord </span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseemp"
                    aria-expanded="true" aria-controls="collapseemp" style="color:#952D98 !important;">
                    <i class="fa-solid fa-users" style="color:#952D98"></i>
                    <span style="color:#952D98">
                    Employés
                    </span>
                </a>
                <div id="collapseemp" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Employés</h6>
                        <a class="collapse-item" href="{{route('RespRh.employe')}}">liste des employés</a>
                        <a class="collapse-item" href="{{route('RespRh.ajouter.employe')}}">Ajouter un employé</a>
                    </div>
                </div>
               </li>
               <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecan"
                    aria-expanded="true" aria-controls="collapsecan">
                    <i class="fa-solid fa-user-graduate" style="color:#952D98"></i>
                    <span style="color:#952D98">
                    Candidats
                    </span>
                </a>
                <div id="collapsecan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Candidats</h6>
                        <a class="collapse-item" href="{{route('RespRh.candidat')}}">liste des candidats</a>
                    </div>
                </div>
               </li>
              <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseform"
                    aria-expanded="true" aria-controls="collapseform">
                   
                    <i class="fa-solid fa-laptop-file" style="color:#952D98"></i>
                    <span style="color:#952D98">
                    Formation
                    </span>
                </a>
                <div id="collapseform" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Formations</h6>
                        <a class="collapse-item" href="{{route('RespRh.formations')}}">liste des formations</a>
                        <a class="collapse-item" href="{{route('RespRh.ajouter.formation')}}">Proposer une formation</a>
                    </div>
                </div>
</li>
<li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseconge"
                    aria-expanded="true" aria-controls="collapseconge">
                    <i class="fa-sharp fa-solid fa-file" style="color:#952D98"></i>
                  
                    <span style="color:#952D98">
                    Congés
                    </span>
                </a>
                <div id="collapseconge" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Congés</h6>
                        <a class="collapse-item" href="{{route('RespRh.listes.conges')}}">les demandes traitées</a>
                        <a class="collapse-item" href="{{route('RespRh.demandes.conges')}}">les demandes de congés</a>
                    </div>
                </div>
</li>
<li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepaie"
                    aria-expanded="true" aria-controls="collapsepaie">
                    <i class="fa-solid fa-file-invoice-dollar" style="color:#952D98"></i>
                    
                    <span style="color:#952D98">
                    Paiement
                    </span>
                </a>
                <div id="collapsepaie" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Paiement</h6>
                        <a class="collapse-item" href="{{route('RespRh.FichesPaiement')}}">Les fiches de paiement </a>
                        <a class="collapse-item" href="{{route('RespRh.paie')}}">Régler une fiche </a>
                    </div>
                </div>
</li>
<li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepre"
                    aria-expanded="true" aria-controls="collapsepre" style="color:#952D98">
                   
                    <i class="fa-solid fa-clipboard-user" style="color:#952D98"></i>
                    <span style="color:#952D98">
                    Présence
                    </span>
                </a>
                <div id="collapsepre" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Présence</h6>
                        <a class="collapse-item" href="{{route('RespRh.ListePresents')}}">Liste des présents  </a>
                        <a class="collapse-item" href="{{route('RespRh.ListeAbsents')}}">Liste des absents </a>
                        <a class="collapse-item" href="{{route('RespRh.DemandesAbsences')}}">Les justificatifs d'absence</a>
                    </div>
                </div>
</li>
            @endif
            @if(Auth::user()->role==3)
            <li class="nav-item active">
                <a class="nav-link" href="{{route('employer')}}">
                <i class="fa-solid fa-table-columns" style="color:#952D98"></i>
                    <span style="color:#952D98">Tableau de bord</span ></a>
            </li>
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseconge"
                    aria-expanded="true" aria-controls="collapseconge" style="color:#952D98">
                    <i class="fa-sharp fa-solid fa-file" style="color:#952D98"></i>
                  <span style="color:#952D98">
                    Congés
                    </span>
                </a>
                <div id="collapseconge" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded" style="color:#952D98">
                        <h6 class="collapse-header"> Congés</h6>
                        <a class="collapse-item" href="{{route('employer.MesConges')}}">Mes Congés</a>
                        <a class="collapse-item" href="{{route('employer.conge')}}">Passer une demande</a>
                    </div>
                </div>
</li>          
              <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseform"
                    aria-expanded="true" aria-controls="collapseform">
                    <i class="fa-solid fa-laptop-file" style="color:#952D98"></i>
                    <span style="color:#952D98">
                    Formation
                    </span>
                </a>
                <div id="collapseform" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Formations</h6>
                        <a class="collapse-item" href="{{route('employer.ListeFormations')}}">Les formations proposées </a>
                        <a class="collapse-item" href="{{route('employer.Mesformations')}}">Mes formations</a>
                    </div>
                </div>
</li>

<li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepaie"
                    aria-expanded="true" aria-controls="collapsepaie">
                    <i class="fa-solid fa-file-invoice-dollar" style="color:#952D98"></i>
                    <span style="color:#952D98">
                    Paiement
                    </span>
                </a>
                <div id="collapsepaie" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Paiement</h6>
                        <a class="collapse-item" href="{{route('Employer.paiement')}}">Mes fiches de paie </a>
                       
                    </div>
                </div>
</li>
<li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseabs"
                    aria-expanded="true" aria-controls="collapseabs">
                    <i class="fa-sharp fa-solid fa-clipboard-user" style="color:#952D98"></i>
                    <span style="color:#952D98">
                   Absence
                    </span>
                </a>
                <div id="collapseabs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Absence</h6>
                        <a class="collapse-item" href="{{route('Employer.DemandesAbsences')}}">Demandes de justification</a>
                        <a class="collapse-item" href="{{route('Employer.JustificationAbsence')}}">Justificatifs effectuées</a>
                    </div>
                </div>
</li>
<li class="nav-item">
                <a class="nav-link" href="{{route('employer.presence')}}">
                <i class="fa-solid fa-clipboard-user" style="color:#952D98"></i>
                    <span style="color:#952D98">Présence</span></a>
            </li>
            @endif

           

            <!-- Divider -->
            

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" >

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow navbar-sm" style="background-color:#952D98;height:52px!important;">


                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        
                       
                        <!-- Nav Item - Alerts -->
                        @if(Auth::user()->role==2)
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw text-white" style="color:#ffffff"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter " id="counternotification">{{ auth()->user()->unreadNotifications->count() }}+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                          
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h5 class="dropdown-header text-center" style="background-color:#952D98!important; border-color:#952D98!important;">
                                    Notifications
                                </h5>
                                @if(auth()->user()->unreadNotifications->count() > 0)

                                <a href="{{route('RespRh.notification')}}" class=" dropdown-header btn m-1" style="background-color:#952D98!important; border-color:#952D98!important;" >Rendre comme lu</a>
                               <div id="unreadnotification">
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                <a class="dropdown-item d-flex align-items-center" href="/RespRh/DemandesConges/{{ $notification->data['id'] }}/view">
                                  
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary" style="background-color:#952D98!important;">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $notification->created_at }}</div>
                                        <span class="">{{ $notification->data['title'] }} réaliser par : {{ $notification->data['user'] }} </span>
                                    </div>
                                </a>
                                @endforeach
                                </div>
                                @else
                                <a href="#" class="dropdown-item text-center">Aucune notifications</a>
                                @endif
                          
                           
                            </div>
                        </li>
                        @endif

                        <!-- notification employe-->

                        @if(Auth::user()->role==3)
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw text-white" style="color:#ffffff"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter " id="counternotification">{{ auth()->user()->unreadNotifications->count() }}+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                          
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h5 class="dropdown-header text-center" style="background-color:#952D98!important; border-color:#952D98!important;">
                                    Notifications
                                </h5>
                                @if(auth()->user()->unreadNotifications->count() > 0)

                                <a href="{{route('Employer.notification')}}" class=" dropdown-header btn btn-danger m-1" style="background-color:#952D98!important;border-color:#952D98!important;">Rendre comme lu</a>
                               <div id="unreadnotification">
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                @if($notification->type == 'App\Notifications\AbsenceNotification')
                                <a class="dropdown-item d-flex align-items-center" href="{{route('Employer.DemandesAbsences')}}">
                                  @else
                                <a class="dropdown-item d-flex align-items-center" href="/employer/MesConges/{{ $notification->data['id'] }}/view">
                                  @endif
                                  <div class="mr-3">
                                        <div class="icon-circle bg-primary" style="background-color:#952D98!important;">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $notification->created_at }}</div>
                                        <span class="">{{ $notification->data['title'] }} {{ date('Y-m-d', strtotime($notification->data['date'])) }}</span>

                                    </div>
                                </a>
                                @endforeach
                                </div>
                                @else
                                <a href="#" class="dropdown-item text-center">Aucune notifications</a>
                                @endif
                          
                           
                            </div>
                        </li>
                        @endif
                     
                        <!-- Nav Item - Messages -->
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user()->role !=3)    <i class="fa-solid fa-user mr-1" style="color:#ffffff"></i> @endif
                                <span class="mr-2 d-none d-lg-inline text-white-800 " style="color:#FFFFFF !important;" >{{AUTH::user()->name}}</span>
                     @if(Auth::user()->role==3)
                        @foreach ($employer as $employe)
                        @if ($employe->id_employer == auth()->user()->id)
                            @if (empty($employe->photo))
                                <img src="{{ asset('images/user-profil.png') }}" class="img-profile rounded-circle border">
                            @else
                                <img src="{{ asset('uploads/' . $employe->photo) }}" class="img-profile rounded-circle border">
                            @endif
                          @endif
                        @endforeach
                        @endif

                                
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if(Auth::user()->role==3)
                                <a class="dropdown-item" href="{{route('employer.profil')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-white-400" style="color:#952D98!important;"></i>
                                    <span style="color:#952D98!important;"> Profil</span>
                                </a>
                                <a class="dropdown-item" href="{{route('employer.settings')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-white-400"  style="color:#952D98!important;" ></i>
                                    <span style="color:#952D98!important;"> Paramètres</span>
                                </a> @endif
                                @if(Auth::user()->role==2)
                    
                                <a class="dropdown-item" href="{{route('RespRh.settings')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-white-400" style="color:#952D98!important;"></i>
                                    <span style="color:#952D98!important;"> Paramètres</span>
                                </a>
                                 @endif
                        
                                 @if(Auth::user()->role==1)
                    
                    <a class="dropdown-item" href="{{route('admin.settings')}}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-white-400" style="color:#952D98!important;"></i>
                       <span style="color:#952D98!important;"> Paramètres</span>
                    </a>
                     @endif
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" style="color:#952D98!important;"></i> <span style="color:#952D98!important;"> {{ __('Se déconnecter') }}</span> 
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                               
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" >
                    <style>
                        #titre{
                            color:black;
                            font-size:35px;

                        }
                    </style>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4" >
                        <h1 class="h3 mb-0 text-800" id="titre">@yield('title-content')</h1>
                    
                       
                    </div>

                    <div class="row" >
                       @yield('content')
                      </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white" id="foot">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; One click 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assetsadmin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assetsadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assetsadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assetsadmin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('assetsadmin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('assetsadmin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assetsadmin/js/demo/chart-pie-demo.js')}}"></script>
   

</body>

</html>