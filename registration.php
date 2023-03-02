<!DOCTYPE html>
<html lang="en">

<?php include("./components/_head.php") ?>

<body>
    <div class="registration-header">
        <nav id="navBar">
            <a href="./index.php" class="logo"> triptrip </a>
            <ul class="nav-links">
                <li><a href="./index.php">Popular Places</a></li>
                <li><a href="./listing.php">All packages</a></li>
            </ul>
            <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
        </nav>
        <div class="registration">
            <div class="from-box">
                <h1 id="title">Sign Up</h1>
                <div class="notification">
                    
                </div>
                <form>
                    <div class="input-group">
                        <div class="input-field" id="nameField">
                            <i class="fa-solid fa-user"></i>
                            <input required type="text" placeholder="Username" name="username" id="username">
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input required type="email" placeholder="Email" name="email" id="email" >
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input required type="password" placeholder="Password" name="password" id="password" >
                            <i class="fa-solid fa-eye show_password"></i>
                        </div>
                        <p>Forgot password <a href="#">Click Here!</a></p>
                    </div>
                    <div class="btn-field">
                        <button type="button" id="signupBtn">Sign up</button>
                        <button type="button" id="signinBtn" class="disable">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================footer====================== -->
    <div class="container">
        <div class="about-msg">
            <h2>About <span class="brand">triptrip</span></h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae eius cumque, provident quaerat aspernatur
                architecto totam ea corrupti esse repudiandae omnis asperiores voluptas! Error libero nisi adipisci rem,
                molestiae et iste exercitationem asperiores esse eum facere ipsa voluptatem odit omnis iusto dolor atque
                non eos maiores. Libero dolor fuga possimus.</p>
        </div>
        <div class="footer">
            <a href="https://www.facebook.com/akibul.hasan.13"><i class="fa-brands fa-facebook-f"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-linkedin"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <hr>
            <p>&copy; All rights reserved.</p>
        </div>
    </div>

    <?php include("./components/_js.php") ?>
    <script src="./assets/js/registration.js"></script>
</body>

</html>