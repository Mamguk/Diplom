<?php
include('security.php');

//Мастер
if(isset($_POST['add_rabotnik']))
{
    $worker = $_POST['worker'];
    $phone = $_POST['phone'];

    $worker_query = "INSERT INTO worker (worker, phone) VALUES ('$worker', '$phone')";
    $worker_query_run = mysqli_query($connection, $worker_query);

    if($worker_query_run)
    {
        $_SESSION['success'] = "Мастер добавлен";
        header('Location: rabotnik.php');
    }
    else
    {
        $_SESSION['status'] = "Мастер не добавлен";
        header('Location: rabotnik.php');
    }
}

if(isset($_POST['worker_update_btn']))
{
    $idworker = $_POST['idworker'];
    $worker = $_POST['worker'];
    $phone = $_POST['phone'];

    $worker_query = "UPDATE worker SET worker='$worker', phone='$phone' WHERE idworker='$idworker' ";
    $worker_query_run = mysqli_query($connection, $worker_query);

    if($worker_query_run)
    {
        $_SESSION['success'] = "Мастер обновлен";
            header('Location: rabotnik.php');
    }
    else
    {
        $_SESSION['status'] = "Мастер не обновлен";
            header('Location: rabotnik.php');
    }
}

if(isset($_POST['worker_delete_btn']))
{
    $id = $_POST['worker_delete_id'];

    $query = "DELETE FROM worker WHERE idworker='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Мастер удален";
        header("Location: rabotnik.php");
    }
    else
    {
        $_SESSION['status'] = "Мастер не удален";
        header("Location: rabotnik.php");
    }
}

//Клиент
if(isset($_POST['add_client']))
{
    $client = $_POST['client'];
    $phone = $_POST['phone'];

    $client_query = "INSERT INTO client (client, phone) VALUES ('$client', '$phone')";
    $client_query_run = mysqli_query($connection, $client_query);

    if($client_query_run)
    {
        $_SESSION['success'] = "Клиент добавлен";
        header('Location: client.php');
    }
    else
    {
        $_SESSION['status'] = "Клиент не добавлен";
        header('Location: client.php');
    }
}

if(isset($_POST['client_update_btn']))
{
    $idclient = $_POST['idclient'];
    $client = $_POST['client'];
    $phone = $_POST['phone'];

    $client_query = "UPDATE client SET client='$client', phone='$phone' WHERE idclient='$idclient' ";
    $client_query_run = mysqli_query($connection, $client_query);

    if($client_query_run)
    {
        $_SESSION['success'] = "Клиент обновлен";
            header('Location: client.php');
    }
    else
    {
        $_SESSION['status'] = "Клиент не обновлен";
            header('Location: client.php');
    }
}

if(isset($_POST['client_delete_btn']))
{
    $id = $_POST['client_delete_id'];

    $query = "DELETE FROM client WHERE idclient='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Клиент удален";
        header("Location: client.php");
    }
    else
    {
        $_SESSION['status'] = "Клиент не удален";
        header("Location: client.php");
    }
}

//Заказ итоговый
if(isset($_POST['add_serviceorder']))
{
    $idorderclient = $_POST['idorderclient'];
    $idservice = $_POST['idservice'];

    // Получаем дату заказа
    $order_date_query = "SELECT dateorder FROM orderclient WHERE idorderclient = '$idorderclient'";
    $order_date_result = mysqli_query($connection, $order_date_query);
    $order_date_row = mysqli_fetch_assoc($order_date_result);
    $order_date = $order_date_row['dateorder'];

    // Получаем актуальную цену услуги на дату заказа
    $price_query = "SELECT price FROM service_price_list WHERE idservice = '$idservice' AND start_data <= '$order_date' ORDER BY start_data DESC LIMIT 1";
    $price_result = mysqli_query($connection, $price_query);
    $price_row = mysqli_fetch_assoc($price_result);
    $price_at_order = $price_row ? $price_row['price'] : 0;

    $serviceorder_query = "INSERT INTO serviceorder (idorderclient, idservice, price_at_order) VALUES ('$idorderclient', '$idservice', '$price_at_order')";
    $serviceorder_query_run = mysqli_query($connection, $serviceorder_query);

    if($serviceorder_query_run)
    {
        $_SESSION['success'] = "Новый итоговый заказ добавлен";
        header('Location: serviceorder.php');
    }
    else
    {
        $_SESSION['status'] = "Новый итоговый заказ не добавлен";
        header('Location: serviceorder.php');
    }
}

