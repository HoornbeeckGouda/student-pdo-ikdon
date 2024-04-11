<?php
include 'inc/header.php';
?>

<body>
    <h2>Wachtwoord vergeten</h2>
    <form action="send-password-reset.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <div class="g-recaptcha" data-sitekey="6LfITrQpAAAAAGl1E7HgLMPWq8LDtslAogyvSkj6" data-callback="enableBtn" data-expired-callback="disableBtn"></div>
        <input type="submit" id="submitBtn" value="Reset Wachtwoord" disabled>
    </form>

    <script>
        function enableBtn() {
            document.getElementById('submitBtn').disabled = false;
        }

        function disableBtn() {
            document.getElementById('submitBtn').disabled = true;
        }
    </script>
</body>
</html>
