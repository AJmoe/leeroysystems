<?php
$whyUs = [
    [
        'title' => 'Career Growth',
        'summary' => 'We invest in our people through training, mentorship and clear paths for advancement.',
        'icon' => 'trend',
    ],
    [
        'title' => '100% Citizen Owned',
        'summary' => 'Be part of a proudly Botswana company making a real impact on water management across the country.',
        'icon' => 'flag',
    ],
    [
        'title' => 'Nationwide Presence',
        'summary' => 'Work across our four branches in Gaborone, Francistown, Palapye and Jwaneng.',
        'icon' => 'map',
    ],
    [
        'title' => 'Meaningful Work',
        'summary' => 'Every role contributes to smarter water infrastructure for communities across Botswana.',
        'icon' => 'target',
    ],
];

$footerAffiliations = [
    ['name' => 'Business Botswana', 'logo' => 'assets/img/partners/SWAN.png'],
    ['name' => 'Brand Botswana',  'logo' => 'assets/img/partners/BRAND BOTSWANA.png'],
    ['name' => 'LEA',             'logo' => 'assets/img/partners/RSDC.png'],
];

$openings = [];

$formStatus = null;
$formErrors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $cover    = trim($_POST['cover'] ?? '');
    $cvFile   = $_FILES['cv'] ?? null;

    if ($name === '') $formErrors[] = 'Please enter your full name.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $formErrors[] = 'Please enter a valid email address.';
    if ($position === '') $formErrors[] = 'Please select a position.';
    if (empty($cvFile['name'])) $formErrors[] = 'Please upload your CV.';

    if (!empty($cvFile['name'])) {
        $allowed = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        if (!in_array($cvFile['type'], $allowed)) {
            $formErrors[] = 'CV must be a PDF or Word document.';
        }
        if ($cvFile['size'] > 5 * 1024 * 1024) {
            $formErrors[] = 'CV file size must be under 5MB.';
        }
    }

    if (!$formErrors) {
        $safeName    = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
        $date        = date('Y-m-d');
        $ext         = pathinfo($cvFile['name'], PATHINFO_EXTENSION);
        $filename    = "cv_{$safeName}_{$date}.{$ext}";
        $uploadDir   = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'cvs' . DIRECTORY_SEPARATOR;
        $uploadPath  = $uploadDir . $filename;
        $storageFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'applications.json';

        if (!is_dir($uploadDir)) {
            $formErrors[] = 'Upload directory does not exist. Please contact the administrator.';
        } elseif (move_uploaded_file($cvFile['tmp_name'], $uploadPath)) {
            $entry = [
                'name'         => $name,
                'email'        => $email,
                'phone'        => $phone,
                'position'     => $position,
                'cover'        => $cover,
                'cv_file'      => $filename,
                'submitted_at' => date('c'),
            ];

            $entries = [];
            if (file_exists($storageFile)) {
                $existing = json_decode(file_get_contents($storageFile), true);
                if (is_array($existing)) $entries = $existing;
            }
            $entries[] = $entry;
            file_put_contents($storageFile, json_encode($entries, JSON_PRETTY_PRINT));

            $formStatus = 'success';
            $_POST = [];
        } else {
            $formErrors[] = 'Failed to upload CV. Please try again.';
        }
    }
}