if(isset($_POST['serviceorder_update_btn'])) {
  $idorderclient = $_POST['idorderclient'];
  $services = $_POST['services'];
  $details = $_POST['details'] ?? [];

  // Удаляем старые данные
  mysqli_query($connection, "DELETE FROM serviceorder WHERE idorderclient='$idorderclient'");
  mysqli_query($connection, "DELETE FROM detailorder WHERE idorderclient='$idorderclient'");

  // Добавляем услуги
  foreach($services as $service) {
      $idservice = $service['idservice'];
      // Получаем дату заказа
      $order_date_query = "SELECT dateorder FROM orderclient WHERE idorderclient = '$idorderclient'";
      $order_date_result = mysqli_query($connection, $order_date_query);
      $order_date_row = mysqli_fetch_assoc($order_date_result);
      $order_date = $order_date_row['dateorder'];
  
      // Получаем актуальную цену услуги на дату заказа
      $price_query = "SELECT price FROM service_price_list WHERE idservice = '$idservice' AND start_data <= '$order_date' ORDER BY start_data DESC LIMIT 1";
      $price_result = mysqli_query($connection, $price_query);
      $price_row = mysqli_fetch_assoc($price_result);
      $price_at_order = $price_row ? $price_row['price'] : 0;
  
      mysqli_query($connection, "INSERT INTO serviceorder (idorderclient, idservice, price_at_order) VALUES ('$idorderclient', '$idservice', '$price_at_order')");
  }

  // Добавляем детали
  foreach($details as $iddetail => $detail) {
      if(isset($detail['selected']) && $detail['selected'] == '1' && !empty($detail['qty'])) {
          $qty = intval($detail['qty']);
          // Получаем дату заказа
          $order_date_query = "SELECT dateorder FROM orderclient WHERE idorderclient = '$idorderclient'";
          $order_date_result = mysqli_query($connection, $order_date_query);
          $order_date_row = mysqli_fetch_assoc($order_date_result);
          $order_date = $order_date_row['dateorder'];
      
          // Получаем актуальную цену детали на дату заказа
          $price_query = "SELECT price FROM detail_price_list WHERE iddetail = '$iddetail' AND start_data <= '$order_date' ORDER BY start_data DESC LIMIT 1";
          $price_result = mysqli_query($connection, $price_query);
          $price_row = mysqli_fetch_assoc($price_result);
          $price_at_order = $price_row ? $price_row['price'] : 0;
      
          $insert_detail = "INSERT INTO detailorder (idorderclient, iddetail, count, price_at_order) VALUES ('$idorderclient', '$iddetail', '$qty', '$price_at_order')";
          mysqli_query($connection, $insert_detail);
      }
  }

  $_SESSION['success'] = "Итоговый заказ обновлен";
  header('Location: serviceorder.php');
  exit();
}



if(isset($_POST['serviceorder_delete_btn']))
{
    $id = $_POST['serviceorder_delete_id'];

    $query = "DELETE FROM serviceorder WHERE idserviceorder ='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Итоговый заказ удален";
        header("Location: serviceorder.php");
    }
    else
    {
        $_SESSION['status'] = "Итоговый заказ не удален";
        header("Location: serviceorder.php");
    }
}


//Заказ клиена
//Заказ клиента
if(isset($_POST['add_orderclient']))
{
    $dateorder = date('Y-m-d', strtotime($_POST['dateorder']));
    $idstatus = $_POST['idstatus'];
    $termorder = date('Y-m-d', strtotime($_POST['termorder']));
    $idworker = $_POST['idworker'];
    $idauto = $_POST['idauto'];
    $idclient = $_POST['idclient'];
    $comment = mysqli_real_escape_string($connection, $_POST['comment']);

    // Исправленный запрос на INSERT вместо UPDATE
    $query = "INSERT INTO orderclient (dateorder, idstatus, termorder, idworker, idauto, idclient, comment) 
              VALUES ('$dateorder', '$idstatus', '$termorder', '$idworker', '$idauto', '$idclient', '$comment')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Новый заказ клиента добавлен";
        header('Location: orderclient.php');
    }
    else
    {
        $_SESSION['status'] = "Новый заказ клиента не добавлен";
        header('Location: orderclient.php');
    }
}

