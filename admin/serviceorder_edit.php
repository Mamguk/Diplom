<?php
include('security.php');

// AJAX для деталей
if (isset($_POST['fetch_details_for_service']) && isset($_POST['idservice'])) {
  include('database/dbconfig.php');
    $idservice = $_POST['idservice'];
    $query = "SELECT d.iddetail, d.detail, d.cost FROM servicedetail sd JOIN detail d ON sd.iddetail = d.iddetail WHERE sd.idservice = '$idservice'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '<ul class="list-group">';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<li class="list-group-item">'
                .'<input type="checkbox" name="details['.$row['iddetail'].'][selected]" value="1">'
                .$row['detail'].' ('.$row['cost'].' руб.)'
                .'<input type="number" name="details['.$row['iddetail'].'][quantity]" placeholder="Количество" min="1" class="form-control d-inline-block ml-3" style="width: 120px;">'
                .'</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Детали не найдены</p>';
    }
    exit;
}
if (isset($_POST['fetch_details_for_services']) && isset($_POST['idservices'])) {
  include('database/dbconfig.php');
    $idservices = $_POST['idservices'];
    $idorderclient = isset($_POST['idorderclient']) ? intval($_POST['idorderclient']) : 0;
    if (!is_array($idservices)) $idservices = [$idservices];
    $service_type_ids = [];
    foreach ($idservices as $idservice) {
        $type_query = "SELECT id_type FROM service WHERE idservice = '" . intval($idservice) . "'";
        $type_result = mysqli_query($connection, $type_query);
        if ($type_row = mysqli_fetch_assoc($type_result)) {
            $service_type_ids[] = $type_row['id_type'];
        }
    }
    $service_type_ids = array_unique($service_type_ids);
    if (count($service_type_ids)) {
        $types_in_clause = implode(",", array_map('intval', $service_type_ids));
        $details_query = "SELECT d.iddetail, d.detail, (
          SELECT price FROM detail_price_list dpl
          WHERE dpl.iddetail = d.iddetail AND (dpl.end_data IS NULL OR dpl.end_data >= CURDATE())
          ORDER BY dpl.start_data DESC LIMIT 1
      ) AS cost FROM detail d JOIN detailtype dt ON d.iddetailtype = dt.id_type WHERE dt.id_type IN ($types_in_clause)";
        $details_result = mysqli_query($connection, $details_query);
        // Получаем уже выбранные детали для этого заказа
        $selected_details = [];
        if ($idorderclient) {
            $selected_details_query = "SELECT * FROM detailorder WHERE idorderclient='".$idorderclient."'";
            $selected_details_result = mysqli_query($connection, $selected_details_query);
            while($sel = mysqli_fetch_assoc($selected_details_result)) {
                $selected_details[$sel['iddetail']] = $sel['count'];
            }
        }
        while ($detail = mysqli_fetch_assoc($details_result)) {
            $iddetail = $detail['iddetail'];
            $isSelected = isset($selected_details[$iddetail]);
            $checked = $isSelected ? 'checked' : '';
            $qty = $isSelected ? (int)$selected_details[$iddetail] : '';
            echo "<div class='form-check mb-2'>\n";
            echo "<input class='form-check-input' style='margin-top: 12px ;' type='checkbox' name='details[{$iddetail}][selected]' value='1' id='detail_{$iddetail}' {$checked} >\n";
            echo "<label class='form-check-label' for='detail_{$iddetail}'>\n";
            echo "{$detail['detail']} ({$detail['cost']} руб.)\n";
            echo "</label>\n";
            echo "<input type='number' name='details[{$iddetail}][qty]' value='{$qty}' min='1' class='form-control d-inline-block mb-2' style='width: 80px; display: inline;'>\n";
            echo "</div>\n";
        }
    } else {
        echo '<p>Детали не найдены</p>';
    }
    exit;
}
include('includes/header.php');
include('includes/navbar.php');

