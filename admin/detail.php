<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="modal fade" id="adddetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить новую деталь</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">

                <div class="modal-body">

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
                        <input type="text" name="detail" class="form-control" placeholder="Введите название детали" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" name="add_detail"class="btn btn-primary">Добавить</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Детали
            <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#adddetail">
                Добавить новую деталь
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
            
            $query = "SELECT * FROM `detail`";
            $query_run = mysqli_query($connection, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
                ?>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th>ID детали</th> -->
                        <th>Категория детали</th>
                        <th>Деталь</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                            $id_type = $row['iddetailtype'];
                            $type = "SELECT * FROM detailtype WHERE id_type='$id_type' ";
                            $type_run = mysqli_query($connection, $type);
                    ?>
                        <tr>
                            <!-- <td><?php echo $row['iddetail'] ?></td> -->
                            <td>
                                <?php 
                                    foreach($type_run as $type_row)
                                    {
                                        echo $type_row['type'];
                                    } 
                                ?>
                            </td>
                            <td><?php echo $row['detail'] ?></td>
                            <td>
                                <form action="detail_edit.php" method="POST">
                                    <input type="hidden" name="detail_edit_id" value=" <?php echo $row['iddetail'] ?>" >
                                    <button type="submit" name="detail_edit_data_btn" class="btn btn-success">Изменить</button>
                                </form>
                            </td>
                            <td>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="detail_delete_id" value="<?php echo $row['iddetail'] ?>">
                                    <button type="submit" name="detail_delete_btn" class="btn btn-danger">Удалить</button>
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
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>