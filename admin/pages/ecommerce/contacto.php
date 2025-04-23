

<!-- begin:: Contacto  -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/style.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous"/>
<body>
    <?php include "header.php" ?>
    <section class="contacto">
    <div class="contacto-container">
        <p>¿Tenés alguna duda o consulta? ¡Escribinos!</p>
        <form class="contacto-form">
            <div class="input-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre completo" required>
            </div>
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="input-group">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" rows="5" placeholder="Escribí tu mensaje" required></textarea>
            </div>
            <button type="submit" class="btn-enviar">Enviar</button>
        </form>
    </div>
</section>
<?php include "footer.php" ?>
</body>

<!-- end:: Contacto  -->
