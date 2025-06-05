<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function montaMenu($n1,$n2){
    
    $menuAdmin          = '';
    $acaoAdmin          = '';
    $menuDashboard      = '';
    $acaoDashboard      = '';
    $menuMovimentacao   = '';
    $acaoMovimentacao   = '';
    $menuReservas       = '';
    $acaoReservas       = '';
    $menuRelatorio      = '';
    $acaoRelatorio      = '';


    $opcUsuarios        = '';
    $opcEmpresa         = '';
    $opcArmario         = '';
    $opcPorta           = '';
    $opcRelatorio       = '';
    
    
    //Primeiro nível do menu
    switch ($n1) {
        case 'administrador':
            $menuAdmin = 'menu-open';
            $acaoAdmin = 'active';
            break; 

        case 'dashboard':
            $menuDashboard = 'menu-open';
            $acaoDashboard = 'active';
            break; 
        
        case 'reservas':
            $menuReservas = 'menu-open';
            $acaoReservas = 'active';
            break; 
        
        case 'movimentacao':
            $menuMovimentacao = 'menu-open';
            $acaoMovimentacao = 'active';
            break; 

        case 'relatorio':
            $menuRelatorio = 'menu-open';
            $acaoRelatorio = 'active';
            break; 
        
        default:
            # code...
            break;
    }

    //Segundo nível do menu
    switch ($n2) {

        case 'usuarios':
            $opcUsuarios = 'active';
            break;
            
        case 'empresa':
            $opcEmpresa = 'active';
            break; 

        case 'armario':
            $opcArmario = 'active';
            break; 

        case 'porta':
            $opcPorta = 'active';
            break; 

        case 'relatorio-movi':
            $opcRelatorio = 'active';
            break;

    
        default:
            # code...
            break;
    }
    
    $html = 
    '<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
    ';
    if($_SESSION["idTipoUsuario"] == 1) {
        $html .=
        '<li class="nav-item '.$menuAdmin.'">
                <a href="#" id="adminLink" class="nav-link '.$acaoAdmin.'">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p class="text-white">
                        Administrador
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <!-- RIP
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./empresa.php" class="nav-link '.$opcEmpresa.'">
                        <i class="fas fa-building nav-icon ml-3"></i>
                        <p>Empresas</p>
                        </a>
                    </li>              
                </ul>
                -->
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./usuarios.php" id="usuarioLink" class="nav-link '.$opcUsuarios.'">
                        <i class="fas fa-address-card nav-icon ml-3"></i>
                        <p">Usuários</p>
                        </a>
                    </li>              
                </ul>

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./armario.php" id="armarioLink" class="nav-link '.$opcArmario.'">
                        <i class="fas fa-archive nav-icon ml-3"></i>
                        <p>Armários</p>
                        </a>
                    </li>              
                </ul>

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./porta.php" id="portaLink" class="nav-link '.$opcPorta.'">
                        <i class="bi bi-door-open-fill nav-icon ml-3"></i>
                        <p> &nbsp Porta</p>
                        </a>
                    </li>              
                </ul>

            </li>';
    }
            
    $html .=     
    
            ' <li class="nav-item '.$menuRelatorio.'">
                <a href="#" class="nav-link '.$acaoRelatorio.'">
                    <i class="nav-icon fas fa-print"></i>
                    <p class="text-white">
                        Relatórios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>  

            <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./relatorio-movi.php" class="nav-link '.$opcRelatorio.'">
                        <i class="fas fa-file-alt nav-icon ml-3"></i>
                        <p>Movimentações</p>
                        </a>
                    </li>              
                </ul>'.

            '<li class="nav-item '.$menuDashboard.'">
                <a href="./dashboard.php" class="nav-link '.$acaoDashboard.'">
                <i class="far fa-chart-bar nav-icon"></i>
                <p class="text-white">Dashboard</p>
                </a>
            </li>   
        
            <li class="nav-item '.$menuReservas.'">
                <a href="./reservas.php" class="nav-link '.$acaoReservas.'">
                <i class="fas fa-clipboard-check nav-icon"></i>
                <p class="text-white">Reservas</p>
                </a>
            </li>  

            <li class="nav-item '.$menuMovimentacao.'">
                    <a href="./movimentacao.php" class="nav-link '.$acaoMovimentacao.'">
                    <i class="fas fa-sync-alt nav-icon"></i>
                    <p class="text-white">Movimentação</p>
                    </a>
            </li>

            
            <li class="" >
                <a href="php/validaLogoff.php" class="nav-link text-primary fixed-bottom" style="width:fit-content">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Sair</p>
                </a>
            </li>
        
        </ul>
    </nav>';

    return $html;
}

?>