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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous"/>
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="styles/style.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
    
    <!--begin::Header-->
    <?php include 'header.php'; ?>
    <!--end::Header-->

    <!--begin::HOME-->
        <section class="home" id="home">
            <div class="row">
                <div class="content">
                    <h3>Instrumentos Musicales</h3>
                    <p>Tenemos los mejores precios en instrumentos musciales. Con la mejor financiación del mercado. desde guitarras hasta baterías. Qué esperas para adquirir un nuevo instrumento?</p>
                    <a href="products.php" class="btn">Comprar Ahora</a>
                </div>
                <div class="swiper products-slider">
                    <div class="swiper-wrapper">
                        <a href="#" class="swiper-slide"><img src="../../uploads/guitar-159661_1280.png" ></a>
                        <a href="#" class="swiper-slide"><img src="../../uploads/drums-31362_1280.png" ></a>
                        <a href="#" class="swiper-slide"><img src="../../uploads/music-4116645_1280.png" ></a>
                        <a href="#" class="swiper-slide"><img src="../../uploads/musical-4009232_1280.png" ></a>

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

<?php include "footer.php" ?>

    <!--end::Footer-->

</body>
</html>

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