if(isset($_POST['orderclient_update_btn']))
{
    $idorderclient = $_POST['idorderclient'];
    $dateorder = date('Y-m-d', strtotime($_POST['dateorder']));
    $idstatus = $_POST['idstatus'];
    $termorder = date('Y-m-d', strtotime($_POST['termorder']));
    $idworker = $_POST['idworker'];
    $idauto = $_POST['idauto'];
    $idclient = $_POST['idclient'];
    $comment = $_POST['comment'];

    $query = "UPDATE orderclient SET dateorder='$dateorder', idstatus='$idstatus', termorder='$termorder', idworker='$idworker', idauto='$idauto', idclient='$idclient', comment='$comment'  WHERE idorderclient='$idorderclient' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Заказ клиента обновлен";
            header('Location: orderclient.php');
    }
    else
    {
        $_SESSION['status'] = "Заказ клиента не обновлен";
            header('Location: orderclient.php');
    }
}

if(isset($_POST['orderclient_delete_btn']))
{
    $id = $_POST['idorderclient_delete_id'];

    $query = "DELETE FROM orderclient WHERE idorderclient ='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Заказ клиента удален";
        header("Location: orderclient.php");
    }
    else
    {
        $_SESSION['status'] = "Заказ клиента не удален";
        header("Location: orderclient.php");
    }
}

//Услуги
if(isset($_POST['add_service']))
{
    $id_type = $_POST['id_type'];
    $service = $_POST['service'];

    $services_query = "INSERT INTO service (id_type, service) VALUES ('$id_type', '$service')";
    $services_query_run = mysqli_query($connection, $services_query);

    if($services_query_run)
    {
        $_SESSION['success'] = "Новая услуга добавлена";
        header('Location: services.php');
    }
    else
    {
        $_SESSION['status'] = "Новая услуга не добавлена";
        header('Location: services.php');
    }
}

if(isset($_POST['services_update_btn']))
{
    $idservice = $_POST['idservice'];
    $id_type = $_POST['id_type'];
    $service = $_POST['service'];


    $query = "UPDATE service SET id_type='$id_type', service='$service'  WHERE idservice='$idservice' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Услуга обновлена";
            header('Location: services.php');
    }
    else
    {
        $_SESSION['status'] = "Услуга не обновлена";
            header('Location: services.php');
    }
}

if(isset($_POST['service_delete_btn']))
{
    $id = $_POST['service_delete_id'];

    $query = "DELETE FROM service WHERE idservice ='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Услуга удалена";
        header("Location: avto.php");
    }
    else
    {
        $_SESSION['status'] = "Услуга не удалена";
        header("Location: avto.php");
    }
}

//Детали
if(isset($_POST['add_detail']))
{
    $iddetailtype = $_POST['iddetailtype'];
    $detail = $_POST['detail'];


    $details_query = "INSERT INTO detail (iddetailtype, detail) VALUES ('$iddetailtype', '$detail')";
    $details_query_run = mysqli_query($connection, $details_query);

    if($details_query_run)
    {
        $_SESSION['success'] = "Новая деталь добавлена";
        header('Location: detail.php');
    }
    else
    {
        $_SESSION['status'] = "Новая деталь не добавлена";
        header('Location: detail.php');
    }
}

if(isset($_POST['detail_update_btn']))
{
    $iddetail = $_POST['iddetail'];
    $iddetailtype = $_POST['iddetailtype'];
    $detail = $_POST['detail'];


    $query = "UPDATE detail SET iddetailtype='$iddetailtype', detail='$detail'  WHERE iddetail='$iddetail' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Деталь обновлена";
            header('Location: detail.php');
    }
    else
    {
        $_SESSION['status'] = "Деталь не обновлена";
            header('Location: detail.php');
    }
}

