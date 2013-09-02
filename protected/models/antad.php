<?php
class Antad extends CI_Controller {

    function Antad() {
        parent::__construct();
        $this->load->helper('language');
        $this->lang->load('products');
        require_once( APPPATH . 'models/Productos.php' );
        $this->load->library('session');
        $this->load->library('breadcrumb');
    }

    function index() {
        $data['content'] = 'inicio';
        $data['history_p'] = unserialize( $this->session->userdata('products_history') );
        $this->session->set_userdata( 'products_history', serialize( $data['history_p'] ) );
        $products = new Productos;
        $products->order_by('idProducto DESC')
                 ->limit(3)
                 ->get();

        $lproducts = array();
        foreach ($products as $key => $value) {
            array_push($lproducts, $value);
        }

        $data['products_new'] = $lproducts;

        //$this->breadcrumb->append_crumb('Inicio', base_url());

        $this->get_crumb();

        $this->load->view('index', $data);
    }

    function productos_categoria($pag = 1, $idCategoria = 1) {
        $idCategoria = (int)$idCategoria;
        $consulta = 'SELECT 
                            pr.idProducto, e.status, pr.idEmpresa, sp.idCategoria, 
                            pr.descripcion, pr.imagen_1, pr.nombre, pr.marca, pr.numero_piezas, 
                            pa.nombre as nombre_pais, e.nombre_comercial, 
                            te.descripcion as tipo_de_empresa, 
                            a.descripcion as actividad_empresarial 
                     FROM  
                            productos as pr LEFT JOIN paises as pa ON pr.idPaisOrigen = pa.idPais
                                INNER JOIN empresas as e ON pr.idEmpresa = e.idEmpresa
                                INNER JOIN tipos_empresa as te ON e.idTipo = te.idTipo
                                INNER JOIN actividades as a ON e.idActividad = a.idActividad 
                                INNER JOIN subcategorias_producto as sp 
                                            ON sp.idSubcategoria = pr.idsubcat1                                          
                     WHERE 
                            pr.Activo = 0 
                                AND sp.idCategoria =' .$idCategoria .' 
                                AND e.status = 1 
                    ORDER BY pr.fecha_actualizacion DESC';

        $data['consulta'] = $consulta;
        $data['busqueda'] = $idCategoria;
        $data['pag'] = (int)$pag;
        $data['categoria'] = $idCategoria;
        $data['content'] = 'productos';
        $data['content2'] = 'antad/productos_categoria';

        $this->get_crumb(array('pag' => $pag, 'catID' => $idCategoria));

        $this->load->view('index', $data);
    }

    function productos_subcategoria($pag = 1, $idSubcategoria = 1) {
        $idSubcategoria = (int)$idSubcategoria;
        $consulta = 'SELECT 
                            pr.idProducto, e.status, 
                            pr.idEmpresa, pr.descripcion, pr.imagen_1, pr.nombre, 
                            pr.marca, pr.numero_piezas, pa.nombre as nombre_pais, 
                            e.nombre_comercial, te.descripcion as tipo_de_empresa, 
                            a.descripcion as actividad_empresarial, pr.entidad 
                     FROM 
                            productos as pr LEFT JOIN paises as pa ON pr.idPaisOrigen = pa.idPais
                                INNER JOIN empresas as e ON pr.idEmpresa=e.idEmpresa
                                INNER JOIN tipos_empresa as te ON e.idTipo=te.idTipo 
                                INNER JOIN actividades as a ON e.idActividad=a.idActividad 
                     WHERE (pr.idSubcat1='.$idSubcategoria.' OR pr.idSubcat2='.$idSubcategoria.' 
                            OR pr.idSubcat3='.$idSubcategoria.' OR pr.idSubcat4='.$idSubcategoria.' 
                            OR  pr.idSubcat5='.$idSubcategoria.')  
                            AND pr.Activo=0
                            AND e.status=1
                    ORDER BY pr.fecha_actualizacion DESC';
        
        $data['consulta'] = $consulta;
        $data['busqueda'] = $idSubcategoria;
        $data['pag'] = (int)$pag;
        $data['categoria'] = $idSubcategoria;
        $data['content'] = 'productos';
        $data['content2'] = 'antad/productos_subcategoria';

        $this->get_crumb(array('pag' => $pag, 'idSubcategoria' => $idSubcategoria));

        $this->load->view('index', $data);
    }

