<?php
session_start();
// 1. تصحيح اسم الملف إلى connect.php
include 'db.php'; 

$order_success = false;
$error_msg = "";

if (isset($_POST['submit_order']) && !empty($_SESSION['cart'])) {
    // تأمين المدخلات
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);

    // نستخدم "Transaction" لضمان تخزين كل المنتجات معاً
    $conn->begin_transaction();

    try {
        foreach ($_SESSION['cart'] as $item) {
            $product = $conn->real_escape_string($item['name']);
            $qty = (int)$item['qty'];
            
            // 2. التأكد من كتابة جملة SQL بشكل صحيح
            $sql = "INSERT INTO orders (name, email, product, quantity, address) 
                    VALUES ('$name', '$email', '$product', $qty, '$address')";
            
            if (!$conn->query($sql)) {
                throw new Exception($conn->error);
            }
        }
        
        $conn->commit();
        $order_success = true;
        unset($_SESSION['cart']); // تفريغ السلة فقط عند النجاح
    } catch (Exception $e) {
        $conn->rollback();
        $error_msg = "حدث خطأ أثناء معالجة الطلب: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Status - Elegant Gems</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header>
    <h1>Elegant Gems</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="product.php">Collection</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="admin.php">Dashboard</a></li>
        </ul>
    </nav>
</header>

<main style="text-align: center; padding: 60px 20px;">
    <?php if ($order_success): ?>
    <div style="max-width: 600px; margin: 40px auto; background: #fffdf5; border: 2px solid #D4AF37; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); text-align: center;">
        
        <div style="font-size: 4.5rem; color: #D4AF37; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <h2 style="color: #043927; font-size: 2.2em; font-family: 'Playfair Display', serif; margin-bottom: 15px;">Order Placed Successfully!</h2>
        
        <p style="font-size: 1.15em; color: #4a5568; line-height: 1.8; margin-bottom: 25px;">
            Thank you, <span style="color: #cd7f32; font-weight: bold;"><?php echo htmlspecialchars($name); ?></span>. <br>
            Your elegant choice is being prepared with care. We have received your order and will contact you soon.
        </p>

        <div style="width: 60px; height: 2px; background: #D4AF37; margin: 20px auto;"></div>

        <a href="index.html" style="display: inline-block; background: #043927; color: #fffdf5; padding: 15px 35px; text-decoration: none; border-radius: 8px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; border: 1px solid #043927;">
            Continue Shopping
        </a>
    </div>

<?php elseif (!empty($error_msg)): ?>
    <div style="max-width: 600px; margin: 40px auto; background: #fffcfc; border: 2px solid #cd7f32; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center;">
        
        <div style="font-size: 4.5rem; color: #cd7f32; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <h2 style="color: #043927; font-size: 2em; font-family: 'Playfair Display', serif; margin-bottom: 15px;">Order Not Processed</h2>
        
        <p style="color: #718096; font-size: 1.1em; line-height: 1.6; margin-bottom: 25px;">
            <?php echo $error_msg; ?>
        </p>

        <a href="cart.php" style="display: inline-block; background: transparent; color: #cd7f32; padding: 12px 30px; text-decoration: none; border: 2px solid #cd7f32; border-radius: 8px; font-weight: bold; transition: 0.3s;">
             <i class="fa-solid fa-arrow-left"></i> Return to Cart
        </a>
    </div>
<?php endif; ?>
</main>

<footer>
    <p>&copy; 2026 Elegant Gems Luxury Store. All rights reserved.</p>
</footer>

</body>
</html>
