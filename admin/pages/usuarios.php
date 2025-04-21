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
        $query = "DELETE FROM usuarios WHERE id='$id';";
        $res = mysqli_query($con, $query);

        if ($res) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Hecho!',
                    text: 'Usuario eliminado exitosamente.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'panel.php?modulo=usuarios';
                });
            </script>";
        } else {
            $error = mysqli_error($con);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al eliminar usuario',
                    text: '". addslashes($error) ."',
                    showConfirmButton: true
                });
            </script>";
        }
    }

    if (isset($_POST['crearUsuario'])) {
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contraseña = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$contraseña')";
        $res = mysqli_query($con, $query);

        if ($res) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Usuario creado!',
                    text: 'El nuevo usuario fue agregado exitosamente.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'panel.php?modulo=usuarios';
                });
            </script>";
        } else {
            $error = mysqli_error($con);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al crear usuario',
                    text: '". addslashes($error) ."'
                });
            </script>";
        }
    }

    if (isset($_POST['editarUsuario'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $email = mysqli_real_escape_string($con, $_POST['email']);

        $query = "UPDATE usuarios SET nombre='$nombre', email='$email' WHERE id='$id'";
        $res = mysqli_query($con, $query);

        if ($res) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Usuario actualizado!',
                    text: 'Los datos del usuario han sido modificados.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'panel.php?modulo=usuarios';
                });
            </script>";
        } else {
            $error = mysqli_error($con);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al editar usuario',
                    text: '". addslashes($error) ."'
                });
            </script>";
        }
    }
?>

<section class="mb-4">
    <div class="row">
        <div class="col-sm-6">
            <h1>Lista de Usuarios</h1>
        </div>
    </div>
</section>

<section>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Usuarios registrados</strong>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario">
                <i class="bi bi-plus-circle"></i> Nuevo Usuario
            </button>
        </div>
        <div class="card-body">
            <table id="tablaUsuarios" class="table table-striped table-hover table-bordered w-100">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th style="width: 120px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT id,email,nombre FROM usuarios;";
                    $res = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row['nombre'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td>
                                <button 
                                    class="btn btn-sm btn-outline-secondary me-1 editarUsuarioBtn"
                                    data-id="<?php echo $row['id'] ?>"
                                    data-nombre="<?php echo htmlspecialchars($row['nombre']) ?>"
                                    data-email="<?php echo htmlspecialchars($row['email']) ?>"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="panel.php?modulo=usuarios&idBorrar=<?php echo $row['id'] ?>" class="btn btn-sm btn-outline-danger borrar" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Nuevo Usuario -->
<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNuevoUsuarioLabel">Nuevo Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="contrasena" required>
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

<!-- Modal Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="editNombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" id="editEmail" required>
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
        $('#tablaUsuarios').DataTable({
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

        $('.editarUsuarioBtn').on('click', function () {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const email = $(this).data('email');

            $('#editId').val(id);
            $('#editNombre').val(nombre);
            $('#editEmail').val(email);

            const modal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
            modal.show();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
