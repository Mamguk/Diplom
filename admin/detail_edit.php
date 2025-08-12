<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary">
                Детали редактирование
            </h3>
        </div>
    </div>
    <div class="card-body">

    <?php
    if(isset($_POST['detail_edit_data_btn']))
    {
        $iddetail = $_POST['detail_edit_id'];

        $query = "SELECT * FROM detail WHERE iddetail='$iddetail' ";
        $query_run = mysqli_query($connection, $query);

        foreach($query_run as $rowediting)
        {
    ?>

        <form action="code.php" method="POST">
            <input type="hidden" name="iddetail" value="<?php echo $rowediting['iddetail']?>">

            <?php
                        
            $detailtype = "SELECT * from detailtype";
            $detailtype_run = mysqli_query($connection, $detailtype);

            if(mysqli_num_rows($detailtype_run) > 0)
            {
                ?>
                <div class="form-group">
                    <label> Категория детали </label>
                    <select name="iddetailtype" class="form-control" required>
                        <option value="">Выберите категорию детали</option>
                            <?php
                                foreach($detailtype_run as $row)
                                {
                            ?>
                        <option value="<?php echo $row['id_type']; ?>"><?php echo $row['type']; ?></option>
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
                <label> Деталь </label>
                <input type="text" name="detail" class="form-control" value="<?php echo $rowediting['detail'] ?>" required>
            </div>

            <a href="detail.php" class="btn btn-danger"> Отменить </a>
            <button type="submit" name="detail_update_btn" class="btn btn-primary"> Обновить </button>
        </form>

    <?php
        }
    }

    ?>
</div>
</div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>