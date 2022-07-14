public function get_nav_bar($id_rol){
        $menus=json_decode($this->rol->get_menu_rol($id_rol));
        $respuesta=array();
        $esta=0;
        $id_menu_=3;
        // $b=0;
        if ($menus!="") {
            foreach ( $menus->menu_roles as $key => $menu) {
                // print_r($menu);
                $id_menu=$menu->id_menu;
                $datos_menu["menus"][]=json_decode($this->get_menu_id($id_menu))->menu[0];
              
            }
            $datos_menu=json_encode($datos_menu);
            foreach (json_decode($datos_menu)->menus as $key => $item) {
                
            if (!empty($respuesta)) {
                $esta=0;
                for ($i=0; $i <count($respuesta) ; $i++) { 
                    unset($sub_menu);
                   if ($respuesta[$i]["id_menu"]==$item->id_menu_parent) {
                    if (isset($respuesta[$i]["parent"])) {
                            for ($b=0; $b <count($respuesta[$i]["parent"])  ; $b++) { 
                            // echo "existe";
                            $sub_menu[$b]=$respuesta[$i]["parent"][$b];
                            // $b++;
                        }
                    }
                    $sub_menu[]=array(
                        'id_menu'=>$item->id_menu,
                        "inicio"=>'<li class="dropdown-item ">',
                        "link"=>SERVER.$item->link_menu,
                        "icono"=>$item->ico,
                        /* $item->link_menu */
                        'link_menu' =>'<a href="'.SERVER.$item->link_menu.'"class="dropdown-item">',
                        'ico' => '<i class="'.$item->ico.'"></i>',
                        /* 'class' =>$item->class, */
                        'Nombre_menu' =>' '.$item->Nombre_menu,
                        /* 'modal' => $item->modal, */
                        /* 'is_link' =>$item->is_link, */
                        'contenido'=>'</a>',
                        'id_menu_parent' => $item->id_menu_parent,
                        'fin'=>'</li>',
                    );
                    $respuesta[$i]=array(
                        'id_menu'=>$respuesta[$i]["id_menu"],
                        "inicio"=>'<li class="nav-item dropdown">',
                        "link"=>$respuesta[$i]["link"],
                        "icono"=>$item->ico,
                        /* $item->link_menu */
                        // 'link_menu' =>$respuesta[$i]["link_menu"],
                        'link_menu' =>'<a id="dropdownSubMenu'.$respuesta[$i]["id_menu"].'" href="'.$respuesta[$i]["link"].'"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">',
                        'ico' =>$respuesta[$i]["ico"],
                        /* 'class' =>$item->class, */
                        'Nombre_menu' =>$respuesta[$i]["Nombre_menu"],
                        /* 'modal' => $item->modal, */
                        /* 'is_link' =>$item->is_link, */
                        'contenido'=>'</a> <ul aria-labelledby="dropdownSubMenu'.$respuesta[$i]["id_menu"].'" class="dropdown-menu border-0 shadow"> ',
                        'parent'=>$sub_menu,
                        'id_menu_parent' => $respuesta[$i]["id_menu_parent"],
                        'fin'=>'</ul></li>',
                    );
                    $esta=1;
                    // echo "<textarea>";
                    // print_r($respuesta[$i]["parent"]);
                    // echo "</textarea>";
                }
                  
                }
                if ($esta==0) {
                    
                        $id_menu_=$item->id_menu;
                        $respuesta[]=array(
                            'id_menu'=>$item->id_menu,
                            "inicio"=>'<li class="nav-item">',
                            "link"=>SERVER.$item->link_menu,
                            "icono"=>$item->ico,
                            /* $item->link_menu */
                            'link_menu' =>'<a href="'.SERVER.$item->link_menu.'"class="'.$item->class.'">',
                            'ico' => '<i class="'.$item->ico.'"></i>',
                            /* 'class' =>$item->class, */
                            'Nombre_menu' =>' '.$item->Nombre_menu,
                            /* 'modal' => $item->modal, */
                            /* 'is_link' =>$item->is_link, */
                            'contenido'=>'</a>',
                            'fin'=>'</li>',
                            'id_menu_parent' => $item->id_menu_parent,
                            );
    
                       
                }

                   
            }else {
                $respuesta[]=array(
                'id_menu'=>$item->id_menu,
                "inicio"=>'<li class="nav-item">',
                "link"=>SERVER.$item->link_menu,
                /* $item->link_menu */
                'link_menu' =>'<a href="'.SERVER.$item->link_menu.'"class="'.$item->class.'">',
                'ico' => '<i class="'.$item->ico.'"></i>',
                /* 'class' =>$item->class, */
                'Nombre_menu' =>$item->Nombre_menu,
                /* 'modal' => $item->modal, */
                /* 'is_link' =>$item->is_link, */
                'contenido'=>'</a>',
                'fin'=>'</li>',
                'id_menu_parent' => $item->id_menu_parent,
                );
            }
        }
        }

        return $respuesta ;
    }   1