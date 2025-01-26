<?php 
ob_start(); // Memulai output buffering
require "koneksi.php"; // Koneksi ke database
session_start(); // Memulai session

// Menampilkan semua error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek apakah form di-submit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Debugging POST data
    error_log("POST data: " . print_r($_POST, true)); // Debug POST data
    
    // Ambil input email atau username dan password
    $email_or_username = trim($_POST['email']); // Ambil input email atau username
    $password = trim($_POST['password']); // Ambil input password

    // Cek apakah data email atau username dan password ada
    if (empty($email_or_username) || empty($password)) {
        error_log("Email/Username atau password kosong!");
        $error_message = "Email/Username atau password tidak cocok";
    } else {
        // Query untuk mencocokkan email/username dengan password
        $query = "SELECT user_id, username, email, password FROM users WHERE username = ? OR email = ?";
        $stmt = $con->prepare($query);
        
        // Cek apakah query berhasil disiapkan
        if (!$stmt) {
            error_log("Failed to prepare query: " . $con->error);
            die("Failed to prepare query.");
        }

        $stmt->bind_param("ss", $email_or_username, $email_or_username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Debugging hasil query
        error_log("Query executed. Rows found: " . $result->num_rows);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Simpan data ke session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];

                // Debugging session
                error_log("Session started for user: " . $user['username']);

                // Redirect ke halaman dashboard
                error_log("Redirecting to land.php...");
                header("Location: land.php");
                exit();
            } else {
                $error_message = "Password salah!";
                error_log("Incorrect password for user: " . $email_or_username);
            }
        } else {
            $error_message = "Email atau username tidak ditemukan!";
            error_log("No user found with email/username: " . $email_or_username);
        }
    }
} else {
    error_log("No POST data received.");
}

// Menampilkan error jika ada
if (isset($error_message)) {
    echo "<p style='color: red;'>Error: " . $error_message . "</p>";
}
?>
