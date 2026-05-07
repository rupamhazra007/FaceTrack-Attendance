<?php
// Student Data Matrix
$student = [
    'name' => 'Rupam Hazra',
    'roll' => '25900122005',
    'reg' => '222590110020 of 2022-23',
    'dob' => '02 OCT, 2003',
    'photo' => 'Rup.jpeg', // প্রোফাইল পিকচার Rup.jpeg সেট করা হয়েছে
    'course' => 'B.Tech (Bachelor of Technology)',
    'dept' => 'Computer Science & Engineering',
    'year_sem' => '4th Year / 8th Semester',
    'session' => '2022-2026',
    'university' => 'MAKAUT, West Bengal',
    'college' => 'Global Institute of Management & Technology',
    'college_code' => '259',
    'campus' => 'Main Knowledge Campus',
    'clg_address' => 'Palpara More, NH-12, Bhatjangla, Krishnagar, Nadia, WB - 741102',
    'email' => 'hazrarupam222@gmail.com',
    'mobile' => '+91 9091349451',
    'emergency' => '+91 9091349451',
    'student_id' => 'GIMT2026CSE05',
    'face_reg' => 'Yes',
    'status' => 'Active'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile | GIMT Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary: #f7941d;
            --secondary: #003366;
            --bg-canvas: #f0f2f5;
            --card-bg: rgba(255, 255, 255, 0.95);
            --footer-bg: #030b26;
        }

        html { scroll-behavior: smooth; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        
        body { 
            /* Background Image gm.jpg added with dark overlay */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('gm.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #1e293b; 
            overflow-x: hidden; 
        }

        /* ===== HEADER (UNTOUCHED) ===== */
        .header {
            background: white; padding: 15px 20px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid #ddd; position: relative; z-index: 1000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .left-logo img { width: 100px; }
        .center-text { flex: 1; margin: 0 20px; text-align: left; font-family: 'Roboto', sans-serif; }
        .center-text h1 { font-size: 24px; color: var(--primary); font-weight: 900; margin-bottom: 5px; text-transform: uppercase; line-height: 1.2; }
        .center-text p { font-size: 11px; color: #000; font-weight: 700; margin: 2px 0; text-transform: uppercase; line-height: 1.4; }
        .right-logos img { height: 60px; margin-left: 10px; }

        /* ===== DASHBOARD WRAPPER ===== */
        .dashboard-container {
            padding: 40px 5%;
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 30px;
            min-height: 100vh;
        }

        /* LEFT SIDEBAR */
        .profile-side {
            background: var(--card-bg);
            border-radius: 25px;
            padding: 40px 25px;
            text-align: center;
            height: fit-content;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            border: 1px solid white;
            position: sticky; top: 20px;
        }

        .img-ring {
            width: 140px; height: 140px;
            margin: 0 auto 20px;
            padding: 5px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 10px 20px rgba(247, 148, 29, 0.2);
        }
        .img-ring img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 4px solid white; }

        .name-tag h2 { font-size: 22px; color: var(--secondary); font-weight: 800; margin-bottom: 5px; }
        .name-tag p { font-size: 12px; color: #64748b; font-weight: 700; letter-spacing: 1px; margin-bottom: 25px; }

        .nav-stack { display: flex; flex-direction: column; gap: 12px; }
        .n-btn {
            text-decoration: none; display: flex; align-items: center; gap: 12px;
            padding: 15px 20px; border-radius: 15px; font-weight: 700; font-size: 14px;
            transition: 0.3s; border: 1px solid transparent;
        }
        .btn-id { background: #eff6ff; color: #1d4ed8; }
        .btn-mark { background: var(--primary); color: white; box-shadow: 0 8px 15px rgba(247, 148, 29, 0.2); }
        .btn-home { background: var(--secondary); color: white; }
        .btn-out { background: #fff1f2; color: #be123c; border-color: #fecaca; }

        .n-btn:hover { transform: translateX(8px); filter: brightness(0.95); }

        /* RIGHT CONTENT AREA */
        .main-content { display: flex; flex-direction: column; gap: 30px; }

        .card-panel {
            background: rgba(255, 255, 255, 0.92); border-radius: 25px; padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;
        }

        .panel-head {
            display: flex; align-items: center; gap: 15px; margin-bottom: 25px;
            border-bottom: 2px solid #f8fafc; padding-bottom: 15px;
        }
        .panel-head i { font-size: 20px; color: var(--primary); }
        .panel-head h3 { font-size: 18px; font-weight: 800; color: var(--secondary); text-transform: uppercase; letter-spacing: 0.5px; }

        .details-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; }
        .data-cell { position: relative; padding-left: 15px; border-left: 3px solid #e2e8f0; transition: 0.3s; }
        .data-cell:hover { border-color: var(--primary); }
        .data-cell label { display: block; font-size: 11px; color: #94a3b8; font-weight: 800; text-transform: uppercase; margin-bottom: 5px; }
        .data-cell span { font-size: 15px; font-weight: 700; color: #334155; }

        .pill { padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 800; }
        .pill-green { background: #dcfce7; color: #15803d; }

        /* ANIMATED LOCATION SECTION */
        .location-floating {
            background: linear-gradient(135deg, rgba(3, 11, 38, 0.9), rgba(30, 41, 59, 0.9));
            border-radius: 25px; padding: 30px; color: white;
            position: relative; overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            animation: floatUI 4s ease-in-out infinite;
        }
        @keyframes floatUI { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }

        .location-floating h4 { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; font-size: 18px; }
        .location-floating p { font-size: 14px; opacity: 0.8; line-height: 1.6; max-width: 80%; }
        .map-icon-bg { position: absolute; right: -20px; bottom: -20px; font-size: 120px; opacity: 0.05; transform: rotate(-15deg); }

        /* ===== FOOTER ===== */
        .footer { background: var(--footer-bg); color: white; padding: 50px 5% 20px; font-family: 'Roboto', sans-serif; }
        .footer-container { display: grid; grid-template-columns: 0.8fr 1.2fr 1.5fr; gap: 30px; margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 30px; }
        .ft-logo img { width: 120px; filter: drop-shadow(0 0 5px rgba(255,255,255,0.2)); }
        .footer h3 { font-size: 20px; font-weight: 700; color: white; margin-bottom: 15px; }
        .ft-content p { color: #e0e0e0; font-size: 14px; margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px; }
        .phone-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .copyright { text-align: center; font-size: 12px; color: #888; margin-top: 10px; }

        @media (max-width: 1024px) {
            .dashboard-container { grid-template-columns: 1fr; }
            .profile-side { position: relative; top: 0; width: 100%; }
            .details-grid { grid-template-columns: 1fr; }
            .header { flex-direction: column; text-align: center; }
            .footer-container { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

    <header class="header animate__animated animate__fadeInDown">
        <div class="left-logo"><img src="gimt.png" alt="GIMT Logo"></div>
        <div class="center-text">
            <h1>GLOBAL INSTITUTE OF MANAGEMENT & TECHNOLOGY</h1>
            <p>A UNIT OF NATIONAL CENTRE FOR DEVELOPMENT OF TECHNICAL EDUCATION</p>
            <p>APPROVED BY ALL INDIA COUNCIL FOR TECHNICAL EDUCATION</p>
            <p>AFFILIATED TO MAULANA ABUL KALAM AZAD UNIVERSITY OF TECHNOLOGY, W. B. AND WBSCT & VE & SD</p>
        </div>
        <div class="right-logos"><img src="utech.png" alt="MAKAUT"><img src="aicte.png" alt="AICTE"></div>
    </header>

    <main class="dashboard-container">
        
        <aside class="profile-side animate__animated animate__fadeInLeft">
            <div class="img-ring">
                <img src="<?php echo $student['photo']; ?>" alt="Rupam Hazra">
            </div>
            <div class="name-tag">
                <h2><?php echo $student['name']; ?></h2>
                <p>STUDENT ID: <?php echo $student['student_id']; ?></p>
            </div>

            <nav class="nav-stack">
                <a href="id.php" class="n-btn btn-id"><i class="fas fa-id-card-clip"></i> Digital ID Card</a>
                <a href="index.php" class="n-btn btn-mark"><i class="fas fa-camera-retro"></i> Mark Attendance</a>
                <a href="welcome.php" class="n-btn btn-home"><i class="fas fa-grid-2"></i> Dashboard Home</a>
                <a href="welcome.php" class="n-btn btn-out"><i class="fas fa-power-off"></i> Logout Session</a>
            </nav>
        </aside>

        <div class="main-content">
            
            <section class="card-panel" data-aos="fade-up">
                <div class="panel-head">
                    <i class="fas fa-user-circle"></i>
                    <h3>Personal & Academic Details</h3>
                </div>
                <div class="details-grid">
                    <div class="data-cell"><label>Full Name</label><span><?php echo $student['name']; ?></span></div>
                    <div class="data-cell"><label>Roll Number</label><span><?php echo $student['roll']; ?></span></div>
                    <div class="data-cell"><label>Registration No</label><span><?php echo $student['reg']; ?></span></div>
                    <div class="data-cell"><label>Date of Birth</label><span><?php echo $student['dob']; ?></span></div>
                    <div class="data-cell"><label>Course</label><span><?php echo $student['course']; ?></span></div>
                    <div class="data-cell"><label>Year / Semester</label><span><?php echo $student['year_sem']; ?></span></div>
                    <div class="data-cell" style="grid-column: span 2;"><label>Department</label><span><?php echo $student['dept']; ?></span></div>
                </div>
            </section>

            <section class="card-panel" data-aos="fade-up" data-aos-delay="100">
                <div class="panel-head">
                    <i class="fas fa-building-columns"></i>
                    <h3>Institute & System Identity</h3>
                </div>
                <div class="details-grid">
                    <div class="data-cell"><label>Institution</label><span><?php echo $student['college']; ?></span></div>
                    <div class="data-cell"><label>College Code</label><span><?php echo $student['college_code']; ?></span></div>
                    <div class="data-cell"><label>Face Registered</label><span style="color:#10b981"><i class="fas fa-circle-check"></i> <?php echo $student['face_reg']; ?></span></div>
                    <div class="data-cell"><label>Account Status</label><span class="pill pill-green"><?php echo $student['status']; ?></span></div>
                </div>
            </section>

            <section class="card-panel" data-aos="fade-up" data-aos-delay="200">
                <div class="panel-head">
                    <i class="fas fa-address-book"></i>
                    <h3>Contact Information</h3>
                </div>
                <div class="details-grid">
                    <div class="data-cell"><label>Email ID</label><span><?php echo $student['email']; ?></span></div>
                    <div class="data-cell"><label>Mobile Number</label><span><?php echo $student['mobile']; ?></span></div>
                    <div class="data-cell" style="grid-column: span 2;"><label>Emergency Contact</label><span><?php echo $student['emergency']; ?> (Primary)</span></div>
                </div>
            </section>

            <div class="location-floating" data-aos="fade-up" data-aos-duration="1200" data-aos-offset="100">
                <i class="fas fa-location-dot map-icon-bg"></i>
                <h4><i class="fas fa-map-marked-alt" style="color:var(--primary)"></i> Campus Location</h4>
                <p>
                    <b>GIMT - Global Knowledge Campus</b><br>
                    Palpara More, NH-12 (Formerly known as NH-34) Bhatjangla, Krishnagar West Bengal - 741102<br>
                    <small>Modern infrastructure located in the heart of Nadia District, West Bengal.</small>
                </p>
            </div>

        </div>
    </main>

    <footer class="footer" style="overflow: hidden;">
        <div class="footer-container" 
             data-aos="fade-up" 
             data-aos-duration="1200" 
             data-aos-once="false">
             
            <div class="ft-logo"><img src="gimt.png" alt="GIMT Logo"></div>
            
            <div class="ft-content">
                <h3 style="color: var(--primary); border-bottom: 2px solid var(--primary); display: inline-block; padding-bottom: 5px; margin-bottom: 15px;">Campus Location</h3>
                <p><i class="fas fa-map-marker-alt" style="color: var(--primary);"></i> Palpara More, NH-12, Bhatjangla, Krishnagar, Nadia, WB - 741102</p>
                <p><i class="fas fa-envelope" style="color: var(--primary);"></i> admission@gimt-india.com</p>
                <p><i class="fas fa-envelope" style="color: var(--primary);"></i> admissions@gimt-india.com</p>
            </div>

            <div class="ft-content">
                <h3 style="color: var(--primary); border-bottom: 2px solid var(--primary); display: inline-block; padding-bottom: 5px; margin-bottom: 15px;">Admission Query</h3>
                <div class="phone-grid">
                    <div>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-7596056174</p>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-9083640444</p>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-7596056175</p>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-7407080088</p>
                    </div>
                    <div>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-7407095678</p>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-8695649386</p>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-7407132345</p>
                        <p><i class="fas fa-phone-alt" style="font-size: 12px; color: var(--primary);"></i> +91-7407114567</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright" style="text-align: center; margin-top: 30px; opacity: 0.6;">
            Designed by <b>Rupam Hazra</b> | CSE 4th Year | © 2026 GIMT
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ 
                duration: 1000, 
                once: false,      // স্ক্রল করলে বারবার এনিমেশন হবে
                mirror: true,     // উপরে স্ক্রল করলেও কাজ করবে
                offset: 50,       // স্ক্রিনের কত কাছে আসলে শুরু হবে
                easing: 'ease-in-out'
            });
        });
    </script>
</body>
</html>