<?php
session_start();

$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += (isset($item['p_qty']) ? $item['p_qty'] : 0);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Gems | Home</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .home-layout {
            display: flex;
            flex-direction: column; 
            align-items: center;    
            text-align: center;     
            padding: 50px 20px;
            background-color: #fafafa; 
        }

        .home-image img {
            max-width: 85%;         
            height: auto;
            border-radius: 60px;    
            box-shadow: 0 20px 40px rgba(0,0,0,0.08); 
            margin-bottom: 40px;   
        }

        .home-text h2 {
            font-size: 2.8rem;
            color: #1a1a1a;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif; 
        }

        .home-text p {
            font-size: 1.25rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        .promise-list {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 40px;
        }

        .promise-list li {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
        }

        .shop-btn {
            display: inline-block;
            padding: 15px 40px;
            background-color: #d4af37; 
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .shop-btn:hover {
            transform: scale(1.05); 
            background-color: #c4a02e;
        }
    </style>
</head>
<body>

    <header>
        <h1>Elegant Gems</h1>
        <nav>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="product.html">Collection</a></li>
        <li><a href="contact.html">Contact Us</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="admin.html">Dashboard</a></li>
        
    </ul>
</nav>
    </header>

    <main class="home-layout">
        <div class="home-image">
            <img src="images/home.jpg" alt="Luxury Jewelry Banner">
        </div>

        <div class="home-text">
            <h2>Elevate Your Style</h2>
            <p>Experience the pinnacle of craftsmanship with our exclusive jewelry collection. Every piece tells a story of elegance and brilliance.</p>
            <ul class="promise-list">
    <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="promise-icon"><path d="M6 3h12l4 6-10 13L2 9z"></path><path d="M11 3 8 9l4 13 4-13-3-6"></path><path d="M2 9h20"></path></svg>
        <span>Premium Gold</span>
    </li>
    <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="promise-icon"><path d="m21 7-9-4-9 4V17l9 4 9-4V7z"></path><path d="m12 21 8-4.5V10.5L12 15l-8-4.5V16.5l8 4.5Z"></path><path d="m12 15 9-5.1"></path><path d="m12 15-9-5.1"></path><path d="m12 3v12"></path></svg>
        <span>Natural Stones</span>
    </li>
    <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="promise-icon"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
        <span>Global Delivery</span>
    </li>
</ul>

            <a href="product.php" class="shop-btn">Explore Collection</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Elegant Gems. Crafted for Excellence.</p>
    </footer>

</body>
</html>
