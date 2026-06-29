const header = document.querySelector('[data-header]');
const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('#site-menu');
const navLinks = document.querySelectorAll('.site-nav a');
const mobileMenuQuery = window.matchMedia('(max-width: 760px)');
const revealItems = document.querySelectorAll('.reveal');
const tabButtons = document.querySelectorAll('[role="tab"]');
const tabPanels = document.querySelectorAll('.tab-panel');
const contactForm = document.querySelector('[data-contact-form]');
const heroSlides = document.querySelectorAll('[data-slide]');
const heroControls = document.querySelectorAll('[data-slide-control]');
const heroArrows = document.querySelectorAll('[data-slide-direction]');
const aboutSlides = document.querySelectorAll('[data-about-slide]');
const projectGalleries = document.querySelectorAll('[data-project-gallery]');
let activeHeroSlide = Math.max(0, Math.floor(heroSlides.length / 2));
let heroTimer;
let activeAboutSlide = 0;

const visitorBotQuestions = [
    {
        id: 'bot-1',
        question: 'What is Leeroy Systems?',
        answer: 'Leeroy Systems is a 100% citizen-owned Botswana company specializing in smart prepaid water metering solutions.',
        category: 'About',
    },
    {
        id: 'bot-2',
        question: 'How does a smart prepaid meter work?',
        answer: 'It uses IoT technology such as LoRaWAN to transmit water usage data in real time, so you can monitor usage, receive alerts, and buy credits.',
        category: 'About',
    },
    {
        id: 'bot-3',
        question: 'What is a CIU?',
        answer: 'A Customer Interface Unit shows your balance, usage history, and alerts for leaks or unusual consumption.',
        category: 'About',
    },
    {
        id: 'bot-4',
        question: 'How do I buy water credits?',
        answer: 'You can buy water credits through the website, mobile app, USSD, or authorized payment vendors.',
        category: 'Billing',
    },
    {
        id: 'bot-5',
        question: 'What happens if I run out of credit?',
        answer: 'You will receive alerts, and the supply can pause temporarily until you top up.',
        category: 'Billing',
    },
    {
        id: 'bot-6',
        question: 'How long does installation take?',
        answer: 'Most residential installations are completed within a few hours with minimal disruption.',
        category: 'Installation',
    },
    {
        id: 'bot-7',
        question: 'How does the system detect leaks?',
        answer: 'The meter monitors flow patterns and can alert you if it detects continuous flow that suggests a leak.',
        category: 'Support',
    },
    {
        id: 'bot-8',
        question: 'Who can install Leeroy smart meters?',
        answer: 'Homeowners, landlords, businesses, property developers, utilities, and government institutions can use our solutions.',
        category: 'Customers',
    },
    {
        id: 'bot-9',
        question: 'Is my data secure?',
        answer: 'Yes. Data between your meter and our systems is encrypted and protected.',
        category: 'Technical',
    },
    {
        id: 'bot-10',
        question: 'How do I contact support?',
        answer: 'Call (+267) 393 2519, email info@leeroysystems.co.bw, or visit Plot 176, Gaborone International Commerce Park.',
        category: 'Support',
    },
];

const visitorBotLinks = [
    { label: 'Home', href: 'index.php#home', hint: 'Go back to the landing page' },
    { label: 'About Us', href: 'index.php#about', hint: 'Learn more about Leeroy Systems' },
    { label: 'Services', href: 'index.php#services', hint: 'See our service offerings' },
    { label: 'Projects', href: 'index.php#projects', hint: 'View our project work' },
    { label: 'Community', href: 'community.php', hint: 'Browse community impact stories' },
    { label: 'Contact', href: 'index.php#contact', hint: 'Reach the team quickly' },
];

if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
        const isOpen = navMenu.classList.toggle('open');
        navToggle.setAttribute('aria-expanded', String(isOpen));
    });

    navLinks.forEach((link) => {
        link.addEventListener('click', () => {
            const isDropdownTrigger = link.parentElement?.classList.contains('nav-dropdown') &&
                link.parentElement.firstElementChild === link;

            if (mobileMenuQuery.matches && isDropdownTrigger) {
                return;
            }

            navMenu.classList.remove('open');
            navToggle.setAttribute('aria-expanded', 'false');
            mobileDropdowns.forEach((dropdown) => dropdown.classList.remove('open'));
        });
    });
}

