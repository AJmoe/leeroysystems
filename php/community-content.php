<?php

$impactStats = [
    ['value' => '2', 'label' => 'Marathons participated'],
    ['value' => '1', 'label' => 'Orphanage painted'],
    ['value' => '4', 'label' => 'Community events'],
    ['value' => '80+', 'label' => 'Staff involved'],
];

$outreach = [
    [
        'title' => 'Gaborone Marathon',
        'summary' => 'Leeroy Systems took part in the Gaborone Marathon, representing the company and showing commitment to an active and connected community.',
        'image' => 'assets/img/ab-us1.jpg',
        'category' => 'Outreach',
    ],
    [
        'title' => 'Francistown Marathon',
        'summary' => 'Our northern branch team participated in the Francistown Marathon, bringing the Leeroy spirit to the second city.',
        'image' => 'assets/img/ft_car.jpeg',
        'category' => 'Outreach',
    ],
    [
        'title' => 'Orphanage Painting',
        'summary' => 'Staff volunteered their time and effort to repaint a local orphanage, giving back to the community in a hands-on and meaningful way.',
        'image' => 'assets/img/about.jpg',
        'category' => 'Outreach',
    ],
    [
        'title' => 'Community Aerobics Morning',
        'summary' => 'Leeroy Systems hosted a community exercise morning, bringing people together for an energetic aerobics session to promote health and wellness.',
        'image' => 'assets/img/pearlleeroy.jpg',
        'category' => 'Outreach',
    ],
];

$inhouse = [
    [
        'title' => 'Christmas Party',
        'summary' => 'An annual celebration bringing the entire Leeroy Systems team together to reflect on the year, recognise achievements and enjoy the festive season.',
        'image' => 'assets/img/ab-us.jpg',
        'icon' => 'star',
    ],
    [
        'title' => 'Spring Day',
        'summary' => 'A team outdoor day celebrating the season, giving staff a chance to relax, connect and recharge together outside the office.',
        'image' => 'assets/img/abu.jpg',
        'icon' => 'sun',
    ],
    [
        'title' => 'Morning Aerobics',
        'summary' => 'Staff start select mornings with a group aerobics session, promoting physical wellness, team energy and a healthy work culture.',
        'image' => 'assets/img/about-operations.jpg',
        'icon' => 'activity',
    ],
];

$gallery = [
    'assets/img/ab-us1.jpg',
    'assets/img/pearlleeroy.jpg',
    'assets/img/ab-us.jpg',
    'assets/img/abu.jpg',
    'assets/img/about.jpg',
    'assets/img/about-operations.jpg',
    'assets/img/leeroy_car.jpg',
    'assets/img/ft_car.jpeg',
];


$focusAreas = [
    [
        'key' => 'inhouse',
        'title' => 'Life at Leeroy',
        'tagline' => 'The culture, the people, the moments that make us who we are.',
        'image' => 'assets/img/ab-us.jpg',
        'items' => array_map(function ($item) use ($gallery) {
            return [
                'title' => $item['title'],
                'image' => $item['image'],
                'summary' => $item['summary'],
                'photos' => array_slice($gallery, 0, 6),
            ];
        }, $inhouse),
    ],
    [
        'key' => 'outreach',
        'title' => 'Beyond the Office',
        'tagline' => 'How we show up for the communities we serve, off the clock.',
        'image' => 'assets/img/ab-us1.jpg',
        'items' => array_map(function ($item) use ($gallery) {
            return [
                'title' => $item['title'],
                'image' => $item['image'],
                'summary' => $item['summary'],
                'photos' => array_slice($gallery, 2, 6),
            ];
        }, $outreach),
    ],
];


