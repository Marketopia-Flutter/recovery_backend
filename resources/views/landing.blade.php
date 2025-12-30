<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softeks - Professional WhatsApp Messaging Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Header & Navigation */
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            padding: 150px 20px 100px;
            text-align: center;
            margin-top: 70px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 900;
            animation: fadeInUp 1s ease;
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            opacity: 0.95;
            animation: fadeInUp 1s ease 0.2s;
            animation-fill-mode: both;
        }

        .cta-button {
            display: inline-block;
            background: white;
            color: #1e3a8a;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease 0.4s;
            animation-fill-mode: both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Features Section */
        .features {
            padding: 80px 20px;
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
            font-weight: 700;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333;
        }

        .feature-card p {
            color: #666;
            line-height: 1.8;
        }

        /* Pricing Section */
        .pricing {
            padding: 80px 20px;
            background: white;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            border: 2px solid #f0f0f0;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.featured {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            transform: scale(1.02);
            border: none;
        }

        .pricing-card.featured:hover {
            transform: scale(1.02) translateY(-10px);
        }

        .pricing-card.featured .price {
            color: white;
        }

        .pricing-card.featured .feature-list li {
            color: white;
        }

        .plan-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .price {
            font-size: 3rem;
            font-weight: 900;
            color: #1e3a8a;
            margin: 20px 0;
        }

        .price span {
            font-size: 1.2rem;
            font-weight: 400;
        }

        .feature-list {
            list-style: none;
            margin: 30px 0;
            text-align: left;
            flex-grow: 1;
        }

        .feature-list li {
            padding: 12px 0;
            color: #666;
            border-bottom: 1px solid #f0f0f0;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list i {
            color: #25D366;
            margin-right: 10px;
        }

        .pricing-card.featured .feature-list i {
            color: #fff;
        }

        .buy-button {
            display: inline-block;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s;
            margin-top: auto;
            margin-bottom: 0;
        }

        .pricing-card.featured .buy-button {
            background: white;
            color: #1e3a8a;
        }

        .buy-button:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        /* About Section */
        .about {
            padding: 80px 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .about-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .about-content p {
            font-size: 1.2rem;
            line-height: 2;
            color: #555;
            margin-bottom: 20px;
        }

        .company-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #666;
        }

        /* Documentation Section */
        .documentation {
            padding: 80px 20px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            position: relative;
        }

        .documentation .section-title {
            color: white;
        }

        .documentation .section-subtitle {
            color: #cbd5e1;
        }

        .api-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .api-card {
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .api-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .api-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 25px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .api-header h3 {
            color: white;
            font-size: 1.5rem;
            margin: 0;
            font-weight: 700;
        }

        .api-method {
            display: inline-block;
            background: white;
            color: #1e3a8a;
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .api-method.get {
            background: #10b981;
            color: white;
        }

        .api-body {
            padding: 30px;
        }

        .api-description {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .api-endpoint {
            font-family: 'Courier New', monospace;
            background: #f1f5f9;
            padding: 15px 20px;
            border-radius: 10px;
            margin: 20px 0;
            font-size: 0.95rem;
            color: #1e40af;
            border-left: 4px solid #1e3a8a;
            font-weight: 600;
            word-break: break-all;
        }

        .api-params {
            margin-top: 25px;
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
        }

        .api-params h4 {
            color: #1e3a8a;
            font-size: 1.1rem;
            margin-bottom: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .api-params h4::before {
            content: "⚙️";
            font-size: 1.2rem;
        }

        .api-params ul {
            list-style: none;
            padding-left: 0;
        }

        .api-params li {
            padding: 10px 0;
            color: #475569;
            font-size: 0.95rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: start;
            gap: 8px;
        }

        .api-params li:last-child {
            border-bottom: none;
        }

        .api-params li::before {
            content: "▸";
            color: #1e3a8a;
            font-weight: bold;
            margin-top: 2px;
        }

        .api-params code {
            background: #e0e7ff;
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            color: #1e40af;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        /* Contact Section */
        .contact {
            padding: 80px 20px;
            background: white;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-card {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 15px;
            transition: all 0.3s;
            overflow: hidden;
        }

        .contact-card:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            transform: translateY(-5px);
        }

        .contact-card i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #1e3a8a;
        }

        .contact-card:hover i {
            color: white;
        }

        .contact-card h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .contact-card p {
            font-size: 1rem;
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .contact-card a {
            color: inherit;
            text-decoration: none;
        }

        /* Footer */
        .footer {
            background: #1e293b;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            color: white;
            font-size: 1.8rem;
            margin: 0 15px;
            transition: all 0.3s;
        }

        .social-links a:hover {
            color: #3b82f6;
            transform: scale(1.2);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .nav-links {
                display: none;
            }

            .section-title {
                font-size: 2rem;
            }

            .pricing-card.featured {
                transform: scale(1);
            }
        }

        /* WhatsApp Float Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 5px 20px rgba(37, 211, 102, 0.5);
            cursor: pointer;
            transition: all 0.3s;
            z-index: 999;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.7);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <div class="logo">
                <span>Softeks</span>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#documentation">API Docs</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <h1>Welcome to Softeks</h1>
            <p>Professional platform for secure bulk WhatsApp messaging</p>
            <a href="#pricing" class="cta-button">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2 class="section-title">Our Premium Features</h2>
            <p class="section-subtitle">We provide the best solutions for WhatsApp messaging</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Fast Delivery</h3>
                    <p>Send thousands of messages in minutes with guaranteed secure and highly effective delivery</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Security & Protection</h3>
                    <p>Advanced system to protect your data and ensure customer information privacy with the highest
                        security standards</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Detailed Reports</h3>
                    <p>Get comprehensive reports on message status, delivery rates, and engagement metrics</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Complete API</h3>
                    <p>Easy-to-use programming interface for seamless integration with your existing systems</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3>Smart Wallet System</h3>
                    <p>Advanced financial management with easy deposit system and accurate transaction tracking</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Technical support team available around the clock to help you and solve any issues you may face
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="container">
            <h2 class="section-title">Our Services Pricing</h2>
            <p class="section-subtitle">Pay-as-you-go for each service - No monthly subscriptions</p>

            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3 class="plan-name">WhatsApp Messaging</h3>
                    <div class="price">{{ number_format($sendMessagePrice, 2) }} EGP<span>/message</span></div>

                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Send bulk messages</li>
                        <li><i class="fas fa-check"></i> Marketing campaigns</li>
                        <li><i class="fas fa-check"></i> Customer notifications</li>
                        <li><i class="fas fa-check"></i> Text & media support</li>
                        <li><i class="fas fa-check"></i> Real-time delivery status</li>
                        <li><i class="fas fa-check"></i> API integration</li>
                        <li><i class="fas fa-check"></i> Detailed reports</li>
                    </ul>
                    <a href="#contact" class="buy-button">Get Started</a>
                </div>

                <div class="pricing-card featured">
                    <h3 class="plan-name">OTP Send Service</h3>
                    <div class="price">{{ number_format($otpSendPrice, 2) }} EGP<span>/OTP</span></div>

                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Secure OTP delivery</li>
                        <li><i class="fas fa-check"></i> User verification</li>
                        <li><i class="fas fa-check"></i> Fast delivery (seconds)</li>
                        <li><i class="fas fa-check"></i> High reliability</li>
                        <li><i class="fas fa-check"></i> Custom OTP templates</li>
                        <li><i class="fas fa-check"></i> API integration</li>
                        <li><i class="fas fa-check"></i> Delivery tracking</li>
                        <li><i class="fas fa-check"></i> 24/7 support</li>
                    </ul>
                    <a href="#contact" class="buy-button">Most Popular</a>
                </div>

                <div class="pricing-card">
                    <h3 class="plan-name">OTP Receive Service</h3>
                    <div class="price">{{ number_format($otpReceivePrice, 2) }} EGP<span>/OTP</span></div>

                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Receive & verify OTP</li>
                        <li><i class="fas fa-check"></i> Two-way authentication</li>
                        <li><i class="fas fa-check"></i> Automatic validation</li>
                        <li><i class="fas fa-check"></i> Webhook support</li>
                        <li><i class="fas fa-check"></i> Real-time responses</li>
                        <li><i class="fas fa-check"></i> API integration</li>
                        <li><i class="fas fa-check"></i> Secure processing</li>
                    </ul>
                    <a href="#contact" class="buy-button">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Documentation Section -->
    <section id="documentation" class="documentation">
        <div class="container">
            <h2 class="section-title">API Documentation</h2>
            <p class="section-subtitle">Easy integration with our RESTful API</p>

            <div class="api-grid">
                <!-- Send Message -->
                <div class="api-card">
                    <div class="api-header">
                        <h3>Send Message</h3>
                        <span class="api-method">POST</span>
                    </div>
                    <div class="api-body">
                        <p class="api-description">Send WhatsApp messages to any phone number instantly with full
                            delivery tracking</p>
                        <div class="api-endpoint">POST /api/send-message</div>
                        <div class="api-params">
                            <h4>Parameters</h4>
                            <ul>
                                <li><code>api_key</code> Your API key (required)</li>
                                <li><code>phone</code> Phone number with country code (required)</li>
                                <li><code>message</code> Message content (required)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Send OTP -->
                <div class="api-card">
                    <div class="api-header">
                        <h3>Send OTP</h3>
                        <span class="api-method">POST</span>
                    </div>
                    <div class="api-body">
                        <p class="api-description">Send one-time password for secure user verification via WhatsApp</p>
                        <div class="api-endpoint">POST /api/send-otp</div>
                        <div class="api-params">
                            <h4>Parameters</h4>
                            <ul>
                                <li><code>api_key</code> Your API key (required)</li>
                                <li><code>phone</code> Phone number with country code (required)</li>
                                <li><code>otp_length</code> OTP code length (default: 6)</li>
                                <li><code>expiry_minutes</code> Expiration time in minutes</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Verify OTP -->
                <div class="api-card">
                    <div class="api-header">
                        <h3>Verify OTP</h3>
                        <span class="api-method">POST</span>
                    </div>
                    <div class="api-body">
                        <p class="api-description">Verify the OTP code sent to user and validate authentication</p>
                        <div class="api-endpoint">POST /api/verify-otp</div>
                        <div class="api-params">
                            <h4>Parameters</h4>
                            <ul>
                                <li><code>api_key</code> Your API key (required)</li>
                                <li><code>phone</code> Phone number with country code (required)</li>
                                <li><code>otp_code</code> OTP code to verify (required)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Create OTP -->
                <div class="api-card">
                    <div class="api-header">
                        <h3>Create OTP</h3>
                        <span class="api-method">POST</span>
                    </div>
                    <div class="api-body">
                        <p class="api-description">Create OTP session and wait for user to send verification code</p>
                        <div class="api-endpoint">POST /api/create-otp</div>
                        <div class="api-params">
                            <h4>Parameters</h4>
                            <ul>
                                <li><code>api_key</code> Your API key (required)</li>
                                <li><code>phone</code> Phone number with country code (required)</li>
                                <li><code>otp_length</code> OTP code length (default: 6)</li>
                                <li><code>expiry_minutes</code> Expiration time in minutes</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Check OTP Status -->
                <div class="api-card">
                    <div class="api-header">
                        <h3>Check OTP Status</h3>
                        <span class="api-method get">GET</span>
                    </div>
                    <div class="api-body">
                        <p class="api-description">Check if OTP has been received from user and get its status</p>
                        <div class="api-endpoint">GET /api/check-otp-status</div>
                        <div class="api-params">
                            <h4>Parameters</h4>
                            <ul>
                                <li><code>api_key</code> Your API key (required)</li>
                                <li><code>phone</code> Phone number with country code (required)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title">About Softeks</h2>
            <div class="about-content">
                <p>
                    Softeks is a leader in providing digital communication solutions and marketing via WhatsApp.
                    We believe that effective communication is the foundation of any business success, which is why we
                    provide
                    professional tools that help companies reach their customers quickly, securely, and effectively.
                </p>
                <p>
                    With extensive experience in developing software systems and technical solutions, we provide
                    distinguished
                    services that meet the needs of all business sizes from startups to large enterprises.
                </p>

                <div class="company-stats">
                    <div class="stat-card">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">5M+</div>
                        <div class="stat-label">Messages Sent</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Delivery Rate</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <p class="section-subtitle">We're here to help you anytime</p>

            <div class="contact-grid">
                <div class="contact-card">
                    <i class="fas fa-phone"></i>
                    <h3>Phone</h3>
                    <p><a href="tel:+201273308123">+20 127 330 8123</a></p>
                </div>

                <div class="contact-card">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p style="font-size: 0.85rem;"><a
                            href="mailto:moamen.rabee.dev@gmail.com">moamen.rabee.dev@gmail.com</a></p>
                </div>

                <div class="contact-card">
                    <i class="fab fa-whatsapp"></i>
                    <h3>WhatsApp</h3>
                    <p><a href="https://wa.me/201273308123">+20 127 330 8123</a></p>
                </div>

                <div class="contact-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Location</h3>
                    <p>Alexandria, Egypt</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="logo" style="justify-content: center; margin-bottom: 20px;">
                <span>Softeks</span>
            </div>
            <p>© 2025 Softeks. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/201273308123" target="_blank" class="whatsapp-float">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        // Smooth scrolling for navigation links
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

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .pricing-card, .contact-card, .stat-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>