const mobileDropdowns = document.querySelectorAll('.nav-dropdown');

mobileDropdowns.forEach((dropdown) => {
    const trigger = Array.from(dropdown.children).find((child) => child.tagName === 'A');

    if (!trigger) return;

    trigger.setAttribute('aria-expanded', 'false');

    trigger.addEventListener('click', (e) => {

        if (mobileMenuQuery.matches) {

            e.preventDefault();

            mobileDropdowns.forEach((item) => {
                if (item !== dropdown) {
                    item.classList.remove('open');
                    const itemTrigger = Array.from(item.children).find((child) => child.tagName === 'A');
                    itemTrigger?.setAttribute('aria-expanded', 'false');
                }
            });

            const isOpen = dropdown.classList.toggle('open');
            trigger.setAttribute('aria-expanded', String(isOpen));
        }
    });
});


const setActiveLink = () => {
    const currentPath = window.location.pathname.split('/').pop() || 'index.php';
    const isHomePage = currentPath === 'index.php' || currentPath === '' || currentPath === 'index.html';
    const fromTop = window.scrollY + 120;

    navLinks.forEach((link) => {
        const href = link.getAttribute('href');
        if (!href) return;

        let isActive = false;

        if (href.startsWith('#')) {
            // Anchor link — only activate via scroll-spy, and only on the home page
            if (isHomePage) {
                const section = document.querySelector(href);
                if (section) {
                    isActive =
                        section.offsetTop <= fromTop &&
                        section.offsetTop + section.offsetHeight > fromTop;
                }
            }
        } else {
            // Real page link — match by filename
            const linkPage = href.split('/').pop().split('#')[0];
            if (linkPage) {
                isActive = linkPage === currentPath;
            }
        }

        link.classList.toggle('active', isActive);

        // If a dropdown child is active, highlight the parent trigger too
        if (isActive) {
            const parentDropdown = link.closest('.nav-dropdown');
            if (parentDropdown) {
                const trigger = parentDropdown.querySelector(':scope > a');
                if (trigger && trigger !== link) {
                    trigger.classList.add('active');
                }
            }
        }
    });

    if (header) {
        header.classList.toggle('scrolled', window.scrollY > 8);
    }
};

window.addEventListener('scroll', setActiveLink);
setActiveLink();

const showHeroSlide = (index) => {
    if (!heroSlides.length) return;

    activeHeroSlide = (index + heroSlides.length) % heroSlides.length;

    heroSlides.forEach((slide, slideIndex) => {
        const isActive = slideIndex === activeHeroSlide;
        slide.classList.toggle('active', isActive);
        slide.setAttribute('aria-hidden', String(!isActive));
    });

    heroControls.forEach((control, controlIndex) => {
        const isActive = controlIndex === activeHeroSlide;
        control.classList.toggle('active', isActive);
        control.setAttribute('aria-pressed', String(isActive));
    });
};

const startHeroSlider = () => {
    if (heroSlides.length < 2) return;
    window.clearInterval(heroTimer);
    heroTimer = window.setInterval(() => showHeroSlide(activeHeroSlide + 1), 6200);
};

heroControls.forEach((control) => {
    control.addEventListener('click', () => {
        showHeroSlide(Number(control.dataset.slideControl));
        startHeroSlider();
    });
});

heroArrows.forEach((arrow) => {
    arrow.addEventListener('click', () => {
        const direction = arrow.dataset.slideDirection === 'next' ? 1 : -1;
        showHeroSlide(activeHeroSlide + direction);
        startHeroSlider();
    });
});

// show the initial (middle) slide so the page loads with content centered
showHeroSlide(activeHeroSlide);
startHeroSlider();

const showAboutSlide = (index) => {
    if (!aboutSlides.length) return;

    activeAboutSlide = (index + aboutSlides.length) % aboutSlides.length;

    aboutSlides.forEach((slide, slideIndex) => {
        slide.classList.toggle('active', slideIndex === activeAboutSlide);
    });
};

