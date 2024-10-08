<?php  
include('../shared/path-loader.php');
require __DIR__. "/authenticate.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <link rel="shortcut icon" type="image/png" href="<?php echo $base . '/src/shared/image/adminlogo.png'?>" />  
    <link rel="stylesheet" href="<?php echo $base . '/src/shared/bootstrap/bootstrap.css'?>"> 
    <link rel="stylesheet" href="<?php echo $base . '/src/shared/bootstrap/bootstrap.bundle.min.js'?>"> 
    <link rel="stylesheet" href="<?php echo $base . '/src/shared/css/login.css'?>">
    <link rel="stylesheet" href="<?php echo $base . '/src/shared/css/style.css'?>" />
    <link rel="stylesheet" href="<?php echo $base . '/src/shared/loader/loader.css'?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Login</title> 
</head>

<body class="login-body"> 
   
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="loader-container" id="loader-container">
                            <div class="loader" id="loader"></div>
                        </div>
                        <div class="card mb-0" id="card-container">
                            <div class="card-body login-card">
                                <a href="#" class="login-container text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src= " <?php echo $base . '/src/shared/image/adminlogo.png'?>" alt="" style="width:5rem;">
                                </a>
                                <?php if($is_invalid): ?>
                                <p>
                                <div class="alert alert-danger text-center p-2" role="alert">Invalid Credential </div>
                                </p>
                                <?php endif; ?>
                                <form method="POST">
                                    <div class="mb-3">

                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="<?= htmlspecialchars($_POST["email"] ?? "" )?>">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control " id="password" name="password"">
                                </div>
                    
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 btn-login mt-3">Sign
                                        In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="text-primary fw-bold ms-2" href="./signup">Forgot Password </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $base . '/src/shared/loader/loader.js'?>"></script>
</body>

</html>