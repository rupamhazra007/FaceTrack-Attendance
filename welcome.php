<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIMT | Smart Campus Portal</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary: #f7941d;
            --secondary: #003366;
            --accent: #007bff;
            --bg-light: #f8f9fa;
            --footer-bg: #030b26;
        }

        html { scroll-behavior: smooth; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--bg-light); overflow-x: hidden; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #e67e00; }

        /* ===== HEADER ===== */
        .header {
            background: white; padding: 15px 20px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid #ddd; position: relative; z-index: 1000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .left-logo img { width: 100px; transition: transform 0.5s; }
        .left-logo img:hover { transform: rotate(360deg); }

        .center-text { flex: 1; margin: 0 20px; text-align: left; font-family: 'Roboto', sans-serif; }
        .center-text h1 { font-size: 24px; color: var(--primary); font-weight: 900; margin-bottom: 5px; text-transform: uppercase; line-height: 1.2; }
        .center-text p { font-size: 11px; color: #000; font-weight: 700; margin: 2px 0; text-transform: uppercase; line-height: 1.4; }
        .right-logos img { height: 60px; margin-left: 10px; transition: transform 0.3s; }
        .right-logos img:hover { transform: scale(1.1); }

        /* ===== NOTICE TICKER ===== */
        .news-ticker { background: var(--secondary); color: white; padding: 10px 0; display: flex; align-items: center; }
        .news-label { background: var(--primary); padding: 8px 25px; font-weight: 700; font-size: 12px; text-transform: uppercase; margin-right: 15px; clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%); animation: pulse 2s infinite; }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }

        /* ===== HERO SECTION ===== */
        .hero {
            background: linear-gradient(135deg, #eef2f3 0%, #8e9eab 100%);
            min-height: 90vh; display: flex; justify-content: center; align-items: center;
            padding: 60px 40px; position: relative; overflow: hidden;
        }
        
        .particle { position: absolute; width: 10px; height: 10px; background: rgba(255, 140, 0, 0.3); border-radius: 50%; animation: floatUp 10s infinite linear; }
        @keyframes floatUp { 0% { bottom: -10%; opacity: 0; } 50% { opacity: 1; } 100% { bottom: 110%; opacity: 0; } }

        .hero-card {
            background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(25px);
            width: 100%; max-width: 1300px; border-radius: 30px; padding: 60px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.12);
            display: grid; grid-template-columns: 1.1fr 1fr; gap: 60px; align-items: center;
        }

        .hero-text h2 { font-size: 42px; line-height: 1.2; color: var(--secondary); margin-bottom: 25px; font-weight: 800; }
        
        .hero-desc {
            color: #444; font-size: 15px; line-height: 1.8; text-align: justify;
            margin-bottom: 30px; font-weight: 400; padding-right: 10px;
        }

        .typewriter { border-right: 3px solid var(--primary); animation: blinkCursor 0.7s infinite; }
        @keyframes blinkCursor { 50% { border-color: transparent; } }

        /* --- IMPROVED ROLE BUTTONS --- */
        .role-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px; }

        .role-btn {
            padding: 20px; border-radius: 20px; border: 1px solid rgba(0,0,0,0.05);
            background: linear-gradient(145deg, #ffffff, #f3f4f6);
            box-shadow: 5px 5px 15px rgba(0,0,0,0.05), -5px -5px 15px rgba(255,255,255,0.8);
            cursor: pointer; transition: all 0.4s ease;
            position: relative; overflow: hidden; text-align: center;
        }
        
        .role-btn h4 { font-size: 18px; font-weight: 700; color: var(--secondary); margin-top: 10px; transition: 0.3s; }
        .role-btn i { font-size: 35px; transition: 0.4s; }

        .role-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(247, 148, 29, 0.2); /* Orange Glow */
            border-color: var(--primary);
        }
        .role-btn:hover h4 { color: var(--primary); }
        .role-btn:hover i { transform: scale(1.2) rotate(5deg); }

        /* --- IMPROVED HERO IMAGE (Glass Frame) --- */
        .hero-img { 
            position: relative; width: 100%; height: auto; min-height: 450px;
            border-radius: 25px; overflow: hidden; 
            /* Double Layer Shadow for 3D effect */
            box-shadow: 
                0 20px 50px rgba(0,0,0,0.2),
                inset 0 0 0 8px rgba(255, 255, 255, 0.5); /* Glass Border */
            background: white;
            display: flex; align-items: center; justify-content: center;
            transform: perspective(1000px) rotateY(-5deg); /* Slight 3D Tilt */
            transition: 0.5s;
        }
        .hero-img:hover { transform: perspective(1000px) rotateY(0deg); }
        
        .hero-img img { 
            width: 100%; height: 100%; object-fit: cover; 
            transition: transform 1s ease;
        }
        .hero-img:hover img { transform: scale(1.08); }

        /* Action Panel */
        .action-panel {
            grid-column: span 2; background: white; padding: 25px; border-radius: 15px;
            margin-top: 20px; display: none; text-align: center; border: 1px solid #eee;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            animation: slideDown 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
        }
        @keyframes slideDown { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .go-btn {
            padding: 12px 35px; background: linear-gradient(45deg, var(--secondary), #0056b3);
            color: white; border: none; border-radius: 50px; cursor: pointer; font-weight: 700; margin-top: 10px;
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.3); transition: 0.3s;
        }
        .go-btn:hover { transform: scale(1.05); box-shadow: 0 8px 20px rgba(0, 51, 102, 0.5); }

        /* ===== LIVE COUNTER STATS ===== */
        .stats-section {
            background: white; padding: 60px 10%;
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;
            text-align: center; border-bottom: 1px solid #eee;
        }
        .stat-item { transition: 0.3s; padding: 20px; border-radius: 15px; }
        .stat-item:hover { background: #f9f9f9; transform: translateY(-10px); }
        .stat-item h2 { font-size: 45px; color: var(--primary); margin-bottom: 5px; font-weight: 800; }

        /* ===== FEATURES & GALLERY ===== */
        .f-card {
            padding: 35px; background: #fff; border-radius: 20px; transition: 0.5s;
            border: 1px solid #eee; position: relative; overflow: hidden;
        }
        .f-card:hover { transform: translateY(-15px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-color: var(--primary); }
        .f-card i { font-size: 45px; color: var(--primary); margin-bottom: 20px; }
        .f-card h3 { font-size: 20px; margin-bottom: 10px; color: var(--secondary); font-weight: 700; }
        .f-card p { font-size: 14px; line-height: 1.6; color: #555; }
        
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .g-img { overflow: hidden; border-radius: 15px; cursor: pointer; height: 220px; position: relative; }
        .g-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s; }
        .g-img:hover img { transform: scale(1.1); }
        .g-caption {
            position: absolute; bottom: 0; left: 0; width: 100%; padding: 15px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white; font-weight: 600; opacity: 0; transition: 0.3s;
        }
        .g-img:hover .g-caption { opacity: 1; }

        /* ===== FOOTER ===== */
        .footer { background: var(--footer-bg); color: white; padding: 50px 5% 20px; font-family: 'Roboto', sans-serif; }
        .footer-container { display: grid; grid-template-columns: 0.8fr 1.2fr 1.5fr; gap: 30px; margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 30px; }
        .ft-logo img { width: 120px; filter: drop-shadow(0 0 5px rgba(255,255,255,0.2)); }
        .footer h3 { font-size: 20px; font-weight: 700; color: white; margin-bottom: 15px; text-transform: capitalize; border-bottom: 2px solid white; display: inline-block; padding-bottom: 5px; }
        .ft-content p { color: #e0e0e0; font-size: 14px; margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px; line-height: 1.5; }
        .ft-content i { color: white; font-size: 16px; margin-top: 3px; }
        .phone-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .phone-grid p { margin: 2px 0; font-size: 13px; }
        .phone-grid i { font-size: 12px; transform: rotate(90deg); }
        .copyright { text-align: center; font-size: 12px; color: #888; margin-top: 10px; }

        /* Scroll Top */
        .scroll-top {
            position: fixed; bottom: 30px; right: 30px; background: var(--primary); color: white;
            width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            cursor: pointer; opacity: 0; pointer-events: none; transition: 0.4s; z-index: 999;
            box-shadow: 0 0 20px var(--primary);
        }
        .scroll-top.active { opacity: 1; pointer-events: all; bottom: 40px; }
        .scroll-top:hover { transform: rotate(360deg); }

        @media (max-width: 900px) {
            .header { flex-direction: column; text-align: center; padding: 20px; }
            .center-text { text-align: center; margin: 15px 0; }
            .hero-card { grid-template-columns: 1fr; padding: 30px; }
            .hero-desc { padding-right: 0; }
            .footer-container { grid-template-columns: 1fr; text-align: left; }
            .hero-img { height: 300px; transform: none; }
            .hero-img:hover { transform: none; }
        }
    </style>
</head>

<body>

    <div class="particle" style="left: 10%; animation-duration: 8s;"></div>
    <div class="particle" style="left: 30%; animation-duration: 12s; background: #003366;"></div>
    <div class="particle" style="left: 70%; animation-duration: 6s;"></div>
    <div class="particle" style="left: 90%; animation-duration: 10s; background: #003366;"></div>

    <header class="header" data-aos="fade-down" data-aos-duration="1000">
        <div class="left-logo"><img src="gimt.png" alt="GIMT Logo"></div>
        <div class="center-text">
            <h1>GLOBAL INSTITUTE OF MANAGEMENT & TECHNOLOGY</h1>
            <p>A UNIT OF NATIONAL CENTRE FOR DEVELOPMENT OF TECHNICAL EDUCATION</p>
            <p>APPROVED BY ALL INDIA COUNCIL FOR TECHNICAL EDUCATION</p>
            <p>AFFILIATED TO MAULANA ABUL KALAM AZAD UNIVERSITY OF TECHNOLOGY, W. B. AND WBSCT & VE & SD</p>
        </div>
        <div class="right-logos"><img src="utech.png" alt="MAKAUT"><img src="aicte.png" alt="AICTE"></div>
    </header>

    <div class="news-ticker" data-aos="fade-in">
        <div class="news-label">LATEST UPDATE</div>
        <marquee behavior="scroll" direction="left">
            📢 7th Semester Exams starting from 25th March 2026. &nbsp; | &nbsp; 
            🛑 Anti-Ragging Cell Helpline: 1800-111-2222. &nbsp; | &nbsp; 
            🎉 Annual Tech Fest "GIMT-TECH" registration open now!
        </marquee>
    </div>

    <section class="hero">
        <div class="hero-card" data-aos="zoom-in" data-aos-duration="1000">
            <div class="hero-text">
                <h2 data-aos="fade-right" data-aos-delay="200">Welcome to <br><span id="type-text" class="typewriter"></span></h2>
                
                <div class="hero-desc" data-aos="fade-up" data-aos-delay="400">
                    GIMT is one of the premier engineering colleges in West Bengal. It is based In Krishnagar, the district head-quarter of Nadia. Founded by Mr. Naresh Ch. Das, GIMT was established in the year 2009 by the trust National Centre for Development & Technical Education (NCDTE). It is affiliated to MAKAUT, Maulana Abul Kalam Azad University of Technology (formerly known as WBUT) and approved by All India Council for Technical Education (AICTE).
                    <br><br>
                    It offers undergraduate programs in 5 disciplines of engineering namely Civil, Mechanical, Electrical, Electronics and Communication and Computer Science. It also offers diploma programs in Civil Engineering and Mechanical Engineering.
                </div>
                
                <h5 style="color: #444; margin-bottom: 15px; font-weight: 700;" data-aos="fade-up" data-aos-delay="500">CONTINUE AS:</h5>
                <div class="role-grid">
                    <button class="role-btn" onclick="showPanel('student')" data-aos="flip-left" data-aos-delay="600">
                        <i class="fas fa-user-graduate" style="color: #007bff;"></i>
                        <h4>Student</h4>
                    </button>
                    <button class="role-btn" onclick="showPanel('faculty')" data-aos="flip-right" data-aos-delay="800">
                        <i class="fas fa-chalkboard-teacher" style="color: #28a745;"></i>
                        <h4>Faculty</h4>
                    </button>
                </div>

                <div id="studentPanel" class="action-panel">
                    <h3 style="color: var(--secondary);">Student Portal</h3>
                    <p style="font-size: 14px; margin: 5px 0 15px;">Access facial attendance system.</p>
                    <button class="go-btn" onclick="navigateTo('index.php')">LAUNCH SCANNER <i class="fas fa-arrow-right"></i></button>
                </div>

                <div id="facultyPanel" class="action-panel">
                    <h3 style="color: var(--secondary);">Faculty Portal</h3>
                    <p style="font-size: 14px; margin: 5px 0 15px;">Admin login required.</p>
                    <button class="go-btn" style="background: #ccc;">MAINTENANCE</button>
                </div>
            </div>

            <div class="hero-img" data-aos="fade-left" data-aos-delay="400">
                <img src="campus.png" alt="GIMT Campus">
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
            <h2 class="counter" data-target="1500">0</h2>
            <p>Active Students</p>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
            <h2 class="counter" data-target="120">0</h2>
            <p>Faculty Members</p>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
            <h2 class="counter" data-target="25">0</h2>
            <p>Years Excellence</p>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
            <h2 class="counter" data-target="5">0</h2>
            <p>Departments</p>
        </div>
    </section>

    <section style="padding: 80px 10%; background: #fff; text-align: center;">
        <h2 style="font-size: 32px; color: var(--secondary); margin-bottom: 50px; font-weight: 800;" data-aos="fade-down">Key Features</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <div class="f-card" data-aos="zoom-in-up" data-aos-delay="100">
                <i class="fas fa-fingerprint"></i>
                <h3>Zero-Touch Recognition</h3>
                <p>AI-powered biometric scanning that verifies identity in milliseconds with 99.9% accuracy.</p>
            </div>
            <div class="f-card" data-aos="zoom-in-up" data-aos-delay="200">
                <i class="fas fa-cloud-upload-alt"></i>
                <h3>Encrypted Digital Logs</h3>
                <p>Attendance data is instantly synced to a secure cloud server, accessible 24/7 from anywhere.</p>
            </div>
            <div class="f-card" data-aos="zoom-in-up" data-aos-delay="300">
                <i class="fas fa-laptop-code"></i>
                <h3>Universal Compatibility</h3>
                <p>Optimized for all devices. Whether you are on a phone, tablet, or desktop, the experience is seamless.</p>
            </div>
        </div>
    </section>

    <section style="padding: 60px 10%; background: #f8f9fa; text-align: center;">
        <h2 style="margin-bottom: 40px; color: var(--secondary); font-weight: 800;" data-aos="fade-right">Campus Infrastructure</h2>
        <div class="gallery-grid">
            <div class="g-img" data-aos="flip-left" data-aos-delay="100">
                <img src="main.png">
                <div class="g-caption">Main Building</div>
            </div>
            <div class="g-img" data-aos="flip-left" data-aos-delay="200">
                <img src="lib.png">
                <div class="g-caption">Central Library</div>
            </div>
            <div class="g-img" data-aos="flip-left" data-aos-delay="300">
                <img src="lab.png">
                <div class="g-caption">Computer Labs</div>
            </div>
            <div class="g-img" data-aos="flip-left" data-aos-delay="400">
                <img src="ground.png">
                <div class="g-caption">College Grounds</div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="ft-logo" data-aos="fade-right" data-aos-delay="100">
                <img src="gimt.png" alt="GIMT Logo">
            </div>

            <div class="ft-content" data-aos="fade-up" data-aos-delay="200">
                <h3>Location</h3>
                <p><i class="fas fa-map-marker-alt"></i> Palpara More, NH-12 (Formerly known as NH-34) Bhatjangla, Krishnagar West Bengal - 741102</p>
                <p><i class="fas fa-envelope"></i> admission@gimt-india.com</p>
                <p><i class="fas fa-envelope"></i> admissions@gimt-india.com</p>
            </div>

            <div class="ft-content" data-aos="fade-left" data-aos-delay="300">
                <h3>For Admission Query</h3>
                <div class="phone-grid">
                    <div>
                        <p><i class="fas fa-phone"></i> +91-7596056174</p>
                        <p><i class="fas fa-phone"></i> +91-9083640444</p>
                        <p><i class="fas fa-phone"></i> +91-7596056175</p>
                        <p><i class="fas fa-phone"></i> +91-7407080088</p>
                    </div>
                    <div>
                        <p><i class="fas fa-phone"></i> +91-7407095678</p>
                        <p><i class="fas fa-phone"></i> +91-8695649386</p>
                        <p><i class="fas fa-phone"></i> +91-7407132345</p>
                        <p><i class="fas fa-phone"></i> +91-7407114567</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="copyright" data-aos="zoom-in" data-aos-delay="400">
            Designed by <b>Rupam Hazra</b> | CSE 4th Year | © 2026 GIMT
        </div>
    </footer>

    <div class="scroll-top" onclick="window.scrollTo(0,0)">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 1000, once: true, offset: 100 });

        function navigateTo(url) { window.location.href = url; }

        const textElement = document.getElementById("type-text");
        const textToType = " Global Knowledge Campus";
        let index = 0;
        function type() {
            if (index < textToType.length) {
                textElement.innerHTML += textToType.charAt(index);
                index++;
                setTimeout(type, 150);
            }
        }
        setTimeout(type, 1000);

        function showPanel(role) {
            document.getElementById('studentPanel').style.display = 'none';
            document.getElementById('facultyPanel').style.display = 'none';
            if(role === 'student') document.getElementById('studentPanel').style.display = 'block';
            else document.getElementById('facultyPanel').style.display = 'block';
        }

        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            counter.innerText = '0';
            const updateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const c = +counter.innerText;
                const increment = target / 100;
                if (c < target) {
                    counter.innerText = `${Math.ceil(c + increment)}`;
                    setTimeout(updateCounter, 20);
                } else {
                    counter.innerText = target + "+";
                }
            };
            const observer = new IntersectionObserver((entries) => {
                if(entries[0].isIntersecting) {
                    updateCounter();
                    observer.disconnect();
                }
            });
            observer.observe(counter);
        });

        window.addEventListener('scroll', function() {
            const scrollBtn = document.querySelector('.scroll-top');
            if (window.scrollY > 300) scrollBtn.classList.add('active');
            else scrollBtn.classList.remove('active');
        });
    </script>

</body>
</html>