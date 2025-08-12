<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="modal fade" id="addprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить новую цену услуги</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <?php
                        $service_query = "SELECT * FROM service";
                        $service_run = mysqli_query($connection, $service_query);
                        if(mysqli_num_rows($service_run) > 0)
                        {
                    ?>
                    <div class="form-group">
                        <label>Услуга</label>
                        <select name="idservice" class="form-control" required>
                            <option value="">Выберите услугу</option>
                            <?php foreach($service_run as $row) { ?>
                                <option value="<?php echo $row['idservice']; ?>"><?php echo $row['service']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } else { echo "Данных не найдено"; } ?>
                    <div class="form-group">
                        <label>Цена</label>
                        <input type="number" name="price" class="form-control" placeholder="Введите цену" required>
                    </div>
                    <div class="form-group">
                        <label>Дата начала</label>
                        <input type="date" name="start_data" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Дата окончания</label>
                        <input type="date" name="end_data" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" name="add_service_price" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">История цен на услуги
                <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#addprice">
                    Добавить новую цену
                </button>
            </h3>
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
            $query = "SELECT spl.idservice_price_list, spl.idservice, s.service, spl.price, spl.start_data, spl.end_data FROM service_price_list spl JOIN service s ON spl.idservice = s.idservice ORDER BY spl.start_data DESC";
            $query_run = mysqli_query($connection, $query);
            if(mysqli_num_rows($query_run) > 0)
            {
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Услуга</th>
                        <th>Цена</th>
                        <th>Дата начала</th>
                        <th>Дата окончания</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query_run)) { ?>
                    <tr>
                        <!-- <td><?php echo $row['idservice_price_list']; ?></td> -->
                        <td><?php echo $row['service']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['start_data']; ?></td>
                        <td><?php echo $row['end_data']; ?></td>
                        <td>
                        <form action="service_price_list_edit.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="service_price_edit_id" value="<?php echo $row['idservice_price_list']; ?>">
                            <button type="submit" name="service_price_edit_data_btn" class="btn btn-success">Изменить</button>
                        </form>
                            </td>
                        <td>
                            
                            <form action="code.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="service_price_list_delete_id" value="<?php echo $row['idservice_price_list']; ?>">
                                <button type="submit" name="service_price_list_delete_btn" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { echo "Записи не найдены"; } ?>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>