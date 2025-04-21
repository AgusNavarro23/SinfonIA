<?php
include_once "db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);
$con->set_charset("utf8");
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="content-wrapper container-fluid px-5 py-4">
<?php
    if (isset($_REQUEST['idBorrar'])) {
        $id = mysqli_real_escape_string($con, $_REQUEST['idBorrar'] ?? '');
        $query = "DELETE FROM productos WHERE id='$id';";
        $res = mysqli_query($con, $query);

        if ($res) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Hecho!',
                    text: 'Producto eliminado exitosamente.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'panel.php?modulo=productos';
                });
            </script>";
        } else {
            $error = mysqli_error($con);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al eliminar producto',
                    text: '". addslashes($error) ."',
                    showConfirmButton: true
                });
            </script>";
        }
    }

    if (isset($_POST['crearUsuario'])) {
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $precio= doubleval($_POST['precio']);
        $existencia =intval($_POST['existencia']);

        $query = "INSERT INTO productos (nombre, precio, existencia) VALUES ('$nombre', '$precio', '$existencia')";
        $res = mysqli_query($con, $query);

        if ($res) {
            $producto_id = mysqli_insert_id($con);
                    // Procesar imágenes
            if (!empty($_FILES['imagenes']['name'][0])) {
                $total_imagenes = count($_FILES['imagenes']['name']);
                for ($i = 0; $i < $total_imagenes; $i++) {
                    $nombre_img = $_FILES['imagenes']['name'][$i];
                    $tmp = $_FILES['imagenes']['tmp_name'][$i];
                    $ruta = "uploads/" . time() . "_" . basename($nombre_img);
                    if (move_uploaded_file($tmp, $ruta)) {
                        $query_img = "INSERT INTO imagenesProductos (idProducto, url_imagen) VALUES ('$producto_id', '$ruta')";
                        mysqli_query($con, $query_img);
                    }
            }
        }
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Producto creado!',
                    text: 'El nuevo producto fue agregado exitosamente.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'panel.php?modulo=productos';
                });
            </script>";
        } else {
            $error = mysqli_error($con);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al crear producto',
                    text: '". addslashes($error) ."'
                });
            </script>";
        }
    }

    if (isset($_POST['editarUsuario'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $precio= doubleval($_POST['precio']);
        $existencia =intval($_POST['existencia']);

        $query = "UPDATE productos SET nombre='$nombre', precio='$precio',existencia='$existencia' WHERE id='$id'";
        $res = mysqli_query($con, $query);

        if ($res) {
            // Eliminar imágenes anteriores del sistema de archivos
            $query_old_imgs = "SELECT url_imagen FROM imagenesProductos WHERE idProducto='$id'";
            $res_old_imgs = mysqli_query($con, $query_old_imgs);
            while ($old_img = mysqli_fetch_assoc($res_old_imgs)) {
                $ruta_img = $old_img['url_imagen'];
                if (file_exists($ruta_img)) {
                    unlink($ruta_img); // elimina físicamente el archivo
                }
            }

            // Eliminar registros de la base de datos
            $query_del_imgs = "DELETE FROM imagenesProductos WHERE idProducto='$id'";
            mysqli_query($con, $query_del_imgs);

        // Subir nuevas imágenes
        if (!empty($_FILES['imagenes']['name'][0])) {
            $total_imagenes = count($_FILES['imagenes']['name']);
            for ($i = 0; $i < $total_imagenes; $i++) {
                $nombre_img = $_FILES['imagenes']['name'][$i];
                $tmp = $_FILES['imagenes']['tmp_name'][$i];
                $ruta = "uploads/" . time() . "_" . basename($nombre_img);
                if (move_uploaded_file($tmp, $ruta)) {
                    $query_img = "INSERT INTO imagenesProductos (idProducto, url_imagen) VALUES ('$id', '$ruta')";
                    mysqli_query($con, $query_img);
                }
            }
        }
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Producto actualizado!',
                    text: 'Los datos del producto han sido modificados.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'panel.php?modulo=productos';
                });
            </script>";
        } else {
            $error = mysqli_error($con);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al editar producto',
                    text: '". addslashes($error) ."'
                });
            </script>";
        }
    }
?>
<?php
include_once "db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);
$con->set_charset("utf8");

$id = mysqli_real_escape_string($con, $_GET['id'] ?? '');
$query = "SELECT * FROM productos WHERE id='$id'";
$res = mysqli_query($con, $query);
$producto = mysqli_fetch_assoc($res);

$query_img = "SELECT url_imagen FROM imagenesProductos WHERE idProducto='$id'";
$res_img = mysqli_query($con, $query_img);

$imagenes = [];
while ($img = mysqli_fetch_assoc($res_img)) {
    $imagenes[] = $img['url_imagen'];
}


?>

<section class="mb-4">
    <div class="row">
        <div class="col-sm-6">
            <h1>Lista de Productos</h1>
        </div>
    </div>
</section>

