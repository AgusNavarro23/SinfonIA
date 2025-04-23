<?php include 'header.php'; ?>
    <!--begin::Products-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous"/>

<section class="products" id="products">
        <div class="products-layout">
    <!-- Filtros -->
    <aside class="filters">
      <h3>Filtrar por tipo</h3>
      <label><input type="checkbox" name="tipo" value="guitarra" /> Guitarra</label><br>
      <label><input type="checkbox" name="tipo" value="bajo" /> Bajo</label><br>
      <label><input type="checkbox" name="tipo" value="teclado" /> Teclado</label><br>
      <label><input type="checkbox" name="tipo" value="percusion" /> Percusión</label><br>
    </aside>

    <!-- Productos -->
    <div class="grid-container">
      <!-- Repetí este bloque para cada producto -->
      <div class="product-card">
        <div class="image">
          <img src="../../uploads/guitar-149427_1280.png" alt="">
        </div>
        <div class="content">
          <h3>Guitarra Acústica</h3>
          <div class="price">$150.000 <span>$180.000</span></div>
          <button class="btn-cart">Añadir al Carrito</button>
        </div>
      </div>
      <div class="product-card">
        <div class="image">
          <img src="../../uploads/guitar-149427_1280.png" alt="">
        </div>
        <div class="content">
          <h3>Guitarra Acústica</h3>
          <div class="price">$150.000 <span>$180.000</span></div>
          <button class="btn-cart">Añadir al Carrito</button>
        </div>
      </div>
      <div class="product-card">
        <div class="image">
          <img src="../../uploads/guitar-149427_1280.png" alt="">
        </div>
        <div class="content">
          <h3>Guitarra Acústica</h3>
          <div class="price">$150.000 <span>$180.000</span></div>
          <button class="btn-cart">Añadir al Carrito</button>
        </div>
      </div>
      <div class="product-card">
        <div class="image">
          <img src="../../uploads/guitar-149427_1280.png" alt="">
        </div>
        <div class="content">
          <h3>Guitarra Acústica</h3>
          <div class="price">$150.000 <span>$180.000</span></div>
          <button class="btn-cart">Añadir al Carrito</button>
        </div>
      </div>
      <div class="product-card">
        <div class="image">
          <img src="../../uploads/guitar-149427_1280.png" alt="">
        </div>
        <div class="content">
          <h3>Guitarra Acústica</h3>
          <div class="price">$150.000 <span>$180.000</span></div>
          <button class="btn-cart">Añadir al Carrito</button>
        </div>
      </div>
      <!-- ...otros productos -->
    </div>
  </div>
</section>
    <?php include "footer.php" ?>

    <!--end::Products-->
