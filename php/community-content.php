<?php

$impactStats = [
    ['value' => '2', 'label' => 'Marathons participated'],
    ['value' => '1', 'label' => 'Orphanage painted'],
    ['value' => '4', 'label' => 'Community events'],
    ['value' => '80+', 'label' => 'Staff involved'],
];

$outreach = [
    [
        'title' => 'Diacore Gaborone Marathon',
        'summary' => 'Leeroy Systems took part in the Gaborone Marathon, representing the company and showing commitment to an active and connected community.',
        'image' => 'assets/img/gbmarathon_0.jpg',
        'category' => 'Outreach',
        'photos' => [
            'assets/img/gbmarathon_0.jpg',
            'assets/img/gbmarathon_00.jpg',
            'assets/img/gbmarathon_1.jpg',
            'assets/img/gbmarathon_2.jpg',
            'assets/img/gbmarathon_3.jpg',
            'assets/img/gbmarathon_4.jpg',
            'assets/img/gbmarathon_5.jpg',
            'assets/img/gbmarathon_6.jpg',
        ],
    ],
    [
        'title' => 'Francistown Mayor’s Marathon',
        'summary' => 'Our northern branch team participated in the Mayor ofFrancistown Marathon, bringing the Leeroy spirit to the second city.',
        'image' => 'assets/img/ftmarathon_0.jpg',
        'category' => 'Outreach',
        'photos' => [
            'assets/img/ftmarathon_0.jpg',
            'assets/img/ftmarathon_00.jpg',
            'assets/img/ftmarathon_1.jpg',
            'assets/img/ftmarathon_2.jpg',
            'assets/img/ftmarathon_3.jpg',
            'assets/img/ftmarathon_4.jpg',
            'assets/img/ftmarathon_5.jpg',
        ],
    ],
    [
        'title' => 'SOS Painting Outreach',
        'summary' => 'Staff volunteered their time and effort to repaint a local orphanage, giving back to the community in a hands-on and meaningful way.',
        'image' => 'assets/img/orphanage_0.jpg',
        'category' => 'Outreach',
        'photos' => [
            'assets/img/orphanage_00.jpg',
            'assets/img/orphanage_0.jpg',
            'assets/img/orphanage_1.jpg',
            'assets/img/orphanage_2.jpg',
            'assets/img/orphanage_3.jpg',
            'assets/img/orphanage_4.jpg',
            'assets/img/orphanage_5.jpg',
        ],
    ],
   
];

$inhouse = [
    [
        'title' => 'Christmas Party',
        'summary' => 'An annual celebration bringing the entire Leeroy Systems team together to reflect on the year, recognise achievements and enjoy the festive season.',
        'image' => 'assets/img/christmaspart2025_0.jpg',
        'icon' => 'star',
        'photos' => [
            'assets/img/christmaspart2025_0.jpg',
            'assets/img/christmaspart2025_01.jpg',
            'assets/img/christmaspart2025_2.jpg',
            'assets/img/christmaspart2025_3.jpg',
            'assets/img/christmaspart2025_4.jpg',
            'assets/img/christmaspart2025_1.jpg',
        ],
    ],
    [
        'title' => 'Spring Day',
        'summary' => 'A team outdoor day celebrating the season, giving staff a chance to relax, connect and recharge together outside the office.',
        'image' => 'assets/img/spr0.jpg',
        'icon' => 'sun',
        'photos' => [
            'assets/img/spr0.jpg',
            'assets/img/spr3.jpg',
            'assets/img/spr4.jpg',
            'assets/img/spr5.jpg',
            'assets/img/spr6.jpg',
            'assets/img/spr1.jpg',
        ],
    ],
    [
        'title' => 'Morning Aerobics',
        'summary' => 'Staff start select mornings with a group aerobics session, promoting physical wellness, team energy and a healthy work culture.',
        'image' => 'assets/img/mornaerobics_0.jpg',
        'icon' => 'activity',
        'photos' => [
            'assets/img/mornaerobics_0.jpg',
            'assets/img/mornaerobics_1.jpg',
            'assets/img/mornaerobics_2.jpg',
            'assets/img/mornaerobics_3.jpg',
            'assets/img/mornaerobics_4.jpg',
            'assets/img/mornaerobics_5.jpg',
        ],
    ],
];


$footerAffiliations = [
    ['name' => 'Business Botswana', 'logo' => 'assets/img/partners/SWAN.png'],
    ['name' => 'Brand Botswana',  'logo' => 'assets/img/partners/BRAND BOTSWANA.png'],
    ['name' => 'LEA',             'logo' => 'assets/img/partners/RSDC.png'],
];



$gallery = [
    'assets/img/christmaspart2025_0.jpg',
    'assets/img/christmaspart2025_2.jpg',
    'assets/img/spr0.jpg',
    'assets/img/spr4.jpg',
    'assets/img/mornaerobics_0.jpg',
    'assets/img/mornaerobics_2.jpg',
    'assets/img/gbmarathon_0.jpg',
    'assets/img/gbmarathon_2.jpg',
    'assets/img/ftmarathon_0.jpg',
    'assets/img/ftmarathon_2.jpg',
    'assets/img/orphanage_0.jpg',
    'assets/img/orphanage_2.jpg',
];