if (aboutSlides.length > 1) {
    window.setInterval(() => showAboutSlide(activeAboutSlide + 1), 3400);
}

projectGalleries.forEach((gallery) => {
    const images = gallery.querySelectorAll('[data-project-image]');
    const buttons = gallery.querySelectorAll('[data-project-direction]');
    let activeIndex = 0;

    const showProjectImage = (index) => {
        if (!images.length) return;
        activeIndex = (index + images.length) % images.length;
        images.forEach((image, imageIndex) => {
            image.classList.toggle('active', imageIndex === activeIndex);
        });
    };

    buttons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const direction = button.dataset.projectDirection === 'next' ? 1 : -1;
            showProjectImage(activeIndex + direction);
        });
    });
});

if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.16 });

    revealItems.forEach((item) => revealObserver.observe(item));
} else {
    revealItems.forEach((item) => item.classList.add('visible'));
}

tabButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const target = button.dataset.tab;

        tabButtons.forEach((tab) => tab.setAttribute('aria-selected', String(tab === button)));
        tabPanels.forEach((panel) => panel.classList.toggle('active', panel.id === target));
    });
});

if (contactForm) {
    contactForm.addEventListener('submit', (event) => {
        const requiredFields = contactForm.querySelectorAll('[required]');
        let valid = true;

        requiredFields.forEach((field) => {
            if (!field.value.trim()) {
                valid = false;
                field.setAttribute('aria-invalid', 'true');
            } else {
                field.removeAttribute('aria-invalid');
            }
        });

        if (!valid) {
            event.preventDefault();
            const firstInvalid = contactForm.querySelector('[aria-invalid="true"]');
            if (firstInvalid) {
                firstInvalid.focus();
            }
        }
    });
}


