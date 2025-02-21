<?php
    session_start();
    require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kazumi Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../tailwind.css">
</head>

<body class=" font-sans">
    <header class="bg-[#004AAD] text-[#FD5F00] text-center flex items-center justify-center h-[100px] text-[40px] font-bold shadow-md">
        WELCOME TO
    </header>

    <main class="bg-[#091057] flex flex-wrap md:flex-nowrap">
        <div class="bg-[url('../Assets/BannerKazumi.png')] bg-cover bg-center w-full md:w-[70%] flex items-center justify-center h-[300px] md:h-auto">
        </div>

        <div class="bg-[#091057] w-full md:w-[30%] flex flex-col items-center justify-center p-6">
            <img src='../assets/Frame6.png' alt='Foto Produk' class='mx-auto mt-4'>
            <h2 class="text-2xl mt-3 font-bold text-white mb-4">Login</h2>
            <form method="POST" action="syslogin.php" class="w-full max-w-xs">
                <div class="mb-4">
                    <label class="block text-white text-sm font-bold mb-2" for="email">
                        Email or Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="email" name="email" type="text" placeholder="Enter your email">
                </div>
                <div class="mb-6">
                    <label class="block text-white text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
                    id="password" name="password" type="password" placeholder="********">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-orange-500 hover:bg-orange-700 mb-10 text-white font-bold py-2 px-4 w-full rounded-lg focus:outline-none focus:shadow-outline" 
                    type="submit" name="loginbtn">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php require "footer.php"; ?>
</body>
</html>