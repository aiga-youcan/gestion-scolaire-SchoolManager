<?php
require_once 'config/db.php';

try {
    // تشفير الباسورد "admin123" داخلياً بـ PHP
    $password_hashed = password_hash('admin123', PASSWORD_BCRYPT);
    
    // تحديث الباسورد للـ admin ف الداتابيز
    $stmt = $pdo->prepare("UPDATE utilisateurs SET password = :password WHERE user = 'admin'");
    $stmt->execute([':password' => $password_hashed]);
    
    // يلا مكانش الـ admin أصلاً كاين، كنزيدوه
    if ($stmt->rowCount() == 0) {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (user, password) VALUES ('admin', :password)");
        $stmt = $stmt->execute([':password' => $password_hashed]);
    }
    
    echo "<h3 style='color: green;'>✔ تم إعداد وتشفير الباسورد بنجاح تام بـ PHP!</h3>";
    echo "<p>امسح هاد الملف (fix.php) دابا، وارجع لصفحة <b>login.php</b> وجرب تدخل.</p>";

} catch (PDOException $e) {
    echo "<h3 style='color: red;'>حدث خطأ: " . $e->getMessage() . "</h3>";
}
?>