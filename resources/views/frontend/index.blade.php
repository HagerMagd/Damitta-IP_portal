@extends('layouts.frontend_layouts.app')
@section('title')
    
Damietta IP Portal
@endsection

@section('body')
     <!-- Hero Section -->
    <section class="hero">
        <div class="hero-pattern"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text fade-in-up">
                    <h1 class="hero-title">Secure Your Intellectual Work on the Blockchain</h1>
                    <p class="hero-subtitle">A University Platform for Recording Verifying Graduation Projects & Research with Blockchain Technology</p>
                    <button class="btn btn-hero">Submit Now</button>
                </div>
                
                <!-- Mobile mockup -->
                <div class="hero-mockup fade-in-up delay-600">
                    <div class="phone">
                        <div class="phone-screen">
                            <div class="phone-header">
                                <div class="phone-logo">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <span class="phone-title">Damietta IP Portal</span>
                            </div>
                            <div class="phone-content">
                                <h2>Secure Your Intellectual Work on the Blockchain</h2>
                                <p>A University Platform for Recording and Verifying Graduation Projects Research with Blockchain Technology</p>
                                <button class="btn btn-small">Submit Now</button>
                            </div>
                            <div class="phone-features">
                                <div class="phone-feature">
                                    <div class="phone-feature-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="phone-feature-text">Blockchain-Based Certification</div>
                                </div>
                                <div class="phone-feature">
                                    <div class="phone-feature-icon">
                                        <i class="fas fa-file-check"></i>
                                    </div>
                                    <div class="phone-feature-text">Tamper-Proof Digital Fingerprint</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- University Community Slider Section -->
    <section class="slider-section">
        <div class="container">
            <div class="section-header fade-in-on-scroll">
                <h2>Our University Community</h2>
                <p>Empowering students and faculty with cutting-edge blockchain technology for intellectual property protection</p>
            </div>

            <div class="slider-container fade-in-on-scroll delay-300">
                <div class="slider">
                    <div class="slide active">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop&crop=faces" alt="Students Collaborating">
                        <div class="slide-overlay">
                            <div class="slide-content">
                                <h3>Students Collaborating on Research Projects</h3>
                                <p>University students working together on innovative blockchain research</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&h=600&fit=crop&crop=faces" alt="Programming Future">
                        <div class="slide-overlay">
                            <div class="slide-content">
                                <h3>Programming the Future</h3>
                                <p>Computer science students developing secure IP protection solutions</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop&crop=faces" alt="Expert Faculty">
                        <div class="slide-overlay">
                            <div class="slide-content">
                                <h3>Expert Faculty Guidance</h3>
                                <p>Experienced professors leading blockchain technology research</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&h=600&fit=crop&crop=faces" alt="Innovation Research">
                        <div class="slide-overlay">
                            <div class="slide-content">
                                <h3>Innovation in Academic Research</h3>
                                <p>Faculty members pioneering intellectual property protection methods</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation arrows -->
                <button class="slider-btn slider-prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-btn slider-next">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Dots indicator -->
                <div class="slider-dots">
                    <span class="dot active" data-slide="0"></span>
                    <span class="dot" data-slide="1"></span>
                    <span class="dot" data-slide="2"></span>
                    <span class="dot" data-slide="3"></span>
                </div>

                <!-- Auto-play control -->
                <div class="auto-play-control">
                    <button class="auto-play-btn active">Auto-playing</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section fade-in-on-scroll">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item count-up">
                    <div class="stat-number" data-target="1200">0</div>
                    <div class="stat-label">Projects Protected</div>
                </div>
                <div class="stat-item count-up delay-200">
                    <div class="stat-number" data-target="45">0</div>
                    <div class="stat-label">University Partners</div>
                </div>
                <div class="stat-item count-up delay-400">
                    <div class="stat-number" data-target="8500">0</div>
                    <div class="stat-label">Students Served</div>
                </div>
                <div class="stat-item count-up delay-600">
                    <div class="stat-number" data-target="99.9">0</div>
                    <div class="stat-label">Security Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Blockchain-Based Certification</h3>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-check"></i>
                    </div>
                    <h3>Tamper-Proof Digital Fingerprint</h3>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Decentralized, Transparent Record</h3>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Easy Access to Document History</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="process-section fade-in-on-scroll">
        <div class="container">
            <div class="section-header">
                <h2>How It Works</h2>
                <p>Simple steps to protect your intellectual property with blockchain technology</p>
            </div>

            <div class="process-grid">
                <div class="process-card">
                    <div class="process-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3>1. Submit Your Work</h3>
                    <p>Upload your research, thesis, or project documents to our secure platform</p>
                </div>

                <div class="process-card">
                    <div class="process-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>2. Blockchain Protection</h3>
                    <p>Your work is encrypted and recorded on the blockchain for permanent protection</p>
                </div>

                <div class="process-card">
                    <div class="process-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>3. Get Certified</h3>
                    <p>Receive your tamper-proof digital certificate and share with confidence</p>
                </div>
            </div>
        </div>
    </section>
@endsection