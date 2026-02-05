<?php
/**
 * CV Generator - Main Application
 * Single entry point with routing logic
 */

// Get environment variables
$app_env = getenv('APP_ENV') ?: 'development';

// Simple routing system
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
$allowed_pages = ['home', 'create', 'my-cvs'];

// Default to home if invalid page
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// Helper function to check if current page is active
function is_active_page($page_name) {
    global $page;
    return $page === $page_name ? 'active' : '';
}

// Helper function to get page URL
function get_page_url($page_name) {
    return '?page=' . $page_name;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Generator - <?php echo ucfirst($page === 'my-cvs' ? 'My CVs' : $page); ?></title>
    
    <!-- Bootstrap 5 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?php echo get_page_url('home'); ?>">📄 CV Generator</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?php echo is_active_page('home'); ?>" href="<?php echo get_page_url('home'); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo is_active_page('create'); ?>" href="<?php echo get_page_url('create'); ?>">Create CV</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo is_active_page('my-cvs'); ?>" href="<?php echo get_page_url('my-cvs'); ?>">My CVs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php if ($page === 'home'): ?>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold mb-3">Create Your Professional CV</h1>
                        <p class="lead mb-4">
                            Generate beautiful, AI-enhanced CVs with the power of Gemini. 
                            Highlight your skills, experience, and education effortlessly.
                        </p>
                        <a href="<?php echo get_page_url('create'); ?>" class="btn btn-light btn-lg">
                            Get Started →
                        </a>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="display-1">📋</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Status Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="mb-4 text-center">System Status</h2>
                <div class="row g-3">
                    <!-- PHP Status -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">🐘 PHP Server</h5>
                                <p class="badge bg-success fs-6">Running</p>
                                <p class="text-muted small mt-2">Frontend application</p>
                            </div>
                        </div>
                    </div>

                    <!-- Database Status -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">🗄️ Database</h5>
                                <p class="badge bg-info fs-6">Configured</p>
                                <p class="text-muted small mt-2">MySQL database</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="mb-5 text-center">Features</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="fs-3">✨</div>
                            <div>
                                <h5>AI-Powered Generation</h5>
                                <p class="text-muted">Leverage Gemini API to create compelling CV content tailored to your profile.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="fs-3">📱</div>
                            <div>
                                <h5>Responsive Design</h5>
                                <p class="text-muted">Beautiful, responsive layouts that look great on any device or screen size.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="fs-3">💾</div>
                            <div>
                                <h5>Data Persistence</h5>
                                <p class="text-muted">All your CVs are safely stored in our secure MySQL database.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="fs-3">🚀</div>
                            <div>
                                <h5>Quick & Easy</h5>
                                <p class="text-muted">Create professional CVs in minutes with our intuitive interface.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-2">&copy; 2026 CV Generator. All rights reserved.</p>
            <p class="text-muted small">
                Environment: <?php echo ucfirst($app_env); ?> | Current Page: <?php echo ucfirst($page); ?>
            </p>
        </div>

        <?php elseif ($page === 'create'): ?>

        <!-- Create CV Page -->
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h1 class="mb-4">Create a New CV</h1>
                        
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" placeholder="John Doe">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="john@example.com">
                                    </div>

                                    <div class="mb-3">
                                        <label for="summary" class="form-label">Professional Summary</label>
                                        <textarea class="form-control" id="summary" rows="4" placeholder="Tell us about yourself..."></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create CV</button>
                                    <a href="<?php echo get_page_url('home'); ?>" class="btn btn-secondary">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php elseif ($page === 'my-cvs'): ?>

        <!-- My CVs Page -->
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="mb-4">My CVs</h1>
                        
                        <div class="alert alert-info" role="alert">
                            <strong>No CVs yet.</strong> <a href="<?php echo get_page_url('create'); ?>" class="alert-link">Create your first CV</a>
                        </div>

                        <a href="<?php echo get_page_url('create'); ?>" class="btn btn-primary">Create New CV</a>
                    </div>
                </div>
            </div>
        </section>

        <?php endif; ?>

    <!-- Bootstrap 5 JS Bundle from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
