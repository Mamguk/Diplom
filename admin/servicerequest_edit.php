<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary">
                Заявки редактирование
            </h3>
        </div>
    </div>
    <div class="card-body">

    <?php
    if(isset($_POST['servicerequest_data_btn']))
    {
        $idservicerequest = $_POST['servicerequest_id'];

        $query = "SELECT * FROM servicerequest WHERE idservicerequest='$idservicerequest' ";
        $query_run = mysqli_query($connection, $query);

        foreach($query_run as $row)
        {
?>

        <form action="code.php" method="POST">
            <input type="hidden" name="idservicerequest" value="<?php echo $row['idservicerequest']?>">

            <div class="form-group">
                <label> ФИО </label>
                <input type="text" name="name" value="<?php echo $row['name']?>" class="form-control">
            </div>
            
            <div class="form-group">
                <label> Телефон </label>
                <input type="text" name="phone" value="<?php echo $row['phone']?>" class="form-control">
            </div>
            
            <div class="form-group">
                <label> Марка и модель авто </label>
                <input type="text" name="auto" value="<?php echo $row['auto']?>" class="form-control">
            </div>

            <div class="form-group">
                <label> Проблема </label>
                <input type="text" name="problem" value="<?php echo $row['problem']?>" class="form-control">
            </div>

            <div class="form-group">
                <label> Дата </label>
                <input type="datetime-local" name="date" value="<?php echo $row['date']?>" class="form-control">
            </div>

            <a href="servicerequest.php" class="btn btn-danger"> Отменить </a>
            <button type="submit" name="servicerequest_update_btn" class="btn btn-primary"> Обновить </button>
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