function initStoryGallery(container, photos) {
    const track = container.querySelector('.story-gallery-track');
    const prevBtn = container.querySelector('.story-gallery-nav.prev');
    const nextBtn = container.querySelector('.story-gallery-nav.next');
    let activeIndex = 0;

    // Build (or reuse) the thumbnail strip right after this gallery container
    let scrollStrip = container.nextElementSibling;
    if (!scrollStrip || !scrollStrip.classList.contains('story-gallery-scroll')) {
        scrollStrip = document.createElement('div');
        scrollStrip.className = 'story-gallery-scroll';
        container.insertAdjacentElement('afterend', scrollStrip);
    }
    scrollStrip.innerHTML = '';
    photos.forEach((src, i) => {
        const thumb = document.createElement('button');
        thumb.type = 'button';
        thumb.className = 'story-gallery-thumb';
        const name = src.split('/').pop().replace(/\.[^/.]+$/, '').replace(/[-_]/g, ' ');
        thumb.innerHTML = `<img src="${src}" alt="${name}">`;
        thumb.addEventListener('click', () => {
            activeIndex = i;
            render();
        });
        scrollStrip.appendChild(thumb);
    });

    // Create all images once so CSS transitions can animate between states
    track.innerHTML = '';
    const imgElements = photos.map((src, i) => {
        const img = document.createElement('img');
        img.src = src;
        img.className = 'story-gallery-img';
        const name = src.split('/').pop().replace(/\.[^/.]+$/, '').replace(/[-_]/g, ' ');
        img.alt = name;
        img.draggable = false;
        img.addEventListener('click', () => {
            if (i === activeIndex) return;
            activeIndex = i;
            render();
        });
        track.appendChild(img);
        return img;
    });

    const positionImages = () => {
        const n = imgElements.length;
        imgElements.forEach((img, i) => {
            // Circular distance so every image always has neighbours on both sides
            const raw = ((i - activeIndex) % n + n) % n;
            const distance = raw > n / 2 ? raw - n : raw;
            const absDist = Math.abs(distance);
            const isActive = distance === 0;

            img.classList.toggle('is-active', isActive);

            const scale = isActive ? 1 : Math.max(0.55, 1 - absDist * 0.16);
            const translateX = distance * 240;
            const opacity = absDist > 3 ? 0 : 1 - absDist * 0.22;

            img.style.transform = `translate(-50%, -50%) translateX(${translateX}px) scale(${scale})`;
            img.style.opacity = String(Math.max(opacity, 0));
            img.style.zIndex = String(100 - absDist);
        });
    };

    const syncThumbs = () => {
        const thumbs = scrollStrip.querySelectorAll('.story-gallery-thumb');
        thumbs.forEach((t, i) => t.classList.toggle('is-active', i === activeIndex));
        const activeThumb = thumbs[activeIndex];
        if (activeThumb) {
            activeThumb.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }
    };

    const render = () => {
        positionImages();
        syncThumbs();
    };

    const goPrev = () => {
        activeIndex = (activeIndex - 1 + photos.length) % photos.length;
        render();
    };
    const goNext = () => {
        activeIndex = (activeIndex + 1) % photos.length;
        render();
    };

    prevBtn.addEventListener('click', goPrev);
    nextBtn.addEventListener('click', goNext);

    // --- Touch / mouse drag scrolling ---
    let startX = 0;
    let isDragging = false;
    let hasMoved = false;
    const dragThreshold = 40;

    const onDragStart = (clientX) => {
        startX = clientX;
        isDragging = true;
        hasMoved = false;
        container.classList.add('dragging');
    };

    const onDragMove = (clientX) => {
        if (!isDragging) return;
        const delta = clientX - startX;
        if (Math.abs(delta) > 10) hasMoved = true;
    };

    const onDragEnd = (clientX) => {
        if (!isDragging) return;
        const delta = clientX - startX;
        isDragging = false;
        container.classList.remove('dragging');

        if (Math.abs(delta) > dragThreshold) {
            if (delta < 0) goNext();
            else goPrev();
        }
    };

    container.addEventListener('touchstart', (e) => {
        onDragStart(e.touches[0].clientX);
    }, { passive: true });

    container.addEventListener('touchmove', (e) => {
        onDragMove(e.touches[0].clientX);
    }, { passive: true });

    container.addEventListener('touchend', (e) => {
        onDragEnd(e.changedTouches[0].clientX);
    });

    container.addEventListener('mousedown', (e) => {
        onDragStart(e.clientX);
        e.preventDefault();
    });

    window.addEventListener('mousemove', (e) => {
        onDragMove(e.clientX);
    });

    window.addEventListener('mouseup', (e) => {
        onDragEnd(e.clientX);
    });

    track.addEventListener('click', (e) => {
        if (hasMoved) {
            e.stopPropagation();
        }
    }, true);

    // Set initial positions without transitions to avoid a flash on first paint
    imgElements.forEach(img => { img.style.transition = 'none'; });
    positionImages();
    syncThumbs();
    requestAnimationFrame(() => requestAnimationFrame(() => {
        imgElements.forEach(img => { img.style.transition = ''; });
    }));
}

// Inline media gallery (always visible, no modal)
document.querySelectorAll('.story-gallery-inline').forEach((container) => {
    const photos = (container.dataset.gallery || '').split(',').filter(Boolean);
    if (photos.length) initStoryGallery(container, photos);
});

