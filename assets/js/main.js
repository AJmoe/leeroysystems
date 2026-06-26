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
let activeHeroSlide = 0;
let heroTimer;
let activeAboutSlide = 0;

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
        slide.classList.toggle('active', slideIndex === activeHeroSlide);
    });

    heroControls.forEach((control, controlIndex) => {
        control.classList.toggle('active', controlIndex === activeHeroSlide);
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


// --- Vertical "popped middle" gallery carousel ---
function initStoryGallery(container, photos) {
    const track = container.querySelector('.story-gallery-track');
    const prevBtn = container.querySelector('.story-gallery-nav.prev');
    const nextBtn = container.querySelector('.story-gallery-nav.next');
    let activeIndex = 0;

    const render = () => {
        track.innerHTML = '';
        photos.forEach((src, i) => {
            const img = document.createElement('img');
            img.src = src;
            img.className = 'story-gallery-img';
            img.alt = '';
            img.draggable = false;

            const distance = i - activeIndex;
            const absDist = Math.abs(distance);
            const isActive = distance === 0;

            if (isActive) img.classList.add('is-active');

            const scale = isActive ? 1 : Math.max(0.55, 1 - absDist * 0.16);
            const translateX = distance * 230; // horizontal spacing
            const opacity = absDist > 3 ? 0 : 1 - absDist * 0.22;

            img.style.transform = `translate(-50%, -50%) translateX(${translateX}px) scale(${scale})`;
            img.style.opacity = String(Math.max(opacity, 0));
            img.style.zIndex = String(100 - absDist);

            img.addEventListener('click', () => {
                if (i === activeIndex) return;
                activeIndex = i;
                render();
            });

            track.appendChild(img);
        });
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
    const dragThreshold = 40; // px needed to trigger a slide change

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

    // Touch events (mobile)
    container.addEventListener('touchstart', (e) => {
        onDragStart(e.touches[0].clientX);
    }, { passive: true });

    container.addEventListener('touchmove', (e) => {
        onDragMove(e.touches[0].clientX);
    }, { passive: true });

    container.addEventListener('touchend', (e) => {
        onDragEnd(e.changedTouches[0].clientX);
    });

    // Mouse events (desktop drag)
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

    // Prevent the click-to-select-image handler from firing right after a drag
    track.addEventListener('click', (e) => {
        if (hasMoved) {
            e.stopPropagation();
        }
    }, true);

    render();
}

// Inline media gallery (always visible, no modal)
document.querySelectorAll('.story-gallery-inline').forEach((container) => {
    const photos = (container.dataset.gallery || '').split(',').filter(Boolean);
    if (photos.length) initStoryGallery(container, photos);
});

// Story modal wiring
const storyModal = document.getElementById('storyModal');
if (storyModal) {
    const modalTitle = storyModal.querySelector('.story-modal-title');
    const modalSummary = storyModal.querySelector('.story-modal-summary');
    const modalGallery = storyModal.querySelector('.story-gallery');
    const closeBtn = storyModal.querySelector('.story-modal-close');

    document.querySelectorAll('.focus-mini-card').forEach((card) => {
        card.addEventListener('click', () => {
            modalTitle.textContent = card.dataset.storyTitle || '';
            modalSummary.textContent = card.dataset.storySummary || '';
            const photos = (card.dataset.storyPhotos || '').split(',').filter(Boolean);
            initStoryGallery(modalGallery, photos);
            storyModal.classList.add('open');
            storyModal.setAttribute('aria-hidden', 'false');
        });
    });

    const closeModal = () => {
        storyModal.classList.remove('open');
        storyModal.setAttribute('aria-hidden', 'true');
    };

    closeBtn.addEventListener('click', closeModal);
    storyModal.addEventListener('click', (e) => {
        if (e.target === storyModal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
}