function e(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

function renderIcon(string $name): string {
    $icons = [
        'star'        => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
        'sun'         => '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>',
        'activity'    => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>',
        'users'       => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/>',
        'heart'       => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
        'arrow-left'  => '<path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>',
        'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'mail'        => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'check'       => '<path d="m20 6-11 11-5-5"/>',
        'image'       => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>',
    ];
    $paths = $icons[$name] ?? $icons['check'];
    return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths . '</svg>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Leeroy Systems community outreach, in-house programmes and media. Giving back to Botswana through sport, volunteering and team culture.">
    <title>Community | Leeroy Systems</title>
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
                <img src="assets/img/LEEROY SYSTEMS SPWMS LOGO2.png" alt="Leeroy Systems">
            </a>
            <nav class="site-nav" aria-label="Primary navigation">
                <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-menu">
                    <span></span><span></span><span></span>
                </button>
                <ul id="site-menu">
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#about">About Us</a></li>
                    <li class="nav-dropdown">
                        <a href="index.php#services">Services</a>
                        <ul class="dropdown-menu" aria-label="Service pages">
                            <li><a href="service-meters-as-a-service.php">Meters as a Service</a></li>
                            <li><a href="service-data-as-a-service.php">Data as a Service</a></li>
                            <li><a href="service-network-as-a-service.php">Network as a Service</a></li>
                            <li><a href="service-sales-as-a-service.php">Sales as a Service</a></li>
                        </ul>
                    </li>
                    <li class="nav-dropdown">
                        <a href="index.php#projects">Projects</a>
                        <ul class="dropdown-menu" aria-label="Project pages">
                            <li><a href="project-city-of-francistown-council.php">City of Francistown Council</a></li>
                            <li><a href="project-palapye-district-council.php">Palapye District Council</a></li>
                            <li><a href="project-debswana-jwaneng.php">Debswana Jwaneng</a></li>
                            <li><a href="project-water-utilities-corporation-phase-1.php">Water Utilities Corporation Phase 1</a></li>
                        </ul>
                    </li>
                    <li><a href="community.php" class="active">Community</a></li>
                    <li><a href="careers.php">Careers</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main">

  <!-- HERO SLIDESHOW -->
<section class="hero community-hero" id="home">
    <div class="hero-slider" data-hero-slider>
        <?php foreach ($gallery as $index => $img): if ($index > 2) break; ?>
            <article class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" data-slide>
                <span class="hero-slide-link">
                    <img src="<?php echo e($img); ?>" alt="Leeroy Systems community">
                    <span class="hero-overlay"></span>
                    <span class="container hero-slide-content">
                        <span class="eyebrow">Community & Impact</span>
                        <strong>Giving back to the communities we serve.</strong>
                        <span>Beyond smart metering, we're committed to uplifting communities across Botswana.</span>
                    </span>
                </span>
            </article>
        <?php endforeach; ?>
        <div class="hero-controls container" aria-label="Hero slideshow controls">
            <?php foreach ($gallery as $index => $img): if ($index > 2) break; ?>
                <button type="button" class="<?php echo $index === 0 ? 'active' : ''; ?>" data-slide-control="<?php echo $index; ?>">
                    <span>Slide <?php echo $index + 1; ?></span>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- IMPACT STATS (unchanged) -->
<section class="trust-band" aria-label="Community highlights">
    <div class="container stats-grid">
        <?php foreach ($impactStats as $stat): ?>
            <div class="stat">
                <strong><?php echo e($stat['value']); ?></strong>
                <span><?php echo e($stat['label']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- TWO FOCUS CARDS -->
<section class="section" id="focus">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Our world</p>
            <h2>Two sides of the same purpose.</h2>
        </div>

        <?php foreach ($focusAreas as $area): ?>
            <div class="focus-card reveal" style="background-image: linear-gradient(135deg, rgba(34,50,88,.92), rgba(34,50,88,.55)), url('<?php echo e($area['image']); ?>')">
                <div class="focus-card-head">
                    <p class="eyebrow">Explore</p>
                    <h2><?php echo e($area['title']); ?></h2>
                    <p><?php echo e($area['tagline']); ?></p>
                </div>
                <div class="focus-scroll-row" data-focus-scroll>
                    <?php foreach ($area['items'] as $item): ?>
                        <button type="button" class="focus-mini-card"
                            data-story-title="<?php echo e($item['title']); ?>"
                            data-story-summary="<?php echo e($item['summary']); ?>"
                            data-story-photos="<?php echo e(implode(',', $item['photos'])); ?>">
                            <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>">
                            <span class="focus-mini-overlay"></span>
                            <span class="focus-mini-body">
                                <strong><?php echo e($item['title']); ?></strong>
                                <em>Click to explore <?php echo renderIcon('arrow-right'); ?></em>
                            </span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- MEDIA: vertical popped-carousel, no modal, embedded -->
<section class="section community-inhouse-section" id="media">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Media</p>
            <h2>Moments from the field and the floor.</h2>
        </div>
        <div class="story-gallery story-gallery-inline" data-gallery="<?php echo e(implode(',', $gallery)); ?>">
            <button class="story-gallery-nav prev" type="button" aria-label="Previous"><?php echo renderIcon('arrow-left'); ?></button>
            <div class="story-gallery-track"></div>
            <button class="story-gallery-nav next" type="button" aria-label="Next"><?php echo renderIcon('arrow-right'); ?></button>
        </div>
    </div>
</section>

<!-- STORY MODAL (single instance, reused for every mini-card) -->
<div class="story-modal" id="storyModal" aria-hidden="true">
    <div class="story-modal-inner">
        <button class="story-modal-close" type="button" aria-label="Close">&times;</button>
        <div class="story-modal-content">
            <div class="story-modal-text">
                <p class="eyebrow">Story</p>
                <h3 class="story-modal-title"></h3>
                <p class="story-modal-summary"></p>
            </div>
            <div class="story-gallery" data-gallery="">
                <button class="story-gallery-nav prev" type="button" aria-label="Previous"><?php echo renderIcon('arrow-left'); ?></button>
                <div class="story-gallery-track"></div>
                <button class="story-gallery-nav next" type="button" aria-label="Next"><?php echo renderIcon('arrow-right'); ?></button>
            </div>
        </div>
    </div>
</div>

        <!-- GET INVOLVED CTA -->
        <section class="community-cta-band">
            <div class="container community-cta-inner">
                <div>
                    <p class="eyebrow">Get involved</p>
                    <h2>Partner with us in the community.</h2>
                    <p>Whether you want to sponsor an event, collaborate on an outreach programme or simply learn more about our community work, we would love to hear from you.</p>
                </div>
                <div class="community-cta-actions">
                    <a class="button button-primary" href="index.php#contact">
                        <?php echo renderIcon('mail'); ?>
                        Get in touch
                    </a>
                    <a class="button button-secondary community-btn-outline" href="careers.php">
                        <?php echo renderIcon('users'); ?>
                        Join our team
                    </a>
                </div>
            </div>
        </section>

    </main>

    <footer class="site-footer detail-footer">
        <div class="container footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> | Hitong Holdings (Pty) Ltd T/A Leeroy Systems</p>
            <p><a href="index.php">Back to Home</a></p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>