if(isset($_POST['detail_delete_btn']))
{
    $id = $_POST['detail_delete_id'];

    $query = "DELETE FROM detail WHERE iddetail ='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Деталь удалена";
        header("Location: detail.php");
    }
    else
    {
        $_SESSION['status'] = "Деталь не удалена";
        header("Location: detail.php");
    }
}

//Авто
if(isset($_POST['add_avto']))
{
    $number = $_POST['number'];
    $VIN = $_POST['VIN'];
    $idmarka = $_POST['idmarka'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];

    $avto_query = "INSERT INTO auto (number, VIN, idmarka, model, year, mileage) VALUES ('$number', '$VIN', '$idmarka', '$model', '$year', '$mileage')";
$avto_query_run = mysqli_query($connection, $avto_query);

if($avto_query_run)
{
    $_SESSION['success'] = "Новый автомобиль добавлен";
    header('Location: avto.php');
}
else
{
    $_SESSION['status'] = "Новый автомобиль не добавлен";
    header('Location: avto.php');
}
}

if(isset($_POST['avto_update_btn']))
{
    $idauto = $_POST['idauto'];
    $number = $_POST['number'];
    $VIN = $_POST['VIN'];
    $idmarka = $_POST['idmarka'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];

    $query = "UPDATE auto SET number='$number', VIN='$VIN', idmarka='$idmarka', model='$model', year='$year', mileage='$mileage'  WHERE idauto='$idauto' ";
$query_run = mysqli_query($connection, $query);

if($query_run)
{
    $_SESSION['success'] = "Автомобиль обновлен";
    header('Location: avto.php');
}
else
{
    $_SESSION['status'] = "Автомобиль не обновлен";
    header('Location: avto.php');
}
}

if(isset($_POST['avto_delete_btn']))
{
    $id = $_POST['avto_delete_id'];

    $query = "DELETE FROM auto WHERE idauto='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Автомобиль удален";
        header("Location: avto.php");
    }
    else
    {
        $_SESSION['status'] = "Автомобиль не удален";
        header("Location: avto.php");
    }
}

//Тип услуги
if(isset($_POST['add_servicetype']))
{
    $service_type = $_POST['service_type'];

    $query = "INSERT INTO servicetype (type) VALUES ('$service_type')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Тип услуги добавлен";
        header('Location: servicetype.php');
    }
    else
    {
        $_SESSION['status'] = "Тип услуги не добавлен";
        header('Location: servicetype.php');
    }
}

if(isset($_POST['service_update_btn']))
{
    $edit_id = $_POST['edit_id'];
    $edit_type = $_POST['edit_type'];

    $query = "UPDATE servicetype SET type='$edit_type' WHERE id_type='$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Тип услуги обновлен";
            header('Location: servicetype.php');
    }
    else
    {
        $_SESSION['status'] = "Тип услуги не обновлен";
            header('Location: servicetype.php');
    }
}

if(isset($_POST['service_delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM servicetype WHERE id_type='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Тип услуги удален";
        header("Location: servicetype.php");
    }
    else
    {
        $_SESSION['status'] = "Тип услуги не удален";
        header("Location: servicetype.php");
    }
}

//Заявки
if(isset($_POST['add_servicerequest']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $auto = $_POST['auto'];
    $problem = $_POST['problem'];
    $date = $_POST['date'];

    $servicerequest_query = "INSERT INTO servicerequest (name, phone, auto, problem, date) VALUES ('$name', '$phone', '$auto', '$problem', '$date')";
    $servicerequest_query_run = mysqli_query($connection, $servicerequest_query);

    if($servicerequest_query_run)
    {
        $_SESSION['success'] = "Новая заявка добавлена";
        header('Location: servicerequest.php');
    }
    else
    {
        $_SESSION['status'] = "Новая заявка не добавлена";
        header('Location: servicerequest.php');
    }
}

if(isset($_POST['servicerequest_update_btn']))
{
    $idservicerequest = $_POST['idservicerequest'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $auto = $_POST['auto'];
    $problem = $_POST['problem'];
    $date = $_POST['date'];

    $query = "UPDATE servicerequest SET name='$name', phone='$phone', auto='$auto', problem='$problem', date='$date'  WHERE idservicerequest='$idservicerequest' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Заявка обновлена";
            header('Location: servicerequest.php');
    }
    else
    {
        $_SESSION['status'] = "Заявка не обновлена";
            header('Location: servicerequest.php');
    }
}

if(isset($_POST['servicerequest_delete_btn']))
{
    $id = $_POST['servicerequest_delete_id'];

    $query = "DELETE FROM servicerequest WHERE idservicerequest='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Заявка удалена";
        header("Location: servicerequest.php");
    }
    else
    {
        $_SESSION['status'] = "Заявка не удалена";
        header("Location: servicerequest.php");
    }
}


// История цен на услуги
if(isset($_POST['add_service_price'])) {
    $idservice = $_POST['idservice'];
    $price = $_POST['price'];
    $start_data = $_POST['start_data'];


    $query = "INSERT INTO service_price_list ( idservice, price, start_data) VALUES ('$idservice', '$price', '$start_data')";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        $_SESSION['success'] = "Запись о цене услуги добавлена";
        header('Location: service_price_list.php');
    } else {
        $_SESSION['status'] = "Запись о цене услуги не добавлена";
        header('Location: service_price_list.php');
    }
}

