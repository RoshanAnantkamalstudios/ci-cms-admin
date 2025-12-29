<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brahma Valley - Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
        }

        .form-container h2 {
            color: #333;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .btn-custom {
            background-color: #6e8efb;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #5a78d3;
        }

        .form-control:focus {
            border-color: #6e8efb;
            box-shadow: 0 0 0 0.25rem rgba(110, 142, 251, 0.25);
        }

        .alert {
            display: none;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Sign Up</h2>
        <div class="alert alert-danger" id="error-message" role="alert"></div>
        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your first name" required>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your last name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="button" class="btn btn-custom w-100" onclick="validateForm()">Register</button>
    </div>
    <script>
        function validateForm() {
            const fname = document.getElementById('fname').value.trim();
            const lname = document.getElementById('lname').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('error-message');

            errorMessage.style.display = 'none';
            errorMessage.innerHTML = '';

            if (!fname || !lname || !email || !password) {
                errorMessage.textContent = 'All fields are required.';
                errorMessage.style.display = 'block';
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                errorMessage.textContent = 'Please enter a valid email address.';
                errorMessage.style.display = 'block';
                return;
            }

            if (password.length < 6) {
                errorMessage.textContent = 'Password must be at least 6 characters long.';
                errorMessage.style.display = 'block';
                return;
            }

            // AJAX Submit to CI4 controller
            fetch("<?= base_url('register') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        fname: fname,
                        lname: lname,
                        email: email,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status) {
                        alert(result.message);
                         window.location.href = '<?= base_url('login') ?>';
                        // window.location.reload();
                    } else {
                        let errorText = '';
                        for (const key in result.errors) {
                            errorText += result.errors[key] + '<br>';
                        }
                        errorMessage.innerHTML = errorText;
                        errorMessage.style.display = 'block';
                    }
                })
                .catch(error => {
                    errorMessage.textContent = 'Something went wrong. Please try again.';
                    errorMessage.style.display = 'block';
                    console.error('Error:', error);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>