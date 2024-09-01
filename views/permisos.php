<!DOCTYPE html>
<html lang="en">

<?php require_once 'header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src=<?= asset('dist/img/AdminLTELogo.png'); ?> alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <?php require_once 'navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once 'sidemenu.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Permisos
                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tablalistado"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                    </tfoot>
                                </table>
                            </div>
                            <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->




        </div>
        <!-- /.content-wrapper -->
        <?php require_once 'footer.php' ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script src=<?= asset('dist/js/permisos.js'); ?>></script>
</body>

</html>