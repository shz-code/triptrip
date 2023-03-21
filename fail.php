<html>
<title>Purchase Failed</title>

<body>
    <h1>Your purchase could not be completed.</h1>
    <p>Redirecting to dashboard in <span class="counter"></span></p>

    <script>
        let countDown = 5;
        setInterval(() => {
            countDown--;
            document.querySelector(".counter").innerHTML = countDown;
        }, 1000)
        setTimeout(() => {
            location.href = "./auth/user_dashboard.php";
        }, 5000);
    </script>
</body>

</html>