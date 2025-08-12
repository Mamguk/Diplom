<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary">
                Редактирование цены детали
            </h3>
        </div>
    </div>
    <div class="card-body">
    <?php
    if(isset($_POST['detail_price_edit_data_btn']))
    {
        $iddetail_price_list = $_POST['detail_price_edit_id'];
        $query = "SELECT * FROM detail_price_list WHERE iddetail_price_list='$iddetail_price_list' ";
        $query_run = mysqli_query($connection, $query);
        foreach($query_run as $rowediting)
        {
    ?>
        <form action="code.php" method="POST">
            <input type="hidden" name="iddetail_price_list" value="<?php echo $rowediting['iddetail_price_list']?>">
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
                        <?php
                        foreach($detail_run as $detail_row)
                        {
                        ?>
                        <option value="<?php echo $detail_row['iddetail']; ?>" <?php if($detail_row['iddetail'] == $rowediting['iddetail']) echo 'selected'; ?>><?php echo $detail_row['detail']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
            }
            else
            {
                echo "Данных не найдено";
            }
            ?>
            <div class="form-group">
                <label>Цена</label>
                <input type="number" name="price" class="form-control" value="<?php echo $rowediting['price'] ?>" required>
            </div>
            <div class="form-group">
                <label>Дата начала</label>
                <input type="date" name="start_data" class="form-control" value="<?php echo $rowediting['start_data'] ?>" required>
            </div>
            <div class="form-group">
                <label>Дата окончания</label>
                <input type="date" name="end_data" class="form-control" value="<?php echo $rowediting['end_data'] ?>">
            </div>
            <a href="detail_price_list.php" class="btn btn-danger">Отменить</a>
            <button type="submit" name="detail_price_update_btn" class="btn btn-primary">Обновить</button>
        </form>
    <?php
        }
    }
    ?>
    </div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>