// AJAX for fetching details for a service
if (isset($_POST['fetch_details_for_service']) && isset($_POST['idservice'])) {
  include('database/dbconfig.php');
    $idservice = $_POST['idservice'];
    $query = "SELECT d.iddetail, d.detail, d.cost FROM servicedetail sd JOIN detail d ON sd.iddetail = d.iddetail WHERE sd.idservice = '$idservice'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '<ul class="list-group">';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<li class="list-group-item">'
                .'<input type="checkbox" name="details['.$row['iddetail'].'][selected]" value="1">'
                .$row['detail'].' ('.$row['cost'].' руб.)'
                .'<input type="number" name="details['.$row['iddetail'].'][quantity]" placeholder="Количество" min="1" class="form-control d-inline-block ml-3" style="width: 120px;">'
                .'</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Детали не найдены</p>';
    }
    exit;
}
if (isset($_POST['fetch_details_for_services']) && isset($_POST['idservices'])) {
  include('database/dbconfig.php');
    $idservices = $_POST['idservices'];
    if (!is_array($idservices)) $idservices = [$idservices];
    $service_type_ids = [];
    foreach ($idservices as $idservice) {
        $type_query = "SELECT id_type FROM service WHERE idservice = '" . intval($idservice) . "'";
        $type_result = mysqli_query($connection, $type_query);
        if ($type_row = mysqli_fetch_assoc($type_result)) {
            $service_type_ids[] = $type_row['id_type'];
        }
    }
    $service_type_ids = array_unique($service_type_ids);
    if (count($service_type_ids)) {
        $types_in_clause = implode(",", array_map('intval', $service_type_ids));
        $details_query = "SELECT d.iddetail, d.detail, d.cost FROM detail d JOIN detailtype dt ON d.iddetailtype = dt.id_type WHERE dt.id_type IN ($types_in_clause)";
        $details_result = mysqli_query($connection, $details_query);
        while ($detail = mysqli_fetch_assoc($details_result)) {
            $iddetail = $detail['iddetail'];
            // Fetch current price for this detail
            $price_query = "SELECT price FROM detail_price_list WHERE iddetail = '$iddetail' AND (end_data IS NULL OR end_data >= CURDATE()) ORDER BY start_data DESC LIMIT 1";
            $price_result = mysqli_query($connection, $price_query);
            $price_row = mysqli_fetch_assoc($price_result);
            $current_price = $price_row ? $price_row['price'] : 'нет цены';
            $isSelected = isset($selected_details[$iddetail]);
            $checked = $isSelected ? 'checked' : '';
            $qty = $isSelected ? (int)$selected_details[$iddetail] : '';
            echo "\n    <div class='form-check mb-2'>\n        <input class='form-check-input' style='margin-top: 12px ;' type='checkbox' name='details[{$iddetail}][selected]' value='1' id='detail_{$iddetail}' {$checked} >\n        <label class='form-check-label' for='detail_{$iddetail}'>\n            {$detail['detail']} (".($current_price !== 'нет цены' ? $current_price.' руб.' : $current_price).")\n        </label>\n        <input type='number' name='details[{$iddetail}][qty]' value='{$qty}' min='1' class='form-control d-inline-block mb-2' style='width: 80px; display: inline;'>\n    </div>";
        }
    } else {
        echo '<p>Детали не найдены</p>';
    }
    exit;
}
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="m-0 font-weight-bold text-primary">Итоговый заказ редактирование</h3>
        </div>
    </div>
    <div class="card-body">
    <?php
    if(isset($_POST['serviceorder_edit_data_btn'])) {
        $idserviceorder = $_POST['serviceorder_edit_id'];
        $query = "SELECT * FROM serviceorder WHERE idserviceorder='$idserviceorder'";
        $query_run = mysqli_query($connection, $query);
        $rowediting = mysqli_fetch_assoc($query_run);
        $orderclient = "SELECT * from orderclient";
        $orderclient_run = mysqli_query($connection, $orderclient);
        $service = "SELECT * from service";
        $service_run = mysqli_query($connection, $service);
        // Получаем все услуги для этого заказа
        $services_query = "SELECT * FROM serviceorder WHERE idorderclient='{$rowediting['idorderclient']}'";
        $services_result = mysqli_query($connection, $services_query);
        $services = [];
        while($srv = mysqli_fetch_assoc($services_result)) {
            $services[] = $srv;
        }
      }
    ?>
        <form action="code.php" method="POST" id="serviceorder-edit-form">
            <input type="hidden" name="idserviceorder" value="<?php echo $rowediting['idserviceorder']?>">
            <div class="form-group">
                <label>ID заказ клиента</label>
                <select name="idorderclient" class="form-control" required>
                    <option value="">Выберите ID заказа</option>
                    <?php foreach($orderclient_run as $row): ?>
                        <option value="<?php echo $row['idorderclient']; ?>" <?php if($row['idorderclient']==$rowediting['idorderclient']) echo 'selected'; ?>><?php echo $row['idorderclient']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- КНОПКИ ПЕРЕМЕЩЕНЫ СЮДА -->
            <button type="button" class="btn btn-success" id="add-service">Добавить услугу</button>
            <a href="serviceorder.php" class="btn btn-danger">Отменить</a>
            <button type="submit" name="serviceorder_update_btn" class="btn btn-primary">Обновить</button>
            <div id="services-container">
                <?php
                foreach($services as $idx=>$srv):
                // Получаем все детали
                $all_details_query = "SELECT * FROM detail";
                $all_details_result = mysqli_query($connection, $all_details_query);
                
                ?>
                <div class="service-block border p-2 mb-2" data-index="<?php echo $idx; ?>">
                    <div class="form-group">
                        <label>Услуга</label>
                        <select name="services[<?php echo $idx; ?>][idservice]" class="form-control service-select" required>
                            <option value="">Выберите услугу</option>
                            <?php mysqli_data_seek($service_run, 0); foreach($service_run as $row): ?>
                                <option value="<?php echo $row['idservice']; ?>" <?php if($row['idservice']==$srv['idservice']) echo 'selected'; ?>><?php echo $row['service']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-service">Удалить услугу</button>
                </div>
                <?php endforeach; ?>
                <!-- БЛОК ДЕТАЛЕЙ ОСТАЕТСЯ НИЖЕ -->
                <hr>

                
              <h5>Детали, подходящие ко всем выбранным услугам</h5>
              <div class="form-group">
                  <div class="details-list">
                      <?php
                      // Собираем типы всех выбранных услуг
                      $service_type_ids = [];
                      foreach ($services as $srv) {
                          $type_query = "SELECT id_type FROM service WHERE idservice = '{$srv['idservice']}'";
                          $type_result = mysqli_query($connection, $type_query);
                          if ($type_row = mysqli_fetch_assoc($type_result)) {
                              $service_type_ids[] = $type_row['id_type'];
                          }
                      }
                      $service_type_ids = array_unique($service_type_ids);
                      $types_in_clause = implode(",", array_map('intval', $service_type_ids));
                    
                      // Выбираем подходящие детали
                      $details_query = "SELECT d.iddetail, d.detail FROM detail d 
                                        JOIN detailtype dt ON d.iddetailtype = dt.id_type 
                                        WHERE dt.id_type IN ($types_in_clause)";
                      $details_result = mysqli_query($connection, $details_query);
                    
                      // Сохраняем уже выбранные детали и их количество
                      $selected_details_query = "SELECT * FROM detailorder WHERE idorderclient='{$rowediting['idorderclient']}'";
                      $selected_details_result = mysqli_query($connection, $selected_details_query);
                      $selected_details = [];
                      while($sel = mysqli_fetch_assoc($selected_details_result)) {
                          $selected_details[$sel['iddetail']] = $sel['count'];
                      }
                    
                      // Отображаем детали
                      while ($detail = mysqli_fetch_assoc($details_result)) {
                          $iddetail = $detail['iddetail'];
                          $isSelected = isset($selected_details[$iddetail]);
                          $checked = $isSelected ? 'checked' : '';
                          $qty = $isSelected ? (int)$selected_details[$iddetail] : '';
                          echo "
                          <div class='form-check mb-2'>
                              <input class='form-check-input' style='margin-top: 12px ;' type='checkbox' name='details[{$iddetail}][selected]' value='1' id='detail_{$iddetail}' {$checked} >
                              <label class='form-check-label' for='detail_{$iddetail}'>
                                  {$detail['detail']} 
                              </label>
                              <input type='number' name='details[{$iddetail}][qty]' value='{$qty}' min='1' class='form-control d-inline-block mb-2' style='width: 80px; display: inline;'>
                          </div>";
                      }
                      ?>
                  </div>
              </div>
            </div>
        </form>
    
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    let serviceIndex = $('#services-container .service-block').length;
    const serviceOptions = `<?php mysqli_data_seek($service_run, 0); foreach($service_run as $row): ?><option value=\"<?php echo $row['idservice']; ?>\"><?php echo $row['service']; ?></option><?php endforeach; ?>`;

    function updateDetailsBlock() {
        let serviceIds = [];
        $('#services-container .service-block select').each(function(){
            let val = $(this).val();
            if(val) serviceIds.push(val);
        });
        // Получаем idorderclient из select
        let idorderclient = $('select[name="idorderclient"]').val();
        // AJAX to fetch details for these services
        $.ajax({
            url: 'serviceorder_edit.php',
            type: 'POST',
            data: { fetch_details_for_services: 1, idservices: serviceIds, idorderclient: idorderclient },
            success: function(html) {
                $('.details-list').html(html);
            }
        });
    }

    $('#add-service').on('click', function(){
        let $detailsBlock = $('#services-container hr');
        let newBlock =
            `<div class=\"service-block border p-2 mb-2\" data-index=\"${serviceIndex}\">\n`+
            `    <div class=\"form-group\">\n`+
            `        <label>Услуга</label>\n`+
            `        <select name=\"services[${serviceIndex}][idservice]\" class=\"form-control service-select\" required>\n`+
            `            <option value=\"\">Выберите услугу</option>\n`+
            `            ${serviceOptions}\n`+
            `        </select>\n`+
            `    </div>\n`+
            `    <button type=\"button\" class=\"btn btn-danger btn-sm remove-service\">Удалить услугу</button>\n`+
            `</div>`;
        if ($detailsBlock.length) {
            $(newBlock).insertBefore($detailsBlock);
        } else {
            $('#services-container').append(newBlock);
        }
        serviceIndex++;
        updateDetailsBlock();
    });

    $('#services-container').on('click', '.remove-service', function(){
        $(this).closest('.service-block').remove();
        updateDetailsBlock();
    });

    $('#services-container').on('change', '.service-select', function(){
        updateDetailsBlock();
    });

    // Initial update
    updateDetailsBlock();
});
</script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
