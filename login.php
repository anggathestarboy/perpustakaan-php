<?php
session_start();
require_once "koneksi.php";

$loginError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $koneksi->real_escape_string($_POST['username']);
    $password = $koneksi->real_escape_string($_POST['password']);
    
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password' LIMIT 1";
    $result = $koneksi->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $loginError = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin - Perpustakaan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />

    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #B0BEC5;
            background-repeat: no-repeat;
        }
        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 0px;
        }
        .card2 {
            margin: 0px 40px;
        }
        .image {
            width: 360px;
            height: 280px;
        }
        .border-line {
            border-right: 1px solid #EEEEEE;
        }
        .line {
            height: 1px;
            width: 45%;
            background-color: #E0E0E0;
            margin-top: 10px;
        }
        .text-sm {
            font-size: 14px !important;
        }
        ::placeholder {
            color: #BDBDBD;
            opacity: 1;
            font-weight: 300;
        }
        input, textarea {
            padding: 10px 12px 10px 12px;
            border: 1px solid lightgrey;
            border-radius: 2px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            font-size: 14px;
            letter-spacing: 1px;
        }
        input:focus, textarea:focus {
            box-shadow: none !important;
            border: 1px solid #304FFE;
            outline-width: 0;
        }
        button:focus {
            box-shadow: none !important;
            outline-width: 0;
        }
        a {
            color: inherit;
            cursor: pointer;
        }
        .btn-blue {
            background-color: #1A237E;
            width: 150px;
            color: #fff;
            border-radius: 2px;
        }
        .btn-blue:hover {
            background-color: #000;
            cursor: pointer;
        }
        .bg-blue {
            color: #fff;
            background-color: #1A237E;
        }
        @media screen and (max-width: 991px) {
            .image {
                width: 300px;
                height: 220px;
            }
            .border-line {
                border-right: none;
            }
            .card2 {
                border-top: 1px solid #EEEEEE !important;
                margin: 0px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/013/083/736/small_2x/stick-man-with-book-shelves-in-library-education-and-learning-concept-3d-illustration-or-3d-rendering-png.png" class="image" alt="Library Image" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <h3 class="mb-0 mr-4 mt-2 font-weight-bold">Login Admin</h3>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <form method="POST" action="">
                            <div class="row px-3">
                                <label class="mb-1"><h6 class="mb-0 text-sm">Username</h6></label>
                                <input class="mb-4" type="text" name="username" placeholder="Enter username" required />
                            </div>
                            <div class="row px-3">
                                <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                                <input type="password" name="password" placeholder="Enter password" required />
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input id="chk1" type="checkbox" name="chk" class="custom-control-input" />
                                    <label for="chk1" class="custom-control-label text-sm">Remember me</label>
                                </div>
                                <a href="#" id="forgot-password" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-blue text-center">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3">
                    <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Jika login error, munculkan popup SweetAlert2
        <?php if($loginError): ?>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: 'Username atau password salah!',
            confirmButtonColor: '#1A237E',
        });
        <?php endif; ?>

        // Popup saat klik "Forgot Password?"
        document.getElementById('forgot-password').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Lupa Password?',
                text: 'Silahkan hubungi admin untuk reset password.',
                confirmButtonColor: '#1A237E',
            });
        });
    </script>
</body>
</html>
