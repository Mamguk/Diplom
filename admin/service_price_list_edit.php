<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary">
                Редактирование цены услуги
            </h3>
        </div>
    </div>
    <div class="card-body">
    <?php
    if(isset($_POST['service_price_edit_data_btn']))
    {
        $idservice_price_list = $_POST['service_price_edit_id'];
        $query = "SELECT * FROM service_price_list WHERE idservice_price_list='$idservice_price_list' ";
        $query_run = mysqli_query($connection, $query);
        foreach($query_run as $rowediting)
        {
    ?>
        <form action="code.php" method="POST">
            <input type="hidden" name="idservice_price_list" value="<?php echo $rowediting['idservice_price_list']?>">
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
                        <?php
                        foreach($service_run as $service_row)
                        {
                        ?>
                        <option value="<?php echo $service_row['idservice']; ?>" <?php if($service_row['idservice'] == $rowediting['idservice']) echo 'selected'; ?>><?php echo $service_row['service']; ?></option>
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
            <a href="service_price_list.php" class="btn btn-danger">Отменить</a>
            <button type="submit" name="service_price_update_btn" class="btn btn-primary">Обновить</button>
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