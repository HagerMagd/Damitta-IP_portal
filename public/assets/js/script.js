// DOM Content Loaded
// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initSlider();
    initScrollAnimations();
    initCounters();
    initMobileMenu();
    initSmoothScrolling();
});

// Image Slider Functionality
function initSlider() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    const autoPlayBtn = document.querySelector('.auto-play-btn');
    
    let currentSlide = 0;
    let isAutoPlaying = true;
    let autoPlayInterval;

    // Auto-play functionality
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            nextSlide();
        }, 4000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Show specific slide
    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        currentSlide = index;
    }

    // Next slide
    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    // Previous slide
    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            if (isAutoPlaying) {
                stopAutoPlay();
                isAutoPlaying = false;
                autoPlayBtn.textContent = 'Click to auto-play';
                autoPlayBtn.classList.remove('active');
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            if (isAutoPlaying) {
                stopAutoPlay();
                isAutoPlaying = false;
                autoPlayBtn.textContent = 'Click to auto-play';
                autoPlayBtn.classList.remove('active');
            }
        });
    }

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            if (isAutoPlaying) {
                stopAutoPlay();
                isAutoPlaying = false;
                autoPlayBtn.textContent = 'Click to auto-play';
                autoPlayBtn.classList.remove('active');
            }
        });
    });

    // Auto-play toggle
    if (autoPlayBtn) {
        autoPlayBtn.addEventListener('click', () => {
            isAutoPlaying = !isAutoPlaying;
            if (isAutoPlaying) {
                startAutoPlay();
                autoPlayBtn.textContent = 'Auto-playing';
                autoPlayBtn.classList.add('active');
            } else {
                stopAutoPlay();
                autoPlayBtn.textContent = 'Click to auto-play';
                autoPlayBtn.classList.remove('active');
            }
        });
    }

    // Start auto-play initially
    if (isAutoPlaying) {
        startAutoPlay();
    }
}

// Scroll Animations
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    // Observe fade-in elements
    document.querySelectorAll('.fade-in-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Observe stat items for count animation
    document.querySelectorAll('.count-up').forEach(el => {
        observer.observe(el);
    });
}

// Counter Animation
function initCounters() {
    function animateCounter(element) {
        const target = parseInt(element.dataset.target);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current < target) {
                element.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        };
        
        updateCounter();
    }

    // Counter observer
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target.querySelector('.stat-number');
                if (counter && !counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    animateCounter(counter);
                }
                entry.target.classList.add('animate');
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.count-up').forEach(el => {
        counterObserver.observe(el);
    });
}

// Mobile Menu
function initMobileMenu() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const nav = document.querySelector('.nav');

    if (mobileMenuBtn && nav) {
        mobileMenuBtn.addEventListener('click', () => {
            nav.classList.toggle('mobile-active');
        });
    }
}

// Smooth Scrolling for Anchor Links
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Header Scroll Effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = 'none';
    }
});

// Dashboard Functionality
function initDashboard() {
    // Notification close functionality
    document.querySelectorAll('.notification-close').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.notification-item').remove();
        });
    });

    // Status filter functionality
    const statusFilter = document.querySelector('#status-filter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            const filterValue = this.value;
            const projectItems = document.querySelectorAll('.project-item');
            
            projectItems.forEach(item => {
                const status = item.querySelector('.status-badge').textContent.toLowerCase();
                if (filterValue === 'all' || status.includes(filterValue)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // Search functionality
    const searchInput = document.querySelector('#project-search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const projectItems = document.querySelectorAll('.project-item');
            
            projectItems.forEach(item => {
                const projectName = item.querySelector('h4').textContent.toLowerCase();
                if (projectName.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
}

// Utility Functions
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 16px 24px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        z-index: 9999;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// Export functions for global use
window.showModal = showModal;
window.hideModal = hideModal;
window.showToast = showToast;
window.initDashboard = initDashboard;
