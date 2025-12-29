<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - CodeIgniter 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        body {
            background: linear-gradient(135deg, #6b7280, #3b82f6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-primary {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            border: none;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #1d4ed8, #3b82f6);
        }

        .form-control {
            border-radius: 0.5rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }

        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-label {
            font-weight: 500;
            color: #1f2937;
        }

        h2 {
            font-weight: 700;
            color: #1f2937;
            letter-spacing: 0.025em;
        }

        a {
            color: #3b82f6;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #1d4ed8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card p-4">
                    <h2 class="card-title text-center mb-4">Welcome Back</h2>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form id="login_form" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="Enter your email" />
                            <div id="emailError" class="error d-none">Please enter a valid email address</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="Enter your password" />
                            <div id="passwordError" class="error d-none">Password must be at least 6 characters</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none">Forgot password?</a>
                        </div>

                        <div id="output_msg" class="mb-3"></div>

                        <button type="submit" class="btn btn-primary w-100">Sign In</button>
                    </form>
                    <p class="text-center mt-3 mb-0">
                        Don't have an account? <a href="<?= base_url('signup') ?>" class="text-decoration-none">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery needed for $.ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('login_form').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const outputMsg = document.getElementById('output_msg');

            // Reset error messages
            emailError.classList.add('d-none');
            passwordError.classList.add('d-none');
            outputMsg.innerHTML = '';

            // Client-side validation
            let isValid = true;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value.trim())) {
                emailError.classList.remove('d-none');
                isValid = false;
            }
            if (password.value.trim().length < 6) {
                passwordError.classList.remove('d-none');
                isValid = false;
            }

            if (isValid) {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('login_action') ?>",
                    contentType: "application/json",
                    data: JSON.stringify({
                        email: email.value.trim(),
                        password: password.value.trim(),
                        remember: document.getElementById('remember').checked ? 1 : 0,
                    }),
                    success: function(res) {
                        let response;
                        try {
                            response = typeof res === 'string' ? JSON.parse(res) : res;
                        } catch (e) {
                            outputMsg.innerHTML = `<div class="alert alert-danger" role="alert">Invalid server response.</div>`;
                            return;
                        }
                        const body = `<div class="alert alert-${response.color}" role="alert">${response.msg}</div>`;
                        outputMsg.innerHTML = body;
                        if (response.status === true) {
                            setTimeout(() => {
                                window.location.href = '<?= base_url("/dashboard") ?>';
                            }, 1000);
                        }
                    },
                    error: function() {
                        outputMsg.innerHTML = `<div class="alert alert-danger" role="alert">An error occurred. Please try again.</div>`;
                    }
                });
            }
        });
    </script>
</body>

</html>