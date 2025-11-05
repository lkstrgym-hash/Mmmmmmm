<?php
// بررسی می‌کنیم که اطلاعات فرم با متد POST ارسال شده باشد
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // گرفتن اطلاعات از فرم و تمیز کردن آن‌ها
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);
    
    // تاریخ و زمان جاری
    $timestamp = date("H:i:s");
    
    // ساختار پیام برای ذخیره
    $new_message = "[$timestamp] <b>$username</b>: $message\n";
    
    // نام فایل پیام‌ها
    $messages_file = 'messages.txt';
    
    // ذخیره پیام در فایل (حالت FILE_APPEND به معنی اضافه کردن به انتهای فایل است)
    // همچنین نیاز است که دسترسی نوشتن (writable) به مسیر فایل داشته باشید.
    if (file_put_contents($messages_file, $new_message, FILE_APPEND | LOCK_EX) !== false) {
        // هدایت کاربر به صفحه اصلی چت روم بعد از ارسال موفق
        header("Location: index.php");
        exit;
    } else {
        echo "خطا در ذخیره پیام.";
    }
} else {
    // اگر به صورت مستقیم وارد این صفحه شده، هدایت به صفحه اصلی
    header("Location: index.php");
    exit;
}
?>
