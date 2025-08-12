<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="modal fade" id="addprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить новую цену детали</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <?php
                        $detail_query = "SELECT * FROM detail";
                        $detail_run = mysqli_query($connection, $detail_query);
                        if(mysqli_num_rows($detail_run) > 0)
                        {
                    ?>
                    <div class="form-group">
                        <label>Деталь</label>
                        <select name="iddetail" class="form-control" required>
                            <option value="">Выберите деталь</option>
                            <?php foreach($detail_run as $row) { ?>
                                <option value="<?php echo $row['iddetail']; ?>"><?php echo $row['detail']; ?></option>
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
                    <button type="submit" name="add_detail_price" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">История цен на детали
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
            $query = "SELECT dpl.iddetail_price_list, dpl.iddetail, d.detail, dpl.price, dpl.start_data, dpl.end_data FROM detail_price_list dpl JOIN detail d ON dpl.iddetail = d.iddetail ORDER BY dpl.start_data DESC";
            $query_run = mysqli_query($connection, $query);
            if(mysqli_num_rows($query_run) > 0)
            {
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Деталь</th>
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
                        <!-- <td><?php echo $row['iddetail_price_list']; ?></td> -->
                        <td><?php echo $row['detail']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['start_data']; ?></td>
                        <td><?php echo $row['end_data']; ?></td>
                        <td>
                        <form action="detail_price_list_edit.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="detail_price_edit_id" value="<?php echo $row['iddetail_price_list']; ?>">
                            <button type="submit" name="detail_price_edit_data_btn" class="btn btn-success">Изменить</button>
                        </form>
                            </td>
                        <td>
                            
                            <form action="code.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="detail_price_list_delete_id" value="<?php echo $row['iddetail_price_list']; ?>">
                                <button type="submit" name="detail_price_list_delete_btn" class="btn btn-danger">Удалить</button>
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