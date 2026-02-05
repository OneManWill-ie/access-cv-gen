<?php
/**
 * CV Generator - Homepage
 * Main entry point for the PHP frontend application
 */

// Get environment variables for API connection
$flask_api_url = getenv('FLASK_API_URL') ?: 'http://localhost:5001';
$app_env = getenv('APP_ENV') ?: 'development';

// Check Flask API health
$api_health = null;
try {
    $context = stream_context_create(['http' => ['timeout' => 2]]);
    $response = @file_get_contents($flask_api_url . '/health', false, $context);
    if ($response) {
        $api_health = json_decode($response, true);
    }
} catch (Exception $e) {
    // API unavailable
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Generator - Home</title>
    
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
            <a class="navbar-brand fw-bold" href="index.php">📄 CV Generator</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="create.php">Create CV</a></li>
                    <li class="nav-item"><a class="nav-link" href="my-cvs.php">My CVs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
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
                        <a href="create.php" class="btn btn-light btn-lg">
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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">🐘 PHP Server</h5>
                                <p class="badge bg-success fs-6">Running</p>
                                <p class="text-muted small mt-2">Frontend application</p>
                            </div>
                        </div>
                    </div>

                    <!-- Flask API Status -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">⚙️ Flask API</h5>
                                <?php if ($api_health && isset($api_health['status'])): ?>
                                    <p class="badge bg-success fs-6"><?php echo ucfirst($api_health['status']); ?></p>
                                <?php else: ?>
                                    <p class="badge bg-danger fs-6">Unavailable</p>
                                <?php endif; ?>
                                <p class="text-muted small mt-2">Backend service</p>
                            </div>
                        </div>
                    </div>

                    <!-- Database Status -->
                    <div class="col-md-4">
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
                <?php 
                    echo "Environment: " . ucfirst($app_env);
                    if ($app_env === 'development') {
                        echo " | API: " . ($api_health ? "Connected ✓" : "Disconnected ✗");
                    }
                ?>
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
