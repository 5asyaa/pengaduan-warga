<?php include __DIR__ . "/../layouts/header.php"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<div class="auth-wrapper register">

    <div class="auth-container">

        <div class="auth-purple-panel left">
            <h2>Welcome Back!</h2>
            <p>Already have an account? Login here.</p>

            <a href="index.php" class="btn-outline">Login</a>
        </div>

        <div class="auth-white-panel slide-right">

            <h2 class="auth-title">Sign Up</h2>

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if (!empty($success)) : ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="register.php">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" required class="form-control">
                </div>

                <button type="submit" name="register" class="btn btn-primary w-100">
                    Sign Up
                </button>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
