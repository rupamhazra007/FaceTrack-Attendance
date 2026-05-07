<?php
// Student Data Matrix
$student = [
    'name' => 'Rupam Hazra',
    'roll' => '25900122005',
    'student_id' => 'GIMT2026CSE05',
    'dept' => 'Computer Science & Engineering',
    'year' => '4th Year',
    'session' => '2022-2026',
    'photo' => 'Rup.jpeg', // আপনার দেওয়া ইমেজ ফাইল নেম সেট করা হয়েছে
    'last_attendance' => '16 Feb, 2026',
    'valid_till' => '2026'
];

// Attendance Logic
$total = 120;
$present = 110;
$percent = round(($present / $total) * 100);
$status = ($percent >= 75) ? "Eligible ✅" : "Short Attendance ⚠️";
$status_color = ($percent >= 75) ? "#10b981" : "#ef4444";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium ID Card | GIMT</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Roboto:wght@400;700;900&family=Libre+Barcode+128&family=Mr+Dafoe&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #f7941d;
            --secondary: #003366;
            --glass: rgba(255, 255, 255, 0.12);
            --card-w: 380px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        
        body { 
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('gm.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
        }

        /* ===== OFFICIAL HEADER (EXACT MATCH) ===== */
        .header {
            background: white; width: 100%; padding: 15px 40px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 5px solid var(--primary); box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            position: relative; z-index: 100;
        }
        .left-logo img { width: 100px; }
        .center-text { flex: 1; margin: 0 30px; text-align: left; font-family: 'Roboto', sans-serif; }
        .center-text h1 { font-size: 24px; color: var(--primary); font-weight: 900; text-transform: uppercase; line-height: 1.2; }
        .center-text p { font-size: 11px; color: #000; font-weight: 700; text-transform: uppercase; line-height: 1.4; }
        .right-logos img { height: 60px; margin-left: 10px; }

        /* ===== ID CARD DESIGN ===== */
        .id-wrapper { margin: 50px 0; perspective: 1500px; }

        .id-card {
            width: var(--card-w);
            background: var(--glass);
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            border-radius: 35px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 50px 100px rgba(0,0,0,0.8);
            color: white;
            overflow: hidden;
            position: relative;
            transform-style: preserve-3d;
            animation: flipInX 1.2s ease-out;
        }

        .card-inner-header {
            background: rgba(0, 51, 102, 0.5);
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .clg-title { font-size: 13px; font-weight: 800; letter-spacing: 1.5px; color: var(--primary); text-transform: uppercase; }

        .card-body { padding: 35px 30px; text-align: center; }

        /* Glowing Photo Container */
        .photo-container {
            width: 160px; height: 160px; margin: 0 auto 25px;
            border-radius: 25px; padding: 6px;
            background: linear-gradient(45deg, var(--primary), #fff, var(--secondary));
            box-shadow: 0 0 30px rgba(247, 148, 29, 0.4);
            position: relative;
            transition: 0.5s;
        }
        .photo-container:hover { transform: scale(1.05) rotate(2deg); box-shadow: 0 0 50px rgba(247, 148, 29, 0.6); }
        
        .photo-container img { 
            width: 100%; height: 100%; border-radius: 20px; 
            object-fit: cover; border: 2px solid rgba(0,0,0,0.1); 
        }
        
        .st-name { font-size: 28px; font-weight: 800; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .st-dept { font-size: 13px; font-weight: 700; color: #cbd5e1; margin-bottom: 30px; display: block; }

        .data-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .data-label { font-size: 10px; font-weight: 800; color: var(--primary); text-transform: uppercase; }
        .data-val { font-size: 14px; font-weight: 700; }

        /* Modern Stats Box */
        .att-box {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 22px; padding: 20px;
            margin-top: 20px; border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .att-stats { display: flex; justify-content: space-around; margin-bottom: 15px; }
        .stat-val { font-size: 22px; font-weight: 800; display: block; }
        .stat-lab { font-size: 9px; font-weight: 700; color: #94a3b8; text-transform: uppercase; }
        
        .progress-container { width: 100%; height: 10px; background: rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 10px; transition: 2.5s cubic-bezier(0.17, 0.67, 0.83, 0.67); width: 0; }

        /* Security Elements */
        .card-footer {
            padding: 25px; background: rgba(0,0,0,0.3);
            display: flex; justify-content: space-between; align-items: center;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .qr-sec img { width: 75px; background: white; padding: 6px; border-radius: 12px; transition: 0.5s; }
        
        .bar-sec { text-align: right; }
        .barcode { font-family: 'Libre Barcode 128', cursive; font-size: 45px; color: #fff; line-height: 1; opacity: 0.8; }

        /* BACK SIDE STYLING */
        .back-card {
            width: var(--card-w); background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(30px); border-radius: 35px;
            padding: 40px; border: 1px solid rgba(255, 255, 255, 0.25);
            margin-top: 30px; color: white;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        }
        .signature-box { margin-top: 30px; text-align: right; }
        .sig-font { font-family: 'Mr Dafoe', cursive; font-size: 48px; color: #fff; margin-bottom: -15px; }

        /* Button Layout */
        .btn-stack { display: flex; gap: 20px; margin-top: 40px; padding-bottom: 50px; }
        .custom-btn {
            padding: 16px 35px; border-radius: 50px; border: none; font-weight: 700;
            cursor: pointer; transition: 0.4s; display: flex; align-items: center; gap: 10px;
            text-decoration: none; color: white;
        }
        .btn-p { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); }
        .btn-p:hover { background: rgba(255,255,255,0.25); transform: translateY(-5px); }
        .btn-d { background: var(--primary); box-shadow: 0 10px 30px rgba(247, 148, 29, 0.4); }
        .btn-d:hover { transform: translateY(-5px) scale(1.05); }

        @media print { .header, .btn-stack { display: none; } body { background: white; } }
    </style>
</head>

<body>

    <header class="header animate__animated animate__fadeInDown">
        <div class="left-logo"><img src="gimt.png" alt="GIMT"></div>
        <div class="center-text">
            <h1>GLOBAL INSTITUTE OF MANAGEMENT & TECHNOLOGY</h1>
            <p>A UNIT OF NATIONAL CENTRE FOR DEVELOPMENT OF TECHNICAL EDUCATION</p>
            <p>APPROVED BY ALL INDIA COUNCIL FOR TECHNICAL EDUCATION</p>
            <p>AFFILIATED TO MAULANA ABUL KALAM AZAD UNIVERSITY OF TECHNOLOGY, W. B.</p>
        </div>
        <div class="right-logos"><img src="utech.png" alt="MAKAUT"><img src="aicte.png" alt="AICTE"></div>
    </header>

    <div class="id-wrapper" data-aos="zoom-in-up">
        
        <div class="id-card">
            <div class="card-inner-header">
                <img src="gimt.png" style="width: 55px; margin-bottom: 10px;">
                <div class="clg-title">GIMT - Smart Campus Digital ID</div>
            </div>

            <div class="card-body">
                <div class="photo-container animate__animated animate__pulse animate__infinite">
                    <img src="<?php echo $student['photo']; ?>" alt="Rupam Hazra">
                </div>
                
                <h2 class="st-name"><?php echo $student['name']; ?></h2>
                <span class="st-dept"><?php echo $student['dept']; ?></span>

                <div class="data-row"><span class="data-label">Roll No:</span><span class="data-val"><?php echo $student['roll']; ?></span></div>
                <div class="data-row"><span class="data-label">Student ID:</span><span class="data-val"><?php echo $student['student_id']; ?></span></div>
                <div class="data-row"><span class="data-label">Session:</span><span class="data-val"><?php echo $student['session']; ?></span></div>

                <div class="att-box" data-aos="fade-up">
                    <div class="att-stats">
                        <div class="stat-item"><span class="stat-val"><?php echo $total; ?></span><span class="stat-lab">Total</span></div>
                        <div class="stat-item"><span class="stat-val" style="color: #10b981;"><?php echo $present; ?></span><span class="stat-lab">Present</span></div>
                        <div class="stat-item"><span class="stat-val" style="color: var(--primary);"><?php echo $percent; ?>%</span><span class="stat-lab">Attend</span></div>
                    </div>
                    <div class="progress-container">
                        <div class="progress-fill" style="background: <?php echo $status_color; ?>;" id="idBar"></div>
                    </div>
                    <p style="font-size: 11px; margin-top: 12px; font-weight: 800; color: <?php echo $status_color; ?>"><?php echo $status; ?></p>
                </div>
            </div>

            <div class="card-footer">
                <div class="qr-sec">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://gimt.edu.in/profile/<?php echo $student['student_id']; ?>">
                </div>
                <div class="bar-sec">
                    <div class="barcode"><?php echo $student['student_id']; ?></div>
                    <div style="font-size: 10px; color: #94a3b8; font-weight: 700; margin-top: 5px;">VALID TILL: <?php echo $student['valid_till']; ?></div>
                </div>
            </div>
        </div>

        <div class="back-card" data-aos="fade-up">
            <h3 style="color: var(--primary); text-transform: uppercase; font-size: 16px; margin-bottom: 20px;">Campus Information</h3>
            <div class="back-info">
                <p><strong><i class="fas fa-location-dot"></i> Address:</strong> Palpara More, NH-12, Bhatjangla, Krishnagar, Nadia, WB - 741102</p>
                <p><strong><i class="fas fa-phone-flip"></i> Emergency:</strong> +91-74070 80088</p>
                <p style="font-size: 11px; opacity: 0.7; font-style: italic; margin-top: 20px; line-height: 1.6;">
                    This document is face-verified and digitally encrypted for Global Institute of Management & Technology smart campus system.
                </p>
            </div>
            
            <div class="signature-box">
                <div class="sig-font">Rupam Hazra</div>
                <div style="font-size: 9px; font-weight: 800; color: var(--primary); letter-spacing: 1.5px;">AUTHORIZED SIGNATURE</div>
            </div>
        </div>

        <div class="btn-stack">
            <a href="profile.php" class="custom-btn btn-p"><i class="fas fa-user-circle"></i> Profile</a>
            <button class="custom-btn btn-d" onclick="window.print()"><i class="fas fa-download"></i> Save Digital ID</button>
        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1200, once: true });
        
        // Progress Bar Load Animation
        window.onload = function() {
            setTimeout(() => {
                document.getElementById('idBar').style.width = '<?php echo $percent; ?>%';
            }, 600);
        };
    </script>
</body>
</html>