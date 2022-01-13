<?php
/*
    $data = $menuel['elements']
*/

if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="c-sidebar-nav-dropdown">';
            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';    
            }
            echo $data['name'] . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                if( $data[$i]['slug'] === 'link' ){
                    echo '<li class="c-sidebar-nav-item">';
                    echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}
?>


        <div class="c-sidebar-brand">
            <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/BPCF(3).png') }}" width="118" height="46" alt="CoreUI Logo">
            <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/bpq.png') }}" width="118" height="46" alt="CoreUI Loga">
        </div>
        <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-title">Menu Principal
                    <li class="c-sidebar-nav-item">
                
                    <a class="c-sidebar-nav-link" href="{{route('home')}}">
                                                                                    <i class="cil-home c-sidebar-nav-icon"></i>                      
                        Início
                        </a>
                    </li>
            
            @if(auth::user()->menuroles == "admin")      
                <li class="c-sidebar-nav-item">
                
                
                <a class="c-sidebar-nav-link" href="{{route('index')}}">
                                                                                <i class="cil-wallet c-sidebar-nav-icon"></i>                      
                    Listagem de Arquivos
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                
                
                <a class="c-sidebar-nav-link" href="{{route('Versoes')}}">
                                                                                <i class="cil-cloud-upload  c-sidebar-nav-icon"></i>                      
                    Cadastro de Versões
                    </a>
                </li>
            @endif
                </li>
                    </li>
    

        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>