function e(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

function renderIcon(string $name): string {
    $icons = [
        'trend'       => '<path d="m3 17 6-6 4 4 7-7"/><path d="M14 8h6v6"/>',
        'flag'        => '<path d="M5 21V4"/><path d="M5 5h12l-2 4 2 4H5"/>',
        'map'         => '<path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.4"/>',
        'target'      => '<circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1"/>',
        'users'       => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/>',
        'mail'        => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'phone'       => '<path d="M22 16.9V20a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3.1a2 2 0 0 1 2 1.7c.1 1 .4 2 .8 3a2 2 0 0 1-.4 2.1L8.1 10.2a16 16 0 0 0 5.7 5.7l1.4-1.4a2 2 0 0 1 2.1-.4c1 .4 2 .7 3 .8a2 2 0 0 1 1.7 2Z"/>',
        'upload'      => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>',
        'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'briefcase'   => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-4 0v2"/><line x1="12" y1="12" x2="12" y2="12"/>',
        'check'       => '<path d="m20 6-11 11-5-5"/>',
        'pin'         => '<path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.4"/>',
        'facebook' => '<path d="M15 8h-2a2 2 0 0 0-2 2v2H8v3h3v6h3v-6h3l1-3h-4v-2a1 1 0 0 1 1-1h3V6h-3Z"/>',
        'twitter' => '<path d="M22 5.8c-.7.3-1.5.5-2.3.6.8-.5 1.4-1.2 1.7-2.1-.8.5-1.6.8-2.5 1A4 4 0 0 0 12 8v.9A11.3 11.3 0 0 1 3.8 4.7a4 4 0 0 0 1.2 5.4c-.6 0-1.2-.2-1.8-.5v.1a4 4 0 0 0 3.2 3.9c-.5.1-1.1.2-1.7.1a4 4 0 0 0 3.7 2.8A8 8 0 0 1 2 18.2 11.3 11.3 0 0 0 8.1 20c7.3 0 11.4-6.1 11.4-11.4v-.5c.8-.6 1.5-1.3 2.1-2.1Z"/>',
        'linkedin' => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4V9h4v2"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
        'youtube' => '<path d="M22 12s0-3.3-.4-4.8a3 3 0 0 0-2.1-2.1C17.7 4.6 12 4.6 12 4.6s-5.7 0-7.5.5a3 3 0 0 0-2.1 2.1C2 8.7 2 12 2 12s0 3.3.4 4.8a3 3 0 0 0 2.1 2.1c1.8.5 7.5.5 7.5.5s5.7 0 7.5-.5a3 3 0 0 0 2.1-2.1c.4-1.5.4-4.8.4-4.8Z"/><path d="m10 15 5-3-5-3v6Z"/>',
        
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
    <meta name="description" content="Join the Leeroy Systems team. Explore career opportunities in smart prepaid water metering across Botswana.">
    <title>Careers | Leeroy Systems</title>
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
                    <li><a href="community.php">Community</a></li>
                    <li><a href="careers.php" class="active">Careers</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main">

        <!-- HERO -->
        <section class="detail-hero">
            <img src="assets/img/careers.png" alt="Leeroy Systems team">
            <span class="detail-hero-overlay"></span>
            <div class="container detail-hero-content">
                <p class="eyebrow">Careers</p>
                <h1>Build your career with us.</h1>
                <p>Join a team that is reshaping water management across Botswana through smart technology, dedication and innovation.</p>
            </div>
        </section>

        <!-- CURRENT OPENINGS -->
        <section class="section" id="openings">
            <div class="container">
                <div class="section-heading">
                    <p class="eyebrow">Current openings</p>
                    <h2>Positions available.</h2>
                </div>
                <?php if (empty($openings)): ?>
                    <div class="careers-empty">
                        <div class="careers-empty-icon"><?php echo renderIcon('briefcase'); ?></div>
                        <h3>No vacancies at the moment</h3>
                        <p>We don't have any open positions right now but we're always interested in talented people. Submit your CV below and we'll be in touch when something comes up.</p>
                    </div>
                <?php else: ?>
                    <div class="careers-grid">
                        <?php foreach ($openings as $job): ?>
                            <article class="careers-card">
                                <div class="careers-card-header">
                                    <span class="careers-badge"><?php echo e($job['type']); ?></span>
                                    <span class="careers-location">
                                        <?php echo renderIcon('pin'); ?>
                                        <?php echo e($job['location']); ?>
                                    </span>
                                </div>
                                <h3><?php echo e($job['title']); ?></h3>
                                <p><?php echo e($job['department']); ?></p>
                                <p><?php echo e($job['summary']); ?></p>
                                <a class="careers-apply-btn" href="#apply">Apply Now</a>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- WHY WORK WITH US -->
        <section class="section careers-why" id="why-us">
            <div class="container">
                <div class="section-heading">
                    <p class="eyebrow">Why join us</p>
                    <h2>More than just a job.</h2>
                </div>
                <div class="careers-why-grid">
                    <?php foreach ($whyUs as $item): ?>
                        <article class="value-card reveal">
                            <span class="feature-icon"><?php echo renderIcon($item['icon']); ?></span>
                            <div>
                                <h3><?php echo e($item['title']); ?></h3>
                                <p><?php echo e($item['summary']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- CULTURE GALLERY -->
        <section class="section careers-culture">
            <div class="container">
                <div class="section-heading">
                    <p class="eyebrow">Our team</p>
                    <h2>The people behind the work.</h2>
                </div>
                <div class="careers-gallery">
                    <img src="assets/img/ab-us1.jpg" alt="Leeroy Systems field team">
                    <img src="assets/img/pearlleeroy.jpg" alt="Leeroy Systems staff">
                    <img src="assets/img/ab-us.jpg" alt="Leeroy Systems operations">
                    <img src="assets/img/about.jpg" alt="Leeroy Systems team">
                </div>
            </div>
        </section>

        <!-- APPLICATION FORM -->
        <section class="section contact-section" id="apply">
            <div class="cs-hero">
                <div class="cs-hero-eyebrow">Join our team</div>
                <h1>Submit your application</h1>
                <p>Fill in the form below and attach your CV. We will review your application and get back to you.</p>
            </div>

            <div class="cs-form-outer">
                <div class="cs-form-wrap">
                    <p class="cs-form-title">Application form</p>

                    <?php if ($formStatus === 'success'): ?>
                        <div class="form-alert success">
                            <p>Thank you for your application. We have received your CV and will be in touch.</p>
                        </div>
                    <?php endif; ?>

                    <?php if ($formErrors): ?>
                        <div class="form-alert error">
                            <?php foreach ($formErrors as $error): ?>
                                <p><?php echo e($error); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="#apply" enctype="multipart/form-data" novalidate>
                        <div class="cs-form-grid">

                            <div class="cs-field">
                                <div class="cs-input-icon">
                                    <?php echo renderIcon('users'); ?>
                                    <input type="text" name="name"
                                        value="<?php echo e($_POST['name'] ?? ''); ?>"
                                        placeholder="" required>
                                </div>
                            </div>

                            <div class="cs-field">
                                <div class="cs-input-icon">
                                    <?php echo renderIcon('mail'); ?>
                                    <input type="email" name="email"
                                        value="<?php echo e($_POST['email'] ?? ''); ?>"
                                        placeholder="" required>
                                </div>
                            </div>

                            <div class="cs-field">
                                <div class="cs-input-icon">
                                    <?php echo renderIcon('phone'); ?>
                                    <input type="tel" name="phone"
                                        value="<?php echo e($_POST['phone'] ?? ''); ?>"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="cs-field">
                                <label class="cs-field-label">Position</label>
                                <select name="position" required>
                                    <option value="">Select a position</option>
                                    <option value="General Application" <?php echo (($_POST['position'] ?? '') === 'General Application') ? 'selected' : ''; ?>>General Application</option>
                                    <?php foreach ($openings as $job): ?>
                                        <option value="<?php echo e($job['title']); ?>"
                                            <?php echo (($_POST['position'] ?? '') === $job['title']) ? 'selected' : ''; ?>>
                                            <?php echo e($job['title']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="cs-field cs-form-full">
                                <textarea name="cover" rows="4"
                                    placeholder="Cover letter — tell us about yourself and why you want to join Leeroy Systems..."><?php echo e($_POST['cover'] ?? ''); ?></textarea>
                            </div>

                            <div class="cs-field cs-form-full">
                                <label class="cs-field-label">Upload CV (PDF or Word, max 5MB)</label>
                                <div class="careers-upload" id="upload-box">
                                    <?php echo renderIcon('upload'); ?>
                                    <span id="upload-label">Click to upload or drag and drop your CV here</span>
                                    <input type="file" name="cv" accept=".pdf,.doc,.docx" required id="cv-input">
                                </div>
                                <div class="careers-upload-preview" id="upload-preview">
                                    <?php echo renderIcon('check'); ?>
                                    <span id="upload-filename">No file selected</span>
                                </div>
                            </div>

                            <div class="cs-form-full">
                                <button class="cs-submit" type="submit">
                                    <?php echo renderIcon('arrow-right'); ?>
                                    Submit application
                                </button>
                            </div>

                        </div>
                    </form>
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

                <div class="footer-flag">
                    <img src="assets/img/botColor.png" alt="Botswana flag">
               </div>

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
    <script>
        const cvInput     = document.getElementById('cv-input');
        const uploadBox   = document.getElementById('upload-box');
        const preview     = document.getElementById('upload-preview');
        const filename    = document.getElementById('upload-filename');
        const uploadLabel = document.getElementById('upload-label');

        cvInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                filename.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
                preview.classList.add('visible');
                uploadBox.classList.add('has-file');
                uploadLabel.textContent = 'File selected — click to change';
            } else {
                preview.classList.remove('visible');
                uploadBox.classList.remove('has-file');
                uploadLabel.textContent = 'Click to upload or drag and drop your CV here';
            }
        });
    </script>
</body>
</html>