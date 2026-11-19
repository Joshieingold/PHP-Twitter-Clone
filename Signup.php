<?php
// Used for showing the errors.
session_start();
$error = $_SESSION["flash_error"] ?? "";
unset($_SESSION["flash_error"]);

// Handle redirects
if (isset($_SESSION["SESS_MEMBER_ID"])) {
    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Signup for Y - the parody social network" />
    <title>Sign Up - Y</title>
    <link href="includes/y.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="favicon.ico" type="image">


</head>

<body class="signup">

    <?php if ($error !== ""): ?>
        <span class="error-wrapper"><?= htmlspecialchars($error) ?></span>
    <?php endif; ?>
    <div class="signup-card">
        <h1>Create Your <img alt="Y Logo" src="img/y_logo.png" class="loginlogo"> * Account</h1>
        <form action="proc/Signup_proc.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" required />
                </div>
            </div>

            <label for="screenName">Screen Name</label>
            <input type="text" id="screenName" name="screenName" class="form-control" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required />
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" required />

            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" />

            <div class="row">
                <div class="col-md-4">
                    <label for="province">Province</label>
                    <input type="text" id="province" name="province" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="postalCode">Postal Code</label>
                    <input type="text" id="postalCode" name="postalCode" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" class="form-control" />
                </div>
            </div>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" class="form-control" />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required />

            <div class="text-center mt-4">
                <button type="submit" class="btn-signup">Sign Up</button>
                <p>* - backed by absolutely no billionaires.</p>

            </div>
        </form>
    </div>

</body>

</html>
<script>
    let valid = true;

    function showError(input, message) {
        const error = document.createElement('div');
        error.className = 'error-message text-danger';
        error.style.fontSize = '0.875em';
        error.textContent = message;
        input.classList.add('is-invalid');
        input.insertAdjacentElement('afterend', error);
        valid = false;
    }
    document.querySelector('form').addEventListener('submit', function(e) {
        valid = true;
        const form = e.target;

        // Clear previous errors
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());

        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
        });

        const firstName = form.firstName;
        const lastName = form.lastName;
        const screenName = form.screenName;
        const password = form.password;
        const confirmPassword = form.confirmpassword;
        const email = form.email;
        const phone = form.phone;
        const postalCode = form.postalCode;

        if (!firstName.value.trim()) showError(firstName, 'First name is required.');
        if (!lastName.value.trim()) showError(lastName, 'Last name is required.');
        if (!screenName.value.trim()) showError(screenName, 'Screen name is required.');
        if (!password.value) showError(password, 'Password is required.');
        if (!confirmPassword.value) showError(confirmPassword, 'Please confirm your password.');
        if (password.value && confirmPassword.value && password.value !== confirmPassword.value) {
            showError(confirmPassword, 'Passwords do not match.');
        }

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim()) {
            showError(email, 'Email is required.');
        } else if (!emailPattern.test(email.value.trim())) {
            showError(email, 'Enter a valid email address.');
        }

        // phone check
        if (phone.value.trim() && !/^\+?\d{7,15}$/.test(phone.value.trim())) {
            showError(phone, 'Enter a valid phone number.');
        }

        // basic postal code check - should work for US & Canada
        if (postalCode.value.trim() && !/^[A-Za-z0-9\s\-]{3,10}$/.test(postalCode.value.trim())) {
            showError(postalCode, 'Enter a valid postal code.');
        }

        if (!valid) {
            e.preventDefault();
        }
    });
</script>