<section>
    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center">
            <strong>Productos registrados</strong>
            <button type="button" class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalNuevoProducto">
                <i class="bi bi-plus-circle"></i> Nuevo Producto
            </button>
        </div>
        <div class="card-body">
            <table id="tablaProductos" class="table table-striped table-hover table-bordered w-100">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th style="width: 120px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT id,nombre,precio,existencia FROM productos;";
                    $res = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row['nombre'] ?></td>
                            <td style="text-align: right;"><?php echo '$' . number_format($row['precio'],2,',','.') ?></td>
                            <td><?php echo $row['existencia'] ?></td>
                            <td>
                                <button 
                                    class="btn btn-sm btn-outline-secondary me-1 editarProductoBtn"
                                    data-id="<?php echo $row['id'] ?>"
                                    data-nombre="<?php echo htmlspecialchars($row['nombre']) ?>"
                                    data-precio="<?php echo htmlspecialchars($row['precio']) ?>"
                                    data-existencia="<?php echo htmlspecialchars($row['existencia']) ?>"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="panel.php?modulo=productos&idBorrar=<?php echo $row['id'] ?>" class="btn btn-sm btn-outline-danger borrar" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <button
                                    class="btn btn-sm btn-outline-info detalleProductoBtn"
                                    data-id="<?php echo $row['id'] ?>"
                                    data-nombre="<?php echo htmlspecialchars($row['nombre']) ?>"
                                    data-precio="<?php echo htmlspecialchars($row['precio']) ?>"
                                    data-existencia="<?php echo htmlspecialchars($row['existencia']) ?>"
                                    data-imagenes='<?php
                                    $query_img = "SELECT url_imagen FROM imagenesProductos WHERE idProducto='{$row['id']}'";
                                    $res_img = mysqli_query($con, $query_img);
                                    $imgs = [];
                                    while ($img = mysqli_fetch_assoc($res_img)) {
                                        $imgs[] = $img['url_imagen'];
                                    }
                                    echo json_encode($imgs);
                                    ?>'
                                    title="Ver Detalle"
                                    >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Nuevo Producto -->
<div class="modal fade" id="modalNuevoProducto" tabindex="-1" aria-labelledby="modalNuevoProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNuevoProductoLabel">Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Existencia</label>
            <input type="number" class="form-control" name="existencia" required>
          </div>
          <div class="mb-3">
                <label class="form-label">Imágenes</label>
                <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" name="crearUsuario">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Detalle Producto -->

<div class="modal fade" id="modalDetalleProducto" tabindex="-1" aria-labelledby="modalDetalleProductoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title" id="modalDetalleProductoLabel">Detalle del Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
      <div class="modal-body">
        <h5 id="detalleNombre" class="text-center mb-3"></h5>
        <p><strong>Precio:</strong> $<span id="detallePrecio"></span></p>
        <p><strong>Existencia:</strong> <span id="detalleExistencia"></span></p>
        <div id="detalleImagenes" class="d-flex justify-content-center mb-3"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Editar Producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="editNombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" id="editPrecio" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Existencia</label>
            <input type="number" class="form-control" name="existencia" id="editExistencia" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Imágenes</label>
            <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" name="editarUsuario">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<script>
    $(document).ready(function () {
        $('#tablaProductos').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });

        $('.borrar').on('click', function (e) {
            e.preventDefault();
            const url = this.href;
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

        $('.editarProductoBtn').on('click', function () {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const precio = $(this).data('precio');
            const existencia = $(this).data('existencia');


            $('#editId').val(id);
            $('#editNombre').val(nombre);
            $('#editPrecio').val(precio);
            $('#editExistencia').val(existencia);

            const modal = new bootstrap.Modal(document.getElementById('modalEditarProducto'));
            modal.show();
        });
        function formatearPrecio(precio) {
            return precio.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).replace(',', '.');
        }
        $('.detalleProductoBtn').click(function () {
        const nombre = $(this).data('nombre');
        const precio = $(this).data('precio');
        const existencia = $(this).data('existencia');
        const imagenes = $(this).data('imagenes');

        $('#detalleNombre').text(nombre);
        const precioFormateado = formatearPrecio(precio);
        $('#detallePrecio').text(precioFormateado);
        $('#detalleExistencia').text(existencia);

        let htmlImagenes = '';
        if (imagenes && imagenes.length > 0) {
            imagenes.forEach(function (img) {
                htmlImagenes += `
                    <div class="col-md-3">
                        <img src="${img}" class="img-fluid rounded border" />
                    </div>
                `;
            });
        } else {
            htmlImagenes = '<p class="text-muted">No hay imágenes disponibles</p>';
        }

        $('#detalleImagenes').html(htmlImagenes);
        $('#modalDetalleProducto').modal('show');
    });
    
    });
</script>
<style>
    /* Estilo mejorado para el modal */
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-footer {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }


    .modal-body {
        font-family: Arial, sans-serif;
        font-size: 1rem;
    }

    .modal-body img {
        margin-bottom: 15px;
        transition: transform 0.3s ease-in-out;
    }

    .modal-body img:hover {
        transform: scale(1.09);
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
