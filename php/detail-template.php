<?php
require __DIR__ . '/detail-content.php';

$pages = $pageType === 'service' ? $servicePages : $projectPages;
$page = $pages[$pageSlug] ?? null;

if (!$page) {
    http_response_code(404);
    $page = [
        'title' => 'Page not found',
        'eyebrow' => 'Leeroy Systems',
        'summary' => 'The page you requested could not be found.',
        'hero' => 'assets/img/hero-smart-metering.jpg',
        'intro' => 'Return to the homepage to continue browsing Leeroy Systems services and project cases.',
        'points' => [],
        'outcome' => '',
    ];
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($page['summary']); ?>">
    <title><?php echo e($page['title']); ?> | Leeroy Systems</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="site-header" data-header>
        <a class="skip-link" href="#main">Skip to content</a>
        <div class="container header-inner">
            <a class="brand" href="index.php#home" aria-label="Leeroy Systems home">
                <img src="assets/img/LEEROY SYSTEMS SPWMS LOGO2.png" alt="Leeroy Systems SPWM Solutions">
            </a>
            <nav class="site-nav" aria-label="Primary navigation">
                <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul id="site-menu">
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#about">About Us</a></li>
                    <li class="nav-dropdown">
                        <a href="index.php#services">Services</a>
                        <ul class="dropdown-menu" aria-label="Service pages">
                            <?php foreach ($servicePages as $service): ?>
                                <li><a href="<?php echo e($service['url']); ?>"><?php echo e($service['title']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-dropdown">
                        <a href="index.php#projects">Projects</a>
                        <ul class="dropdown-menu" aria-label="Project pages">
                            <?php foreach ($projectPages as $project): ?>
                                <li><a href="<?php echo e($project['url']); ?>"><?php echo e($project['title']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="community.php">Community</a></li>
                    <li><a href="careers.php">Careers</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main">
        <section class="detail-hero">
                <?php if (!empty($page['hero_video'])): ?>
                    <video autoplay muted loop playsinline
                        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                        <source src="<?php echo e($page['hero_video']); ?>" type="video/mp4">
                    </video>
                <?php else: ?>
                    <img src="<?php echo e($page['hero']); ?>" alt="<?php echo e($page['title']); ?>">
                <?php endif; ?>
                <span class="detail-hero-overlay"></span>
                <div class="container detail-hero-content">
                    <p class="eyebrow"><?php echo e($page['eyebrow']); ?></p>
                    <h1><?php echo e($page['title']); ?></h1>
                    <p><?php echo e($page['summary']); ?></p>
                </div>
        </section>

        <section class="section detail-section">
            <div class="container detail-layout">
                <article class="detail-main">
                    <p class="eyebrow">Overview</p>
                    <h2>What this <?php echo $pageType === 'service' ? 'service delivers' : 'project delivered'; ?>.</h2>
                    <p><?php echo e($page['intro']); ?></p>

                    <?php if (!empty($page['points'])): ?>
                        <div class="detail-points">
                            <?php foreach ($page['points'] as $point): ?>
                                <div>
                                    <span></span>
                                    <p><?php echo e($point); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($page['outcome'])): ?>
                        <div class="detail-outcome">
                            <strong>Outcome</strong>
                            <p><?php echo e($page['outcome']); ?></p>
                        </div>
                    <?php endif; ?>
                </article>

                <aside class="detail-side">
                    <?php if (!empty($page['images'])): ?>
                        <div class="detail-image-stack">
                            <?php foreach ($page['images'] as $image): ?>
                                <img src="<?php echo e($image); ?>" alt="<?php echo e($page['title']); ?>">
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="detail-service-panel">
                            <strong>Ready for a scoped discussion?</strong>
                            <p>Talk to Leeroy Systems about how this service can support your water metering programme.</p>
                        </div>
                    <?php endif; ?>
                    <a class="detail-cta" href="index.php#contact">Contact Leeroy Systems</a>
                </aside>
            </div>
        </section>
    </main>

    <footer class="site-footer detail-footer">
        <div class="container footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> | Hitong Holdings (Pty) Ltd T/A Leeroy Systems</p>
            <p><a href="index.php#<?php echo $pageType === 'service' ? 'services' : 'projects'; ?>">Back to <?php echo $pageType === 'service' ? 'Services' : 'Projects'; ?></a></p>
        </div>
    </footer>

    <script src="assets/js/main.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/main.js'); ?>"></script>
</body>
</html>
