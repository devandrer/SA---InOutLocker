<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function montaMenu($n1,$n2){
    
    $menuAdmin = '';
    $acaoAdmin = '';
    $menuDashboard = '';
    $acaoDashboard = '';
    $menuMovimentacao = '';
    $acaoMovimentacao = '';
    $menuRegistros = '';
    $acaoRegistros = '';

    $opcUsuarios        = '';
    $opcEmpresa         = '';
    
    
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
        
        case 'registro':
            $menuRegistros = 'menu-open';
            $acaoRegistros = 'active';
            break; 
        
        case 'movimentacao':
            $menuMovimentacao = 'menu-open';
            $acaoMovimentacao = 'active';
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
    
        default:
            # code...
            break;
    }
    
    $html = 
    '<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item '.$menuAdmin.'">
                <a href="#" class="nav-link '.$acaoAdmin.'">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        Administrador
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./empresa.php" class="nav-link '.$opcEmpresa.'">
                        <i class="fas fa-building nav-icon ml-3"></i>
                        <p>Empresa</p>
                        </a>
                    </li>              
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./usuarios.php" class="nav-link '.$opcUsuarios.'">
                        <i class="fas fa-address-card nav-icon ml-3"></i>
                        <p>Usuários</p>
                        </a>
                    </li>              
                </ul>

            </li>
            
                <li class="nav-item '.$menuDashboard.'">
                    <a href="./test-menu.php" class="nav-link '.$acaoDashboard.'">
                    <i class="far fa-chart-bar nav-icon"></i>
                    <p>Dashboard</p>
                    </a>
                </li>   
        
            <li class="nav-item '.$menuRegistros.'">
                <a href="#" class="nav-link '.$acaoRegistros.'">
                <i class="fas fa-clipboard-check nav-icon"></i>
                <p>Registros</p>
                </a>
            </li>  

            <li class="nav-item '.$menuMovimentacao.'">
                    <a href="#" class="nav-link '.$acaoMovimentacao.'">
                    <i class="fas fa-sync-alt nav-icon"></i>
                    <p>Movimentação</p>
                    </a>
            </li>


            <li class="nav-item fixed-bottom">
                <a href="php/validaLogoff.php" class="nav-link text-danger">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Sair</p>
                </a>
            </li>
        
        </ul>
    </nav>';

    return $html;
}

?>