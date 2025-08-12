<?php
require_once __DIR__ . '/admin/database/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $auto = trim($_POST['auto'] ?? '');
    $problem = trim($_POST['problem'] ?? '');

    if ($name && $phone && $auto && $problem) {
        $stmt = $connection->prepare("INSERT INTO servicerequest (name, phone, auto, problem) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $phone, $auto, $problem);
        if ($stmt->execute()) {
            echo '<script>alert("Заявка успешно отправлена!");window.location.href="index.html";</script>';
        } else {
            echo '<script>alert("Ошибка при сохранении заявки.");window.history.back();</script>';
        }
        $stmt->close();
    } else {
        echo '<script>alert("Пожалуйста, заполните все поля.");window.history.back();</script>';
    }
}
?>