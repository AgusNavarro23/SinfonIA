
<?php
            $mostrarAlerta='';
            $mostrarUsuario='';
            if(isset($_REQUEST['login'])){
              session_start();
              $email=&$_REQUEST['email']??'';
              $password=&$_REQUEST['password']??'';
              $password=md5($password);
              include_once "db_ecommerce.php";
              $con=mysqli_connect($host,$user,$pass,$db);
              $con->set_charset("utf8");
              $query="SELECT id,email,nombre FROM usuarios WHERE email='".$email."'and password='".$password."'";
              $res=mysqli_query($con,$query);
              $row=mysqli_fetch_assoc($res);
              if($row){
              $_SESSION['id']=$row['id'];
              $_SESSION['email']=$row['email'];
              $_SESSION['nombre']=$row['nombre'];
              $nombreUsuario=$row['nombre'];
              $mostrarAlerta='success';
            }
            else{
              $mostrarAlerta='error';
            }
          }
        ?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SINFONIA</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Login Page v2" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
  body {
    background: url('dist/assets/img/logo_sinfonia.png') no-repeat center center fixed;
    background-size: cover;
    filter: blur(0px);
    position: relative;
  }

  body::before {
    content: '';
    background: inherit;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    filter: blur(8px);
    z-index: -1;
  }

  .login-box {
    position: relative;
    z-index: 10;
  }

  .card {
    background-color: rgba(0, 0, 0, 0.85);
    color: #fff;
    border-radius: 1rem;
    box-shadow: 0px 8px 20px rgba(255, 255, 0, 0.5);
    backdrop-filter: blur(5px);
  }

  
</style>

  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="card">
        <div class="card-header">
          <a
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0">SINFON<b>IA</b></h1>
          </a>
        </div>
        <div class="card-body login-card-body">
          <p class="login-box-msg">Inicio de Sesión</p>
          <form method="post" onsubmit="mostrarCargando();">
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="loginEmail" type="email" class="form-control" value="" placeholder="" name="email" />
                <label for="loginEmail">Email</label>
              </div>
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="loginPassword" type="password" class="form-control" placeholder="" name="password" />
                <label for="loginPassword">Contraseña</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <!--begin::Row-->
              <div class="col-4" style="width: 100%;">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary" name="login">Iniciar Sesión</button>
                </div>
              </div>
            </div>
          </form>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
      function mostrarCargando() {
        Swal.fire({
          title: 'Verificando...',
          text: 'Por favor espere',
          allowOutsideClick: false,
          timer:2000,
          didOpen: () => {
            Swal.showLoading()
          }
        });
      }

      <?php if ($mostrarAlerta === 'error'): ?>
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: 'Correo o contraseña incorrectos',
  });
<?php elseif ($mostrarAlerta === 'success'): ?>
  Swal.fire({
    icon: 'success',
    title: '¡Bienvenido!',
    text: 'Hola <?= $nombreUsuario ?>',
    showConfirmButton: true
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'panel.php';
    }
  });
<?php endif; ?>
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