$focusAreas = [
    [
        'key' => 'inhouse',
        'title' => 'Life at Leeroy',
        'tagline' => 'The culture, the people, the moments that make us who we are.',
        'image' => 'assets/img/christmaspart2025_0.jpg',
        'items' => array_map(function ($item) {
            return [
                'title'   => $item['title'],
                'image'   => $item['image'],
                'summary' => $item['summary'],
                'photos'  => $item['photos'],
            ];
        }, $inhouse),
    ],
    [
        'key' => 'outreach',
        'title' => 'Beyond the Office',
        'tagline' => 'How we show up for the communities we serve, off the clock.',
        'image' => 'assets/img/gbmarathon_0.jpg',
        'items' => array_map(function ($item) {
            return [
                'title'   => $item['title'],
                'image'   => $item['image'],
                'summary' => $item['summary'],
                'photos'  => $item['photos'],
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
         'facebook' => '<path d="M15 8h-2a2 2 0 0 0-2 2v2H8v3h3v6h3v-6h3l1-3h-4v-2a1 1 0 0 1 1-1h3V6h-3Z"/>',
        'twitter' => '<path d="M22 5.8c-.7.3-1.5.5-2.3.6.8-.5 1.4-1.2 1.7-2.1-.8.5-1.6.8-2.5 1A4 4 0 0 0 12 8v.9A11.3 11.3 0 0 1 3.8 4.7a4 4 0 0 0 1.2 5.4c-.6 0-1.2-.2-1.8-.5v.1a4 4 0 0 0 3.2 3.9c-.5.1-1.1.2-1.7.1a4 4 0 0 0 3.7 2.8A8 8 0 0 1 2 18.2 11.3 11.3 0 0 0 8.1 20c7.3 0 11.4-6.1 11.4-11.4v-.5c.8-.6 1.5-1.3 2.1-2.1Z"/>',
        'linkedin' => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4V9h4v2"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
        'youtube' => '<path d="M22 12s0-3.3-.4-4.8a3 3 0 0 0-2.1-2.1C17.7 4.6 12 4.6 12 4.6s-5.7 0-7.5.5a3 3 0 0 0-2.1 2.1C2 8.7 2 12 2 12s0 3.3.4 4.8a3 3 0 0 0 2.1 2.1c1.8.5 7.5.5 7.5.5s5.7 0 7.5-.5a3 3 0 0 0 2.1-2.1c.4-1.5.4-4.8.4-4.8Z"/><path d="m10 15 5-3-5-3v6Z"/>',
         'phone' => '<path d="M22 16.9V20a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3.1a2 2 0 0 1 2 1.7c.1 1 .4 2 .8 3a2 2 0 0 1-.4 2.1L8.1 10.2a16 16 0 0 0 5.7 5.7l1.4-1.4a2 2 0 0 1 2.1-.4c1 .4 2 .7 3 .8a2 2 0 0 1 1.7 2Z"/>',
         'map' => '<path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.4"/>',
          'pin' => '<path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.4"/>',
        
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
    <link rel="stylesheet" href="assets/css/styles.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/styles.css'); ?>">
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
                            <li><a href="service-software-as-a-service.php">Software as a Service</a></li>
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
                <button type="button" class="<?php echo $index === 0 ? 'active' : ''; ?>" data-slide-control="<?php echo $index; ?>" aria-label="Show slide <?php echo $index + 1; ?>" aria-pressed="<?php echo $index === 0 ? 'true' : 'false'; ?>">
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

    
    <footer class="site-footer">
        <div class="container footer-grid">
             <div class="footer-about">
                <img src="assets/img/leeroy-systems.jpg" alt="Leeroy Systems" class="footer-logo">
                <h2>About Us</h2>
                <p>Smart prepaid water metering solutions for efficient, accountable and secure water management.</p>
                <div class="footer-social" aria-label="Follow us">
                    <a href="https://facebook.com/p/Leeroy-Systems-100063566140015" aria-label="Facebook"><?php echo renderIcon('facebook'); ?></a>
                    <a href="https://twitter.com/leeroysystems" aria-label="Twitter"><?php echo renderIcon('twitter'); ?></a>
                    <a href="https://bw.linkedin.com/in/leeroy-systems-415a142b6" aria-label="LinkedIn"><?php echo renderIcon('linkedin'); ?></a>
                    <a href="https://www.youtube.com/@LeeroySystems" aria-label="YouTube"><?php echo renderIcon('youtube'); ?></a>
                </div>
            </div>
            <div>
                <h2>Services</h2>
                <a href="#about">About Us</a>
                <a href="#contact">Help &amp; Faqs</a>
                <a href="#services">Services</a>
                <a href="#contact">Contact</a>
            </div>
            <div>
                <h2>Contact Us</h2>
                <div class="footer-contact-list">
                    <p class="footer-contact-item">
                        <span class="footer-contact-icon"><?php echo renderIcon('pin'); ?></span>
                        <span>Plot 176, Gaborone International Commerce Park.<br>Gaborone, Botswana</span>
                    </p>
                    <p class="footer-contact-item">
                        <span class="footer-contact-icon"><?php echo renderIcon('mail'); ?></span>
                        <a href="mailto:info@leeroysystems.co.bw">info@leeroysystems.co.bw</a>
                    </p>
                    <p class="footer-contact-item">
                        <span class="footer-contact-icon"><?php echo renderIcon('phone'); ?></span>
                        <a href="tel:+2673932519">(+267) 393 2519</a>
                    </p>
                </div>
            </div>
            <div>
               <div>
                    <h2>Affiliations</h2>
                    <div class="footer-affiliations">
                        <?php foreach ($footerAffiliations as $aff): ?>
                            <span>
                                <img src="<?php echo htmlspecialchars($aff['logo']); ?>"
                                    alt="<?php echo htmlspecialchars($aff['name']); ?>">
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> | Hitong Holdings (Pty) Ltd T/A Leeroy Systems</p>
            <p>Smart Prepaid Metering Solutions</p>
        </div>
    </footer>

    <script src="assets/js/main.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/main.js'); ?>"></script>
</body>
</html>