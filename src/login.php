<?php require "koneksi.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kazumi Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-SideLightBlue font-sans">
    <header class="bg-blue-500 text-orange-500 text-center flex items-center justify-center h-[100px] text-[40px] font-bold shadow-md">
        WELCOME TO
    </header>

    <main class="bg-white flex flex-wrap md:flex-nowrap">
        <div class="bg-[url('../Assets/BannerKazumi.png')] bg-cover bg-center w-full md:w-[70%] flex items-center justify-center h-[300px] md:h-auto">
        </div>

        <div class="bg-blue-50 w-full md:w-[30%] flex flex-col items-center justify-center p-6">
            <h2 class="text-2xl font-semibold text-blue-900 mb-4">Login</h2>
            <form class="w-full max-w-xs">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email or Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Enter your email">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="********">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" name="loginbtn">
                        Login
                    </button>
                </div>
                <div class="mt-4 text-center">
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                        Forgot password?
                    </a>
                </div>
                <div class="mt-2 text-center">
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                        Don't have an account yet? Sign Up
                    </a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php require "footer.php"; ?>
</body>
</html>