if(isset($_POST['service_price_update_btn'])) {
    $idservice_price_list = $_POST['idservice_price_list'];
    $idservice = $_POST['idservice'];
    $price = $_POST['price'];
    $start_data = $_POST['start_data'];
    $end_data = $_POST['end_data'];

    $query = "UPDATE service_price_list SET idservice='$idservice', price='$price', start_data='$start_data', end_data='$end_data' WHERE idservice_price_list='$idservice_price_list'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        $_SESSION['success'] = "Запись о цене услуги обновлена";
        header('Location: service_price_list.php');
    } else {
        $_SESSION['status'] = "Запись о цене услуги не обновлена";
        header('Location: service_price_list.php');
    }
}

if(isset($_POST['service_price_list_delete_btn'])) {
  $id = $_POST['service_price_list_delete_id'];
  $query = "DELETE FROM service_price_list WHERE idservice_price_list='$id' ";
  $query_run = mysqli_query($connection, $query);

  if($query_run) {
      $_SESSION['success'] = "Запись о цене услуги удалена";
      header("Location: service_price_list.php");
  } else {
      $_SESSION['status'] = "Запись о цене услуги не удалена";
      header("Location: service_price_list.php");
  }
}

// История цен на детали
if(isset($_POST['add_detail_price'])) {
  $iddetail = $_POST['iddetail'];
  $price = $_POST['price'];
  $start_data = $_POST['start_data'];


  $query = "INSERT INTO detail_price_list ( iddetail, price, start_data) VALUES ('$iddetail', '$price', '$start_data')";
  $query_run = mysqli_query($connection, $query);

  if($query_run) {
      $_SESSION['success'] = "Запись о цене услуги добавлена";
      header('Location: detail_price_list.php');
  } else {
      $_SESSION['status'] = "Запись о цене услуги не добавлена";
      header('Location: detail_price_list.php');
  }
}

if(isset($_POST['detail_price_update_btn'])) {
  $iddetail_price_list = $_POST['iddetail_price_list'];
  $iddetail = $_POST['iddetail'];
  $price = $_POST['price'];
  $start_data = $_POST['start_data'];
  $end_data = $_POST['end_data'];

  $query = "UPDATE detail_price_list SET iddetail='$iddetail', price='$price', start_data='$start_data', end_data='$end_data' WHERE iddetail_price_list='$iddetail_price_list'";
  $query_run = mysqli_query($connection, $query);

  if($query_run) {
      $_SESSION['success'] = "Запись о цене услуги обновлена";
      header('Location: detail_price_list.php');
  } else {
      $_SESSION['status'] = "Запись о цене услуги не обновлена";
      header('Location: detail_price_list.php');
  }
}

if(isset($_POST['detail_price_list_delete_btn'])) {
$id = $_POST['detail_price_list_delete_id'];
$query = "DELETE FROM detail_price_list WHERE iddetail_price_list='$id' ";
$query_run = mysqli_query($connection, $query);

if($query_run) {
    $_SESSION['success'] = "Запись о цене услуги удалена";
    header("Location: detail_price_list.php");
} else {
    $_SESSION['status'] = "Запись о цене услуги не удалена";
    header("Location: detail_price_list.php");
}
}
?>