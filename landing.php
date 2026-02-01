<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecurePortal - Advanced Security Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0a0e27;
            --accent: #ff6b35;
            --secondary: #f7931e;
            --text: #e8e9ed;
            --text-dim: #9ea3b0;
            --surface: #161b33;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--primary);
            color: var(--text);
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 80px 20px;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(255,107,53,0.1) 0%, transparent 70%);
            top: -300px;
            right: -300px;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(50px, 50px) rotate(180deg); }
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(10,14,39,0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .logo-text {
            font-family: 'Crimson Pro', serif;
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 35px;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-dim);
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--text);
        }

        .cta-button {
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255,107,53,0.4);
        }

        .hero-content {
            max-width: 1200px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        h1 {
            font-family: 'Crimson Pro', serif;
            font-size: clamp(48px, 8vw, 82px);
            font-weight: 700;
            margin-bottom: 25px;
            line-height: 1.1;
            letter-spacing: -2px;
            animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 20px;
            color: var(--text-dim);
            max-width: 600px;
            margin: 0 auto 45px;
            line-height: 1.6;
            animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.4s backwards;
        }

        .primary-btn {
            padding: 16px 36px;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255,107,53,0.4);
        }

        .secondary-btn {
            padding: 16px 36px;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .secondary-btn:hover {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.3);
        }

        /* Features Section */
        .features {
            padding: 120px 50px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-family: 'Crimson Pro', serif;
            font-size: 48px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: var(--surface);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255,107,53,0.3);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 25px;
        }

        .feature-card h3 {
            font-family: 'Crimson Pro', serif;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: var(--text-dim);
            line-height: 1.7;
        }

        /* Footer */
        footer {
            padding: 50px;
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.05);
            color: var(--text-dim);
        }

        @media (max-width: 768px) {
            nav {
                padding: 15px 20px;
            }

            .nav-links {
                gap: 20px;
            }

            .hero {
                padding: 60px 20px;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .features {
                padding: 80px 20px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-text">SecurePortal</div>
        <div class="nav-links">
            <a href="#features">Features</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>

            <!-- Updated: login.html -> login.php -->
            <a href="login.php" class="cta-button">Login</a>

            <!-- Optional: logout button -->
            <a href="logout.php" class="cta-button">Logout</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Advanced Security <br><span class="gradient-text">Made Simple</span></h1>
            <p>Protect your digital assets with enterprise-grade security solutions designed for the modern world.</p>
            <div class="hero-buttons">
                <a href="#" class="primary-btn">Get Started</a>
                <a href="#features" class="secondary-btn">Learn More</a>
            </div>
        </div>
    </section>

    <!-- groupctf{s0urc3_c0d3_1s_y0ur_fr13nd_k33p_s3arch1ng} -->

    <section id="features" class="features">
        <h2 class="section-title">Powerful Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>End-to-End Encryption</h3>
                <p>Your data is protected with military-grade encryption algorithms, ensuring complete privacy and security.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Real-Time Monitoring</h3>
                <p>Stay ahead of threats with our 24/7 monitoring system that detects and responds to security incidents instantly.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛡️</div>
                <h3>Advanced Threat Protection</h3>
                <p>Utilize AI-powered security measures to defend against the latest cyber threats and vulnerabilities.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 SecurePortal. All rights reserved.</p>
    </footer>

    <script>
        // Smooth scrolling for anchor links
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
    </script>
</body>
</html>