// Story modal wiring with focus management
const storyModal = document.getElementById('storyModal');
if (storyModal) {
    const modalTitle = storyModal.querySelector('.story-modal-title');
    const modalSummary = storyModal.querySelector('.story-modal-summary');
    const modalGallery = storyModal.querySelector('.story-gallery');
    const closeBtn = storyModal.querySelector('.story-modal-close');
    let lastActiveTrigger = null;
    let trapHandler = null;

    document.querySelectorAll('.focus-mini-card').forEach((card) => {
        card.addEventListener('click', () => {
            lastActiveTrigger = card;
            modalTitle.textContent = card.dataset.storyTitle || '';
            modalSummary.textContent = card.dataset.storySummary || '';
            const photos = (card.dataset.storyPhotos || '').split(',').filter(Boolean);
            initStoryGallery(modalGallery, photos);
            storyModal.classList.add('open');
            storyModal.setAttribute('aria-hidden', 'false');

            // focus trap: focus close button and keep focus inside modal
            const focusable = storyModal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            const firstFocusable = focusable[0];
            const lastFocusable = focusable[focusable.length - 1] || firstFocusable;
            closeBtn.focus();

            trapHandler = function (e) {
                if (e.key !== 'Tab') return;
                if (focusable.length === 0) {
                    e.preventDefault();
                    return;
                }
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        e.preventDefault();
                        lastFocusable.focus();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        e.preventDefault();
                        firstFocusable.focus();
                    }
                }
            };

            document.addEventListener('keydown', trapHandler);
        });
    });

    const closeModal = () => {
        storyModal.classList.remove('open');
        storyModal.setAttribute('aria-hidden', 'true');
        if (trapHandler) {
            document.removeEventListener('keydown', trapHandler);
            trapHandler = null;
        }
        if (lastActiveTrigger && typeof lastActiveTrigger.focus === 'function') {
            lastActiveTrigger.focus();
        }
    };

    closeBtn.addEventListener('click', closeModal);
    storyModal.addEventListener('click', (e) => {
        if (e.target === storyModal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
}

const initVisitorBot = () => {
    const existingLauncher = document.querySelector('[data-bot-launcher]');
    const existingDrawer = document.querySelector('[data-bot-drawer]');

    if (!existingLauncher && !existingDrawer) {
        const launcher = document.createElement('button');
        launcher.className = 'bot-launcher';
        launcher.type = 'button';
        launcher.setAttribute('data-bot-launcher', '');
        launcher.setAttribute('aria-expanded', 'false');
        launcher.setAttribute('aria-controls', 'botDrawer');
        launcher.innerHTML = `
            <span class="bot-launcher-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"></path>
                    <path d="M8 8h8"></path>
                    <path d="M8 12h5"></path>
                </svg>
            </span>
            <span class="bot-launcher-text">Chat</span>
        `;

        const drawer = document.createElement('section');
        drawer.className = 'bot-drawer';
        drawer.id = 'botDrawer';
        drawer.setAttribute('data-bot-drawer', '');
        drawer.setAttribute('aria-hidden', 'true');
        drawer.innerHTML = `
            <div class="bot-drawer-header">
                <div class="bot-shell-header">
                    <div class="bot-avatar">LS</div>
                    <div>
                        <strong>Leeroy Visitor Bot</strong>
                        <span>Quick answers, open now</span>
                    </div>
                </div>
                <button class="bot-drawer-close" type="button" data-bot-close aria-label="Close chat">&times;</button>
            </div>
            <div class="bot-drawer-home" data-bot-home>
                <div class="bot-chat bot-drawer-chat" data-bot-chat>
                    <div class="bot-bubble bot">
                        <p>I can answer the top questions about Leeroy Systems and help you move around the site.</p>
                    </div>
                </div>
                <div class="bot-actions bot-drawer-actions"></div>
                <div class="bot-shortcuts-label">Quick site shortcuts</div>
                <div class="bot-shortcuts bot-drawer-shortcuts"></div>
            </div>
            <div class="bot-answer-view" data-bot-answer-view hidden>
                <button class="bot-answer-back" type="button" data-bot-back>
                    <span aria-hidden="true">&larr;</span>
                    Back to questions
                </button>
                <article class="bot-answer-card">
                    <p class="bot-label" data-bot-answer-category></p>
                    <h4 data-bot-answer-question></h4>
                    <p data-bot-answer-text></p>
                </article>
                <div class="bot-shortcuts-label">Follow-up questions</div>
                <div class="bot-actions bot-followups" data-bot-followups></div>
            </div>
        `;

        document.body.appendChild(launcher);
        document.body.appendChild(drawer);
    }

    const botLauncher = document.querySelector('[data-bot-launcher]');
    const botDrawer = document.querySelector('[data-bot-drawer]');
    const botClose = document.querySelector('[data-bot-close]');
    const botChat = document.querySelector('[data-bot-chat]');
    const botHome = document.querySelector('[data-bot-home]');
    const botAnswerView = document.querySelector('[data-bot-answer-view]');
    const botAnswerCategory = document.querySelector('[data-bot-answer-category]');
    const botAnswerQuestion = document.querySelector('[data-bot-answer-question]');
    const botAnswerText = document.querySelector('[data-bot-answer-text]');
    const botFollowups = document.querySelector('[data-bot-followups]');
    const botActionRow = document.querySelector('.bot-drawer-actions');
    const botShortcuts = document.querySelector('.bot-drawer-shortcuts');

    if (!botLauncher || !botDrawer || !botChat || !botHome || !botAnswerView || !botAnswerCategory || !botAnswerQuestion || !botAnswerText || !botFollowups || !botActionRow || !botShortcuts) return;

    if (!botActionRow.children.length) {
        visitorBotQuestions.slice(0, 4).forEach((item) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'bot-chip';
            button.dataset.botQuestion = item.id;
            button.textContent = item.question;
            botActionRow.appendChild(button);
        });
    }

    if (!botShortcuts.children.length) {
        visitorBotLinks.slice(0, 4).forEach((link) => {
            const anchor = document.createElement('a');
            anchor.className = 'bot-shortcut';
            anchor.href = link.href;
            anchor.innerHTML = `<strong>${link.label}</strong><span>${link.hint}</span>`;
            botShortcuts.appendChild(anchor);
        });
    }

    const questionMap = new Map(visitorBotQuestions.map((item) => [item.id, item]));

    const scrollToBottom = () => {
        botChat.scrollTop = botChat.scrollHeight;
    };

    const animatePane = (pane) => {
        pane.classList.remove('bot-pane-enter');
        // restart animation on each view change
        void pane.offsetWidth;
        pane.classList.add('bot-pane-enter');
    };

    const showHome = () => {
        botHome.hidden = false;
        botAnswerView.hidden = true;
        animatePane(botHome);
        scrollToBottom();
    };

    const showAnswer = (item) => {
        botAnswerCategory.textContent = item.category;
        botAnswerQuestion.textContent = item.question;
        botAnswerText.textContent = item.answer;

        botFollowups.innerHTML = '';
        const followups = visitorBotQuestions
            .filter((q) => q.id !== item.id)
            .sort((a, b) => (a.category === item.category ? -1 : 1) - (b.category === item.category ? -1 : 1))
            .slice(0, 4);

        followups.forEach((q) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'bot-chip';
            button.dataset.botQuestion = q.id;
            button.textContent = q.question;
            botFollowups.appendChild(button);
        });

        botHome.hidden = true;
        botAnswerView.hidden = false;
        botAnswerView.scrollTop = 0;
        animatePane(botAnswerView);
    };

    const askBot = (item) => {
        if (!item) return;
        showAnswer(item);
    };

    const openDrawer = () => {
        botDrawer.classList.add('open');
        botDrawer.setAttribute('aria-hidden', 'false');
        botLauncher.setAttribute('aria-expanded', 'true');
        scrollToBottom();
    };

    const closeDrawer = () => {
        botDrawer.classList.remove('open');
        botDrawer.setAttribute('aria-hidden', 'true');
        botLauncher.setAttribute('aria-expanded', 'false');
    };

    document.addEventListener('click', (event) => {
        const questionButton = event.target.closest('[data-bot-question]');
        if (!questionButton) return;
        openDrawer();
        askBot(questionMap.get(questionButton.dataset.botQuestion));
    });

    document.addEventListener('click', (event) => {
        const backButton = event.target.closest('[data-bot-back]');
        if (!backButton) return;
        showHome();
    });

    botLauncher.addEventListener('click', () => {
        if (botDrawer.classList.contains('open')) {
            closeDrawer();
        } else {
            openDrawer();
            showHome();
        }
    });

    botClose?.addEventListener('click', closeDrawer);

    document.addEventListener('click', (event) => {
        if (!botDrawer.classList.contains('open')) return;
        if (event.target.closest('[data-bot-question]') || event.target.closest('[data-bot-back]')) return;
        if (botDrawer.contains(event.target) || botLauncher.contains(event.target)) return;
        closeDrawer();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeDrawer();
    });
};

initVisitorBot();