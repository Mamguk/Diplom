<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Заказ-наряды</h3>
        </div>
    </div>
    <div class="card-body">
    <?php
    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    {
        echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>';
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
        unset($_SESSION['status']);
    }
    ?>
    <div class="table-responsive">
    <?php
    $query = "SELECT o.idorderclient,
    GROUP_CONCAT(DISTINCT s.service SEPARATOR ', ') as services,
    GROUP_CONCAT(DISTINCT so.idserviceorder SEPARATOR ', ') as serviceorders,
    GROUP_CONCAT(DISTINCT CONCAT(d.detail, ' (x', IFNULL(do.count, 0), ')') SEPARATOR ', ') as details,
    MIN(so.idserviceorder) as min_serviceorder
    FROM serviceorder so
    JOIN service s ON so.idservice = s.idservice
    JOIN orderclient o ON so.idorderclient = o.idorderclient
    LEFT JOIN detailorder do ON do.idorderclient = o.idorderclient
    LEFT JOIN detail d ON do.iddetail = d.iddetail
    GROUP BY o.idorderclient";
    $query_run = mysqli_query($connection, $query);
    if(mysqli_num_rows($query_run) > 0)
    {
    ?>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Номер заказа клиента</th>
                <th>Услуги</th>
                <th>Детали</th>
                <th>Печать</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($row = mysqli_fetch_assoc($query_run))
                {
            ?>
            <tr>
                <td><?php echo $row['idorderclient'] ?></td>
                <td>
                    <?php
                    $services = explode(',', $row['services']);
                    echo '<select class="form-control" multiple style="max-height: 80px; overflow-y: auto;">';
                    foreach($services as $service) {
                        echo '<option>' . trim($service) . '</option>';
                    }
                    echo '</select>';
                    ?>
                </td>
                <td>
                    <?php
                    if ($row['details']) {
                        $details = explode(',', $row['details']);
                        echo '<select class="form-control" multiple style="max-height: 80px; overflow-y: auto;">';
                        foreach($details as $detail) {
                            echo '<option>' . trim($detail) . '</option>';
                        }
                        echo '</select>';
                    } else {
                        echo 'Нет деталей';
                    }
                    ?>
                </td>
                <td>
                <form action="print.php" method="POST">
                                    <input type="hidden" name="idorderclient_id_print" value="<?php echo $row['idorderclient'] ?>">
                                    <button type="submit" name="idorderclient_zakaz_naryad_btn" class="btn btn-info">Печать</button>
                                </form>
                </td>
            </tr>
            <?php        
                }
            ?>
        </tbody>
    </table>
    <?php
    }
    else
    {
        echo "Записи не найдены";
    }
    ?>
    </div>
    </div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>