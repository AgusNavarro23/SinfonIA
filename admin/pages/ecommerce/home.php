<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINFONIA | Tienda</title>

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="styles/style.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
    
    <!--begin::Header-->
    <header class="header">
        <div class="header-1">
            <a href="#" class="logo">  <i class="bi bi-music-note-beamed">Sinfonia</i> </a>

            <form action="" class="search-form">
                <input type="search" name="" placeholder="Buscar Productos" id="search-box" >
                <label for="search-box" class="bi bi-search"></label>
            </form>

            <div class="icons">
                <a href="#" class="bi bi-heart-fill"></a>
                <a href="#" class="bi bi-cart-fill"></a>
                <a href="#" class="bi bi-person-fill" id="login-btn"></a>
            </div>
        </div>
        <div class="header-2">
            <nav class="navbar">
                <a href="#">Inicio</a>
                <a href="#">Productos</a>
                <a href="#">Nosotros</a>
                <a href="#">Contacto</a>
            </nav>
    </div>
    </header>
    <!--end::Header-->
    <!--begin::Bottom Navbar-->

    <nav class="bottom-navbar">
        <a href="#" class="bi bi-house-fill" ></a>
        <a href="#" class="bi bi-tag-fill" ></a>
        <a href="#" class="bi bi-person-heart" ></a>
        <a href="#" class="bi bi-telephone-plus-fill" ></a>
    </nav>
    
    <!--end::Bottom Navbar-->

    <!--begin::Login Forms-->
    <div class="login-form-container">

        <div id="close-login-btn" class="bi bi-x"></div>
        <form action="">
            <h3>Iniciar Sesión</h3>
            <span>Usuario</span>
            <input type="email" name="" class="box" placeholder="Ingresa tu correo" id="">
            <span>Contraseña</span>
            <input type="password" name="" class="box" placeholder="Ingresa tu contraseña" id="">
            <input type="submit" value="Iniciar Sesión" class="btn">
            <p>Olvidaste tu Contraseña?  <a href="#">Click Aquí</a> </p>
            <p>No tienes una cuenta?  <a href="#">Registrate</a> </p>
        </form>
    </div>

    <!--end::Login Forms-->
    

    <!--php:end: Productos-->
        <?php
            include_once "../../db_ecommerce.php";
            $con=mysqli_connect($host,$user,$pass,$db);
            $con -> set_charset("utf8");

            $query="SELECT url_imagen FROM imagenesProductos";
            $res = mysqli_query($con,$query);

            $imagenes=[];
            while($row=mysqli_fetch_assoc($res)){
                $imagenes[]=$row['url_imagen'];
            }
        ?>
    <!--php:begin: Productos-->

    <!--begin::HOME-->
        <section class="home" id="home">
            <div class="row">
                <div class="content">
                    <h3>Instrumentos Musicales</h3>
                    <p>Tenemos los mejores precios en instrumentos musciales. Con la mejor financiación del mercado. desde guitarras hasta baterías. Qué esperas para adquirir un nuevo instrumento?</p>
                    <a href="#" class="btn">Comprar Ahora</a>
                </div>
                <div class="swiper products-slider">
                    <div class="swiper-wrapper">
                        <a href="#" class="swiper-slide"><img src="../../uploads/guitar-159661_1280.png" ></a>
                        <a href="#" class="swiper-slide"><img src="../../uploads/bajo.png" ></a>
                        <a href="#" class="swiper-slide"><img src="../../uploads/electric-guitar-1669233_1280.png" ></a>
                        <a href="#" class="swiper-slide"><img src="../../uploads/guitar-149427_1280.png" ></a>

                    </div>
                    <img src="../../uploads/shelf-575408_1280.png" class="stand" alt="">
                </div>
            </div>
        </section>
    <!--end::HOME-->

    <!--begin::Footer-->

    <section class="icons-container">
        <div class="icons">
            <i class="bi bi-airplane-fill"></i>
            <div class="content">
                <h2>Envió Gratis</h2>
                <p>Con una compra mayor a $50.000 tenés envio gratis a cualquier lugar del país.</p>
            </div>
        </div>

        <div class="icons">
            <i class="bi bi-tags-fill"></i>
            <div class="content">
                <h2>Mejores Productos</h2>
                <p>Contamos con los instrumentos de mayor calidad.</p>
            </div>
        </div>

        <div class="icons">
            <i class="bi bi-lock-fill"></i>
            <div class="content">
                <h2>Pagos Seguros</h2>
                <p>Contás con la mayor seguridad para realizar tus pagos.</p>
            </div>
            
        </div>
        <div class="icons">
            <i class="bi bi-credit-card-fill"></i>
            <div class="content">
                <h2>Métodos de Pago</h2>
                <p>Aceptamos todos los métodos de pago, desde tarjetas hasta transferencias bancaras.</p>
            </div>
        </div>
    </section>

    <!--end::Footer-->


</body>
</html>

<script>
    window.onscroll=()=>{
        if(window.scrollY>80){
            document.querySelector('.header .header-2').classList.add('active')
        }
        else{
            document.querySelector('.header .header-2').classList.remove('active')
        }
        
    }
    window.onload=()=>{
        if(window.scrollY>80){
            document.querySelector('.header .header-2').classList.add('active')
        }
        else{
            document.querySelector('.header .header-2').classList.remove('active')
        }
    }
    let loginForm = document.querySelector('.login-form-container');
    document.querySelector('#login-btn').onclick=()=>{
        loginForm.classList.toggle('active');
    }
    document.querySelector('#close-login-btn').onclick=()=>{
        loginForm.classList.remove('active');
    }
    let index = 0;
    const slide = document.getElementById("carousel-slide");
    const total = slide.children.length;

    function moverCarrusel(dir) {
        index += dir;
        if (index < 0) index = total - 1;
        else if (index >= total) index = 0;

        slide.style.transform = `translateX(-${index * 100}vw)`;
    }

    // Automático cada 5s (opcional)
    setInterval(() => moverCarrusel(1), 5000);
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".products-slider", {
      loop:true,
      autoplay:{
        delay:9500,
        disabledOnInteraction:false,
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script>