    function productos($pag = 1) {
        $consulta = "SELECT DISTINCT 
                                pr.fecha_actualizacion, pr.idProducto, e.STATUS, 
                                pr.idEmpresa,pr.descripcion, pr.imagen_1, 
                                pr.nombre, pr.marca, pr.numero_piezas, 
                                pa.nombre AS nombre_pais, e.nombre_comercial, 
                                te.descripcion AS tipo_de_empresa, 
                                a.descripcion AS actividad_empresarial
                     FROM productos as pr INNER JOIN paises as pa ON pr.idPaisOrigen = pa.idPais
                                    INNER JOIN empresas as e ON pr.idEmpresa = e.idEmpresa
                                    INNER JOIN tipos_empresa as te ON e.idTipo = te.idTipo
                                    INNER JOIN actividades as a ON e.idActividad = a.idActividad

                            AND ((((pr.imagen_1 IS NOT NULL AND pr.imagen_1 <> '') OR (pr.imagen_2 IS NOT NULL AND pr.imagen_2 <> '')) OR ((pr.imagen_3 IS NOT NULL AND pr.imagen_3 <> '') AND (e.logotipo IS NOT NULL AND e.logotipo <> ''))))
                            AND ((e.banner <> '' AND e.banner IS NOT NULL) AND ((e.imagen_1 IS NOT NULL AND e.imagen_1 <> '') OR (e.imagen_2 IS NOT NULL AND e.imagen_2 <> '')) OR (e.imagen_3 IS NOT NULL AND e.imagen_3 <> ''))
                            AND ((e.correo REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]\.[a-zA-Z]{2,4}$'))
                     WHERE pr.Activo = 0 AND e.STATUS = 1 
                     ORDER BY RAND()";

        $data['consulta'] = $consulta;
        $data['pag'] = (int)$pag;
        $data['content'] = 'productos';
        $data['content2'] = 'antad/productos';

        $this->get_crumb();

        $this->load->view('index', $data);
    }

    function busqueda($pag, $palabra) {
        if ($palabra == '0') {
            $busqueda = $this->input->post('busqueda');
        } else {
            $busqueda = $palabra;
        }
        $busqueda = mysql_real_escape_string($busqueda);
        $consulta = "SELECT 
                            e.STATUS, e.idEmpresa, pr.idProducto, pr.imagen_1, 
                            e.nombre_comercial, pr.numero_piezas, pr.nombre, pr.marca, 
                            pr.descripcion, pa.nombre AS nombre_pais, 
                            te.descripcion AS tipo_de_empresa, 
                            a.descripcion AS actividad_empresarial 
                     FROM 
                            productos as pr INNER JOIN empresas as e ON pr.idEmpresa = e.idEmpresa                                         
                            LEFT JOIN paises as pa ON pr.idPaisOrigen = pa.idPais 
                            INNER JOIN tipos_empresa as te ON e.idTipo = te.idTipo 
                            INNER JOIN actividades as a ON e.idActividad = a.idActividad 
                     WHERE (pr.nombre LIKE '%". $busqueda ."%' 
                            OR pr.marca LIKE '%". $busqueda."%' 
                            OR e.nombre_comercial LIKE '%". $busqueda."%' ) 
                            AND pr.Activo = 0 AND e.STATUS = 1 
                            
                            AND ((((pr.imagen_1 IS NOT NULL AND pr.imagen_1 <> '') OR (pr.imagen_2 IS NOT NULL AND pr.imagen_2 <> '')) OR ((pr.imagen_3 IS NOT NULL AND pr.imagen_3 <> '') AND (e.logotipo IS NOT NULL AND e.logotipo <> ''))))
                            AND ((e.banner <> '' AND e.banner IS NOT NULL) AND ((e.imagen_1 IS NOT NULL AND e.imagen_1 <> '') OR (e.imagen_2 IS NOT NULL AND e.imagen_2 <> '')) OR (e.imagen_3 IS NOT NULL AND e.imagen_3 <> ''))
                            AND ((e.correo REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]\.[a-zA-Z]{2,4}$'))
                     ORDER BY pr.fecha_actualizacion DESC";

        $data['consulta'] = $consulta;
        $data['busqueda'] = $busqueda;
        $data['pag'] = (int)$pag;
        $data['content'] = 'productos';
        $data['content2'] = 'antad/busqueda';
        $this->load->view('index', $data);
    }

    function marcas($pag = 1) {
        $consulta = "SELECT  
                            DISTINCT p.marca, e.nombre_comercial, e.idEmpresa, 
                            te.descripcion AS tipo_de_empresa, 
                            ac.descripcion AS actividad_empresarial 
                     FROM
                            productos as p INNER JOIN empresas as e ON p.idEmpresa = e.idEmpresa 
                                INNER JOIN tipos_empresa as te ON e.idTipo = te.idTipo
                                INNER JOIN actividades as ac ON e.idActividad = ac.idActividad 
                     WHERE 
                            e.status = 1";

        $data['consulta'] = $consulta;
        $data['pag'] = (int)$pag;
        $data['content'] = 'marcas';
        $data['content2'] = 'antad/marcas';

        $this->get_crumb();

        $this->load->view('index', $data);
    }

    function proveedores($pag = 1) {
        $consulta = "SELECT 
                            E.nombre_comercial, E.idEmpresa, E.tractora, E.status, E.descripcion,
                            TE.descripcion AS tipos_empresa, E.idActividad
                     FROM
                            empresas as E INNER JOIN tipos_empresa as TE ON E.idTipo = TE.idTipo
                     WHERE 
                            E.tractora = 0 AND E.status = 1
                            AND (E.logotipo IS NOT NULL AND E.logotipo <> '')
                            AND ((E.banner <> '' AND E.banner IS NOT NULL) AND ((E.imagen_1 IS NOT NULL AND E.imagen_1 <> '') OR (E.imagen_2 IS NOT NULL AND E.imagen_2 <> '')) OR (E.imagen_3 IS NOT NULL AND E.imagen_3 <> ''))
                            AND ((E.correo REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]\.[a-zA-Z]{2,4}$'))
                     ORDER BY E.fecha_creacion DESC";

        $data['consulta'] = $consulta;
        $data['pag'] = (int)$pag;
        $data['content'] = 'proveedores';
        $data['content2'] = 'antad/proveedores';

        $this->get_crumb();
        
        $this->load->view('index', $data);
    }

    function ofertas($pag = 1) {
        $consulta = "SELECT 
                            o.idOferta, o.descripcion, o.fecha_alta, o.fecha_expiracion, 
                            o.idEmpresa, e.nombre_comercial 
                     FROM 
                            ofertas as o INNER JOIN empresas as e ON o.idEmpresa = e.idEmpresa 
                     WHERE 
                            o.fecha_expiracion >= CURDATE() AND o.privada=0 AND o.Activo = 0
                            
                            AND (e.logotipo IS NOT NULL AND e.logotipo <> '')
                            AND ((e.banner <> '' AND e.banner IS NOT NULL) AND ((e.imagen_1 IS NOT NULL AND e.imagen_1 <> '') OR (e.imagen_2 IS NOT NULL AND e.imagen_2 <> '')) OR (e.imagen_3 IS NOT NULL AND e.imagen_3 <> ''))
                            AND ((e.correo REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]\.[a-zA-Z]{2,4}$'))
                     ORDER BY o.fecha_expiracion DESC";

        $data['consulta'] = $consulta;
        $data['pag'] = (int)$pag;
        $data['content'] = 'ofertas';
        $data['content2'] = 'antad/ofertas';

        $this->get_crumb();

        $this->load->view('index', $data);
    }

    function requerimientos($pag = 1) {
        $consulta = "SELECT 
                            r.idRequerimiento, r.descripcion, r.idEmpresa,
                            r.fecha_expiracion, e.nombre_comercial, p.nombre,
                            p.descripcion as descripcion_producto 
                     FROM 
                            requerimientos as r INNER JOIN empresas as e ON r.idEmpresa = e.idEmpresa 
                                INNER JOIN productos as p ON r.idProducto = p.idProducto 
                     WHERE r.privada = 0 
                            AND r.Activo = 0 
                            AND (e.logotipo IS NOT NULL AND e.logotipo <> '')
                            AND ((e.banner <> '' AND e.banner IS NOT NULL) AND ((e.imagen_1 IS NOT NULL AND e.imagen_1 <> '') OR (e.imagen_2 IS NOT NULL AND e.imagen_2 <> '')) OR (e.imagen_3 IS NOT NULL AND e.imagen_3 <> ''))
                            AND ((e.correo REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]\.[a-zA-Z]{2,4}$'))
                     ORDER BY r.fecha_expiracion DESC";
//       AND r.fecha_expiracion <= CURDATE() 
        $data['consulta'] = $consulta;
        $data['pag'] = (int)$pag;
        $data['content'] = 'requerimientos';
        $data['content2'] = 'antad/requerimientos';

        $this->get_crumb();

        $this->load->view('index', $data);
    }

    function busqueda_avanzada() {
        $criterio=                      mysql_real_escape_string( $this->input->post('criterio') );
        $palabra=                       mysql_real_escape_string( $this->input->post('palabra') );
        $tipo_busqueda=                 mysql_real_escape_string( $this->input->post('tipo_busqueda') );
        $categoria_productos =          mysql_real_escape_string( $this->input->post('categoria_productos') );
        $pais_productos=                (int)$this->input->post('idPais');
        $empresa_verificada_producto =  mysql_real_escape_string( $this->input->post('empresa_verificada_producto') );
        $categoria_proveedores =        mysql_real_escape_string( $this->input->post('categoria_proveedores') );
        $actividad=                     mysql_real_escape_string( $this->input->post('actividad') );
        $tipo_comercio=                 mysql_real_escape_string( $this->input->post('tipo_comercio') );
        $empresa_verificada_proveedor = mysql_real_escape_string( $this->input->post('empresa_verificada_proveedor') );
        if ($empresa_verificada_proveedor == '' and $empresa_verificada_producto == '') {
            $busqueda = 'SELECT pr.idProducto, sp.idCategoria, pr.idEmpresa, pr.descripcion,
                                pr.imagen_1, pr.nombre, pr.marca, pr.numero_piezas,
                                pa.nombre as nombre_pais, e.nombre_comercial, 
                                te.descripcion as tipo_de_empresa, 
                                a.descripcion as actividad_empresarial 
                         FROM productos as pr INNER JOIN paises as pa ON pr.idPaisOrigen=pa.idPais  
                                INNER JOIN empresas as e ON pr.idEmpresa=e.idEmpresa 
                                INNER JOIN tipos_empresa as te ON e.idTipo=te.idTipo
                                INNER JOIN actividades as a ON e.idActividad=a.idActividad  
                                INNER JOIN subcategorias_producto as sp ON sp.idSubcategoria=pr.idsubcat1
                         WHERE pr.Activo=0';
        } else {
            $busqueda = 'SELECT pr.idProducto, sp.idCategoria, pr.idEmpresa,
                                pr.descripcion, pr.imagen_1, pr.nombre, pr.marca, 
                                pr.numero_piezas, pa.nombre as nombre_pais, e.nombre_comercial,
                                te.descripcion as tipo_de_empresa, 
                                a.descripcion as actividad_empresarial, 
                                ce.idCertificado 
                         FROM productos as pr INNER JOIN paises as pa ON pr.idPaisOrigen=pa.idPais 
                                INNER JOIN empresas as e ON pr.idEmpresa=e.idEmpresa 
                                INNER JOIN tipos_empresa as te ON e.idTipo=te.idTipo
                                INNER JOIN actividades as a ON e.idActividad=a.idActividad 
                                INNER JOIN subcategorias_producto as sp ON sp.idSubcategoria=pr.idsubcat1 
                                INNER JOIN certificaciones_empresa as ce ON ce.idEmpresa=pr.idEmpresa 
                         WHERE pr.Activo=0 
                                AND ce.idCertificado=1';
        }
        if ($criterio != '') {
            if ($tipo_busqueda != '') {
                switch ($tipo_busqueda) {
                    case 'productos':
                        if ($categoria_productos != '') {
                            $busqueda .= ' AND sp.idCategoria='.$this->db->escape($categoria_productos).'';
                        }
                        if ($pais_productos != '') {
                            $busqueda .= ' AND pr.idPaisOrigen='.$this->db->escape($pais_productos).'';
                        }
                        break;
                    case 'proveedores':
                        if ($categoria_proveedores != '') {
                            $busqueda .= ' AND sp.idCategoria='.$this->db->escape($categoria_proveedores).'';
                        }
                        if ($tipo_comercio != '') {
                            $busqueda .= ' AND e.idtipocomercio='.$this->db->escape($tipo_comercio).'';
                        }
                        if ($actividad != '') {
                            $busqueda .= 'AND e.idActividad='.$this->db->escape($actividad).'';
                        }
                        break;
                };
            }
            $palabras = explode(' ', $criterio);
            switch ($palabra) {
                case 'cualquier_palabra':
                    foreach ($palabras as $key => $value) {
                        if ($key == 0) {
                            $busqueda .= ' AND (pr.nombre LIKE "% '.$this->db->escape_like_str($value).' %" 
                                                OR pr.descripcion LIKE "%'.$this->db->escape_like_str($value).'%")';
                        } else {
                            $busqueda .= ' OR (pr.nombre LIKE "% '.$value.' %" 
                                                OR pr.descripcion LIKE "%'.$this->db->escape_like_str($value).'%")';
                        }
                    }
                    $busqueda .= ' GROUP BY pr.idProducto';
                    break;
                case 'todas_las_palabras':
                    foreach ($palabras as $key => $value) {
                        $busqueda .= ' AND (pr.nombre LIKE "% '.$this->db->escape_like_str($value).' %" 
                                            OR pr.descripcion LIKE "%'.$this->db->escape_like_str($value).'%")';
                    }
                    $busqueda .= ' GROUP BY pr.idProducto';
                    break;
                case 'frase_exacta':
                    $busqueda .= ' AND (pr.nombre LIKE "% '.$this->db->escape_like_str($criterio).' %" 
                                         OR pr.descripcion LIKE "%'.$this->db->escape_like_str($criterio).'%")';
                    break;
                default:
                    $busqueda .= ' AND (pr.nombre LIKE "% '.$this->db->escape_like_str($criterio).' %" 
                                         OR pr.descripcion LIKE "%'.$this->db->escape_like_str($criterio).'%")';
            };
        }
 
        $busqueda .= " AND ((((pr.imagen_1 IS NOT NULL AND pr.imagen_1 <> '') OR (pr.imagen_2 IS NOT NULL AND pr.imagen_2 <> '')) OR ((pr.imagen_3 IS NOT NULL AND pr.imagen_3 <> '') AND (e.logotipo IS NOT NULL AND e.logotipo <> ''))))
                        AND ((e.banner <> '' AND e.banner IS NOT NULL) AND ((e.imagen_1 IS NOT NULL AND e.imagen_1 <> '') OR (e.imagen_2 IS NOT NULL AND e.imagen_2 <> '')) OR (e.imagen_3 IS NOT NULL AND e.imagen_3 <> ''))
                        AND ((e.correo REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]\.[a-zA-Z]{2,4}$'))";

        $consulta = $this->db->query($busqueda);
        $data['consulta'] = $consulta;
        if ($criterio != '') {
            $data['productos'] = $consulta->num_rows();
            $data['content'] = 'busqueda_avanzada';
        } else {
            $data['content'] = 'modulos/busqueda_avanzada';
        }
        $this->load->view('index', $data);
    }

    function terms() {
        $data['content'] = 'terms';
        $this->load->view('modulos/terms', $data);
    }

    function privacy() {
        $data['content'] = 'privacy';
        $this->load->view('modulos/privacy', $data);
    }

    function contact() {
        $data['content'] = 'contact';
        $this->load->view('modulos/contact', $data);
    }

    /**
     * Funcion Breadcrumbs
     * @author Rsalvador <rsalvador@codebit.org>
     */
    function get_crumb($custom = array())
    {
        $crumbs = explode('/', $_SERVER['REQUEST_URI']);
        foreach ($crumbs as $c) {

            if ($c == "productos_categoria")
            {

                $query = "SELECT descripcion FROM categorias_producto WHERE idCategoria =" . $custom['catID'] . " LIMIT 1";
                $res = mysql_fetch_assoc(mysql_query($query));
                $this->breadcrumb->append_crumb("Productos", base_url() . "antad/productos");
                $this->breadcrumb->append_crumb($res['descripcion'], base_url() . "antad/productos_categoria/" . $custom['pag'] . "/" . $custom['catID']);

            } 
            elseif ($c == "productos_subcategoria")
            {

                $query = "SELECT c.idCategoria as id_cat, c.descripcion as cat_desc, s.idSubcategoria as id_sub, s.descripcion as sub_desc 
                          FROM categorias_producto as c 
                          LEFT JOIN subcategorias_producto as s ON c.idCategoria = s.idCategoria 
                          WHERE s.idSubcategoria = " . $custom['idSubcategoria'] . " LIMIT 1";
                $res = mysql_fetch_assoc(mysql_query($query));
                $this->breadcrumb->append_crumb("Productos", base_url() . "antad/productos");
                $this->breadcrumb->append_crumb($res['cat_desc'], base_url() . "antad/productos_categoria/" . $custom['pag'] . "/" . $res['id_cat']);
                $this->breadcrumb->append_crumb($res['sub_desc'], base_url() . "antad/productos_subcategoria/" . $custom['pag'] . "/" . $res['id_sub']);

            } 
            elseif (!is_numeric($c)) 
            {
                $this->breadcrumb->append_crumb(ucfirst(strtolower($c)), base_url() . $c);
            }

        }
    }
}
?>
