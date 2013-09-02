<?php
ini_set('display_errors', 1);
class Login extends CI_Controller {

    function Login() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('user_agent');
    }

    function index() {
        //TODO: Borrar comentario
//        if ($this->session->userdata('logged_in') == TRUE) {            
//            //echo "<script language='javascript'>top.location.reload();</script>";
//        }
        $this->load->library('my_phpmailer');
        $data['content'] = 'modulos/login';
        $this->load->view('modulos/loginLayout', $data);
    }
    
    //Para el login del popup (GreyBox)
    function indexPop(){
        $data['url_history'] = $_SERVER['HTTP_REFERER'];
        $data['content'] = 'modulos/loginPop';
        $this->load->view('modulos/loginLayout', $data);
    }

    function process_login() {
        $username = mysql_real_escape_string( $this->input->post('username') );
        $password = mysql_real_escape_string( $this->input->post('password') );
        $remember = $this->input->post('rememberme');
        if (!empty($remember)) {
            $si = "'rememberme' => TRUE,";
            setcookie("pass", $username, time() + (7 * 86400));
            setcookie("uno", $password, time() + (7 * 86400));
        } else {
            $si = "'rememberme' => FALSE,";
            setcookie("pass");
            setcookie("uno");
        }
        $consulta = $this->db->query('SELECT idUsuario, idPermiso, idEmpresa, nombre, app, apm, nombre_usuario,
                                                contrasena, correo, correo_alterno, website, puesto, tipo,
                                                status, fecha_alta, imagen, ultima_entrada, log_user   
                                        FROM usuarios 
                                        WHERE nombre_usuario="' . $username . '" AND contrasena="' . $password .'"');
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $newdata = array(
                'logged_in' => TRUE,
                $si,
                'nombre' => $row->nombre,
                'app' => $row->app,
                'apm' => $row->apm,
                'nombre_usuario' => $row->nombre_usuario,
                'contrasena' => $row->contrasena,
                'correo' => $row->correo,
                'correo_alterno' => $row->correo_alterno,
                'puesto' => $row->puesto,
                'tipo' => $row->tipo,
                'status' => $row->status,
                'fecha_alta' => $row->fecha_alta,
                'idUsuario' => $row->idUsuario,
                'idEmpresa' => $row->idEmpresa,
                'idPermiso' => $row->idPermiso,
            );

            $this->session->set_userdata($newdata);
            $fechahoy = date('Y-m-d H:i:s');
            $data = array('ultima_entrada' => $fechahoy,
                'log_user' => 'Login');
            $this->db->update('usuarios', $data, "idUsuario = $row->idUsuario");
            //TODO: Borrar comentario
            //echo "<script language='javascript'>top.location.href= '".base_url()."antad'</script>";
            //echo "<script language='javascript'>top.location.reload();</script>";
            redirect('escritorio/index');
        } else {
            $data['error'] = "Clave de acceso o usuario incorrectos";
            $data['content'] = 'modulos/login';
            $this->load->view('modulos/loginLayout', $data);
        }
    }
    
    //Validar Login para el PopUp
    function process_loginPop() {
        $username = mysql_real_escape_string( $this->input->post('username') );
        $password = mysql_real_escape_string( $this->input->post('password') );
        $remember = $this->input->post('rememberme');
        if (!empty($remember)) {
            $si = "'rememberme' => TRUE,";
            setcookie("pass", $username, time() + (7 * 86400));
            setcookie("uno", $password, time() + (7 * 86400));
        } else {
            $si = "'rememberme' => FALSE,";
            setcookie("pass");
            setcookie("uno");
        }
        $consulta = $this->db->query('SELECT idUsuario, idPermiso, idEmpresa, nombre, app, apm, nombre_usuario,
                                                contrasena, correo, correo_alterno, website, puesto, tipo,
                                                status, fecha_alta, imagen, ultima_entrada, log_user   
                                        FROM usuarios 
                                        WHERE nombre_usuario="' . $username . '" AND contrasena="' . $password .'"');
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $newdata = array(
                'logged_in' => TRUE,
                $si,
                'nombre' => $row->nombre,
                'app' => $row->app,
                'apm' => $row->apm,
                'nombre_usuario' => $row->nombre_usuario,
                'contrasena' => $row->contrasena,
                'correo' => $row->correo,
                'correo_alterno' => $row->correo_alterno,
                'puesto' => $row->puesto,
                'tipo' => $row->tipo,
                'status' => $row->status,
                'fecha_alta' => $row->fecha_alta,
                'idUsuario' => $row->idUsuario,
                'idEmpresa' => $row->idEmpresa,
                'idPermiso' => $row->idPermiso,
            );

            $this->session->set_userdata($newdata);
            $fechahoy = date('Y-m-d H:i:s');
            $data = array('ultima_entrada' => $fechahoy,
                'log_user' => 'Login');
            $this->db->update('usuarios', $data, "idUsuario = $row->idUsuario");
            //TODO: Borrar comentario
            //echo "<script language='javascript'>top.location.href= '".base_url()."antad'</script>";            
            //redirect('modulos/exit');
            $data['content'] = 'modulos/exit';
            $this->load->view('exitpopup/index', $data);
            } else {
            $data['error'] = "Clave de acceso o usuario incorrectos";
            $data['content'] = 'modulos/loginPop';
            $this->load->view('modulos/loginLayout', $data);
        }
    }
    
    function process_login2() {
        $preg = preg_match("/url_referer\=[\w\:\/\/\.]*/i", $_SERVER['REQUEST_URI'], $vars);
        $url = explode("=", $vars[0]);
       // mysql_close();
//$link = mysql_connect("localhost", "antadbiz", "63zp8CocQ89VgO");


        $username = mysql_real_escape_string( $this->input->post('username') );
        $password = mysql_real_escape_string( $this->input->post('password') );

        if($username==''||$password==''){
            redirect("login/forgot");
        }

        $remember = $this->input->post('rememberme');
        if (!empty($remember)) {
            $si = "'rememberme' => TRUE,";
            setcookie("pass", $username, time() + (7 * 86400));
            setcookie("uno", $password, time() + (7 * 86400));
        } else {
            $si = "'rememberme' => FALSE,";
            setcookie("pass");
            setcookie("uno");
        }
        $consulta = $this->db->query('SELECT idUsuario, idPermiso, idEmpresa, nombre, app, apm, nombre_usuario,
                                                contrasena, correo, correo_alterno, website, puesto, tipo,
                                                status, fecha_alta, imagen, ultima_entrada, log_user   
                                        FROM usuarios 
                                        WHERE nombre_usuario="' . $username . '" AND contrasena="' . $password .'"');
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $newdata = array(
                'logged_in' => TRUE,
                $si,
                'nombre' => $row->nombre,
                'app' => $row->app,
                'apm' => $row->apm,
                'nombre_usuario' => $row->nombre_usuario,
                'contrasena' => $row->contrasena,
                'correo' => $row->correo,
                'correo_alterno' => $row->correo_alterno,
                'puesto' => $row->puesto,
                'tipo' => $row->tipo,
                'status' => $row->status,
                'fecha_alta' => $row->fecha_alta,
                'idUsuario' => $row->idUsuario,
                'idEmpresa' => $row->idEmpresa,
                'idPermiso' => $row->idPermiso,
            );

            $this->session->set_userdata($newdata);
            $fechahoy = date('Y-m-d H:i:s');
            $data = array('ultima_entrada' => $fechahoy,
                'log_user' => 'Login');

            $this->db->update('usuarios', $data, "idUsuario = $row->idUsuario");
            //TODO: Borrar comentario
            //echo "<script language='javascript'>top.location.href= '".base_url()."antad'</script>";
            //  echo "<script language='javascript'>top.location.reload();</script>"; 
            if ($this->session->userdata('tipo') == 1 or $this->session->userdata('tipo') == 11) {
                $tipo = '';
            } else {
                $tipo = $this->session->userdata('tipo');
            }


            if (isset($url[1])) {
                redirect($url[1]);
            }

            redirect("escritorio");
        } else {
            //$this->load->view('forgotPass');
            redirect("login/forgot");
        }
    }

    public function forgot()
    {
        $this->load->view('forgotPass');
    }

    public function recover()
    {
        $this->form_validation->set_rules('correo', 'correo electrónico', 'valid_email|trim');

        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('recoverPass');

        } else {
            die($this->input->post('correo'));
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        //TODO: Borrar comentario
        //echo "<script language='javascript'>top.location.href= '" . base_url() . "'</script>";
        //echo "<script language='javascript'>top.location.reload();</script>";
        header("Cache-Control: no-cache, must-revalidate");
        header("location:http://www.antad.biz/antad/index/logout/" . time());
        redirect("antad");
        //$data['msg'] = 'Redirigiendo a Antad';
        //$this->load->view('modulos/redirect', $data);
        //TODO: Borrar comentario
        //redirect("antad", 'refresh');
    }

    function recupera() {

        $this->form_validation->set_rules('correo', 'correo electrónico', 'valid_email|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('modulos/recupera');

        } else {
            $correo = mysql_real_escape_string( $this->input->post('correo') );
            $res = mysql_query("SELECT COUNT(idUsuario) 
                            FROM usuarios 
                            WHERE correo='$correo'");

            if (mysql_num_rows($res) == 0) {
                $this->load->view('modulos/recupera');
            } else {
                $res = mysql_query("SELECT idUsuario, idPermiso, idEmpresa, nombre, app,
                                            apm, nombre_usuario, contrasena, correo, 
                                            correo_alterno, website, puesto, tipo, status,
                                            fecha_alta, imagen, ultima_entrada, log_user                    
                                    FROM usuarios 
                                    WHERE correo='$correo'");

                $row = mysql_fetch_assoc($res);
                $psw = $row['contrasena'];
                $usr = $row['nombre_usuario'];
                $nombreCnt = $row['nombre'];
                $appCnt = $row['app'];

                if ($usr == "") {

                    //redirect("login/recupera");
                    $data['correo'] = $correo;
                    $this->load->view('modulos/email_error', $data);
                    return;
                }
                //die($usr);
                
                //TODO: Borrar comentario
                //mail($emailusuario, "Recuperación", "Sus datos en nuestra web son $nombreusuario, $claveusuario", $headers);

                $subject = "Recordatorio de Usuario y Contraseña";
                $sender = "ANTAD";

                $destinatario = $nombreCnt . ' ' . $appCnt;
                $mail = new PHPMailer();
                $mail->Host = "localhost";
                $mail->IsMail(TRUE);
                $mail->From = "noreply@antad.biz"; //de que direccion se envia el correo
                $mail->FromName = $sender; //Quien envia el COrreo
                $mail->AddAddress($correo, $destinatario); //a quien se envia el correo
                $mail->Subject = $subject; //Asunto
                $mail->IsHTML(TRUE);
                $mail->Body = '
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>ANTAD.biz</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head><body>
    <table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="133" bgcolor="#FFFFFF" style="font-weight: bold;font-family: Verdana, Geneva, sans-serif; color: #999;" background="http://antad.biz/images/mailB/head.png"><table width="734" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="268" height="81"><a href="http://www.antad.biz"><img src="http://antad.biz/images/mailB/logohead.png" width="266" height="81" alt="logo" border="0" /></a></td>
            <td width="466" align="center" style="font-weight: bold; color:#333;">TE DAMOS LA BIENVENIDA A ANTAD.biz<br />
              <br /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="inherit" bordercolor="#inherit" class="border" style="color:; font-family: Verdana, Geneva, sans-serif;" background="http://devel.antad.biz/images/mailB/body.png><br>&nbsp;
          <div style="margin: 5px 10px 5px 10px;width: 90%;">
          <br>Hola ' . $destinatario . ',
          <br>
          <br>Este mensaje contiene tu nombre de usuario y contraseña, los necesitarás para poder iniciar sesión en <a href="http://www.antad.biz">http://www.antad.biz</a>
          <br>Nombre de usuario: [ ' . $usr . ' ]
          <br>Contraseña: [ ' . $psw . ' ]
          <br>&nbsp;
          <br>Por favor, no respondas a este mensaje ya que ha sido generado automáticamente con el propósito de informarte.
          <br>&nbsp;
          <br>El equipo de ANTAD.biz
          </div>
        </td>
      </tr>
      <tr>
        <td height="18" bgcolor="#FFFFFF" background="http://devel.antad.biz/images/mailB/foot.png">&nbsp;</td>
      </tr>
      <tr>
        <td height="18" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></body>
    </html>';

                if (!$mail->Send()) {

                    echo "Se ha producido un error al enviar el correo.";

                    echo "Mailer Error: " . $mail->ErrorInfo;

                    exit;
                } else {
                    $data['correo'] = $correo;
                    $this->load->view('modulos/confirm', $data);
                }
            }
        }

    }

    function process_reset() {
        $correo = mysql_real_escape_string( $this->input->post('correo') ); 
        $res = mysql_query("SELECT COUNT(idUsuario) 
                            FROM usuarios 
                            WHERE correo='$correo'");

        if (mysql_num_rows($res) == 0) {
            $this->load->view('modulos/recupera');
        } else {
            $res = mysql_query("SELECT idUsuario, idPermiso, idEmpresa, nombre, app,
                                        apm, nombre_usuario, contrasena, correo, 
                                        correo_alterno, website, puesto, tipo, status,
                                        fecha_alta, imagen, ultima_entrada, log_user                    
                                FROM usuarios 
                                WHERE correo='$correo'");
            $row = mysql_fetch_assoc($res);
            $psw = $row['contrasena'];
            $usr = $row['nombre_usuario'];
            $nombreCnt = $row['nombre'];
            $appCnt = $row['app'];
            
            //TODO: Borrar comentario
            //mail($emailusuario, "Recuperación", "Sus datos en nuestra web son $nombreusuario, $claveusuario", $headers);

            $subject = "Recordatorio de Usuario y Contraseña";
            $sender = "ANTAD";

            $destinatario = $nombreCnt . ' ' . $appCnt;
            $mail = new PHPMailer();
            $mail->Host = "localhost";
            $mail->IsMail(TRUE);
            $mail->From = "noreply@antad.biz"; //de que direccion se envia el correo
            $mail->FromName = $sender; //Quien envia el COrreo
            $mail->AddAddress($correo, $destinatario); //a quien se envia el correo
            $mail->Subject = $subject; //Asunto
            $mail->IsHTML(TRUE);
            $mail->Body = '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>ANTAD.biz</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="133" bgcolor="#FFFFFF" style="font-weight: bold;font-family: Verdana, Geneva, sans-serif; color: #999;" background="http://antad.biz/images/mailB/head.png"><table width="734" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="268" height="81"><a href="http://www.antad.biz"><img src="http://antad.biz/images/mailB/logohead.png" width="266" height="81" alt="logo" border="0" /></a></td>
        <td width="466" align="center" style="font-weight: bold; color:#333;">TE DAMOS LA BIENVENIDA A ANTAD.biz<br />
          <br /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="inherit" bordercolor="#inherit" class="border" style="color:; font-family: Verdana, Geneva, sans-serif;" background="http://devel.antad.biz/images/mailB/body.png><br>&nbsp;
      <div style="margin: 5px 10px 5px 10px;width: 90%;">
      <br>Hola ' . $destinatario . ',
      <br>
      <br>Este mensaje contiene tu nombre de usuario y contraseña, los necesitarás para poder iniciar sesión en <a href="http://www.antad.biz">http://www.antad.biz</a>
      <br>Nombre de usuario: [ ' . $usr . ' ]
      <br>Contraseña: [ ' . $psw . ' ]
      <br>&nbsp;
      <br>Por favor, no respondas a este mensaje ya que ha sido generado automáticamente con el propósito de informarte.
      <br>&nbsp;
      <br>El equipo de ANTAD.biz
      </div>
    </td>
  </tr>
  <tr>
    <td height="18" bgcolor="#FFFFFF" background="http://devel.antad.biz/images/mailB/foot.png">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table></body>
</html>';

            if (!$mail->Send()) {

                echo "Se ha producido un error al enviar el correo.";

                echo "Mailer Error: " . $mail->ErrorInfo;

                exit;
            } else {
                $data['correo'] = $correo;
                $this->load->view('modulos/confirm', $data);
            }
        }
    }

    function first_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $consulta = $this->db->query('SELECT idUsuario, idPermiso, idEmpresa, nombre, app, apm, 
                                                nombre_usuario, contrasena, correo, correo_alterno, 
                                                website, puesto, tipo, status, fecha_alta, imagen, 
                                                ultima_entrada, log_user
                                       FROM usuarios 
                                       WHERE nombre_usuario="' . $username . '" AND contrasena="' . $password .'"');
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $newdata = array(
                'logged_in' => TRUE,
                'nombre' => $row->nombre,
                'app' => $row->app,
                'apm' => $row->apm,
                'nombre_usuario' => $row->nombre_usuario,
                'contrasena' => $row->contrasena,
                'correo' => $row->correo,
                'correo_alterno' => $row->correo_alterno,
                'puesto' => $row->puesto,
                'tipo' => $row->tipo,
                'status' => $row->status,
                'fecha_alta' => $row->fecha_alta,
                'idUsuario' => $row->idUsuario,
                'idEmpresa' => $row->idEmpresa,
                'idPermiso' => $row->idPermiso,
            );

            $this->session->set_userdata($newdata);
            $fechahoy = date('Y-m-d H:i:s');
            $data = array('ultima_entrada' => $fechahoy);
            $this->db->update('usuarios', $data, "idUsuario = $row->idUsuario");
            if ($this->session->userdata('tipo') == 1 or $this->session->userdata('tipo') == 11) {
                $tipo = '';
            } else {
                $tipo = $this->session->userdata('tipo');
            }
            redirect("escritorio$tipo[0]");
        } else {
            redirect(base_url());
        }
    }

}
?>
