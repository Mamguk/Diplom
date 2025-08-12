<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
$status_category = mysqli_query($connection, "SELECT status FROM orderclient, status where (orderclient.idstatus = status.idstatus) GROUP BY status;");
$status_amt = mysqli_query($connection, "SELECT count(orderclient.idstatus), status FROM orderclient, status where (orderclient.idstatus = status.idstatus) GROUP BY status;");

$exp_date_line = mysqli_query($connection, "SELECT dateorder, idstatus FROM orderclient where idstatus = '3'  GROUP BY dateorder");
$exp_cost_line = mysqli_query($connection, "SELECT d.dateorder, IFNULL(s.services_sum,0) + IFNULL(dt.details_sum,0) as total_sum FROM (SELECT dateorder FROM orderclient WHERE idstatus = '3' GROUP BY dateorder) d LEFT JOIN (SELECT oc.dateorder, SUM(so.price_at_order) as services_sum FROM orderclient oc INNER JOIN serviceorder so ON so.idorderclient = oc.idorderclient WHERE oc.idstatus = '3' GROUP BY oc.dateorder) s ON d.dateorder = s.dateorder LEFT JOIN (SELECT oc.dateorder, SUM(do.price_at_order * do.count) as details_sum FROM orderclient oc INNER JOIN detailorder do ON do.idorderclient = oc.idorderclient WHERE oc.idstatus = '3' GROUP BY oc.dateorder) dt ON d.dateorder = dt.dateorder ORDER BY d.dateorder");
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Выход
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Панель управления</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Прибыль (за месяц)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                          require 'security.php';
                                          $query_all_month = "SELECT SUM(price_at_order) as totalcost FROM serviceorder, orderclient WHERE (dateorder BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW())) AND (idstatus = '3') AND (serviceorder.idorderclient = orderclient.idorderclient)";
                                          $query_all_month_run = mysqli_query($connection, $query_all_month);
                                          $row = mysqli_fetch_assoc($query_all_month_run);
                                          echo ($row['totalcost'] ? $row['totalcost'] : '0') . "₽";
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Выручка (за все время)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        require 'security.php';

                                        // Сумма всех услуг
                                        $query_services = "SELECT SUM(price_at_order) as SUMCOST FROM serviceorder, orderclient WHERE (serviceorder.idorderclient = orderclient.idorderclient) AND (idstatus = '3')";
                                        $query_services_run = mysqli_query($connection, $query_services);
                                        $row_services = mysqli_fetch_assoc($query_services_run);
                                        $sum_services = $row_services['SUMCOST'] ? $row_services['SUMCOST'] : 0;
                                        // Сумма всех деталей
                                        $query_details = "SELECT SUM(price_at_order * detailorder.count) as SUMDETAILS FROM detailorder INNER JOIN orderclient ON detailorder.idorderclient = orderclient.idorderclient WHERE orderclient.idstatus = '3'";
                                        $query_details_run = mysqli_query($connection, $query_details);
                                        $row_details = mysqli_fetch_assoc($query_details_run);
                                        $sum_details = $row_details['SUMDETAILS'] ? $row_details['SUMDETAILS'] : 0;
                                        $total_revenue = $sum_services + $sum_details;
                                        echo $total_revenue . "₽";
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Текущих заказов</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        require 'security.php';

                                        $query = "SELECT * FROM `orderclient` where `idstatus` NOT IN (3,4)";
                                        $query_run = mysqli_query($connection, $query);

                                        $row = mysqli_num_rows($query_run);

                                        echo $row;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Прибыль по месяцам (за весь год)</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Статистика заказов</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-one"></i> В работе
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-two"></i> Новый
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-three"></i> Завершен
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-four"></i> Отменен
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <?php
    include('includes/scripts.php');
    include('includes/chart-area.php');
    include('includes/chart-pie.php');
    include('includes/footer.php');
    ?>
