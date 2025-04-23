<link rel="stylesheet" href="styles/style.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous"/>

    <!--begin::Header-->
    <header class="header">
        <div class="header-1">
            <a href="#" class="logo">  <i class="bi bi-music-note-beamed">Sinfonia</i> </a>

            <form action="" class="search-form">
                <input type="search" name="" placeholder="Buscar Productos" id="search-box" >
                <label for="search-box" class="bi bi-search"></label>
            </form>

            <div class="icons">
                <a href="#" class="bi bi-search" id="search-btn"></a>
                <a href="#" class="bi bi-heart-fill"></a>
                <a href="#" class="bi bi-cart-fill"></a>
                <a href="#" class="bi bi-person-fill" id="login-btn"></a>
            </div>
        </div>
        <div class="header-2">
            <nav class="navbar">
                <a href="home.php" class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">Inicio</a>
                <a href="products.php" class="<?= basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : '' ?>">Productos</a>
                <a href="nosotros.php" class="<?= basename($_SERVER['PHP_SELF']) == 'nosotros.php' ? 'active' : '' ?>">Nosotros</a>
                <a href="contacto.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contacto.php' ? 'active' : '' ?>">Contacto</a>
            </nav>
    </div>
    </header>
        <!--begin::Bottom Navbar-->

    <nav class="bottom-navbar">
        <a href="home.php" class="bi bi-house-fill <?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>" ></a>
        <a href="products.php" class="bi bi-tag-fill <?= basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : '' ?>" ></a>
        <a href="nosotros.php" class="bi bi-person-heart <?= basename($_SERVER['PHP_SELF']) == 'nosotros.php' ? 'active' : '' ?>" ></a>
        <a href="contacto.php" class="bi bi-telephone-plus-fill <?= basename($_SERVER['PHP_SELF']) == 'contacto.php' ? 'active' : '' ?>" ></a>
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
    <!--end::Header-->
    <script>
    searchForm = document.querySelector('.search-form');
    document.querySelector('#search-btn').onclick=()=>{
        searchForm.classList.toggle('active');
    }
    window.onscroll=()=>{
        searchForm.classList.remove('active');
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
</script>