<?php include __DIR__ . "/../layouts/header.php"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<div class="auth-wrapper login">

    <div class="auth-container">

        <div class="auth-white-panel slide-left">
            <h2 class="auth-title">Login</h2>

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" required class="form-control">
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100">
                    Login
                </button>
            </form>
        </div>

        <div class="auth-purple-panel right">
            <h2>Hello, Friend!</h2>
            <p>Create an account to explore all features.</p>

            <a href="register.php" class="btn-outline">Sign Up</a>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
