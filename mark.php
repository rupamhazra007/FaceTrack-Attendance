<?php
// Mock Data (Real database logic pore add hobe)
$success = false;
$name = "Unknown";
$dept = "N/A";
$roll = "N/A";
$reg = "N/A";
$sem = "N/A";
$photo = "https://cdn-icons-png.flaticon.com/512/3135/3135715.png"; // Placeholder

// Time settings
date_default_timezone_set('Asia/Kolkata');
$date = date("d M, Y");
$time = date("h:i:s A");

if(isset($_POST['image'])){
    // Simulate Success Logic
    $success = true;
    
    // Student Details
    $name = "Rupam Hazra"; 
    $dept = "Computer Science & Engineering";
    $roll = "25900122005";
    $reg = "222590110020 of 2022-23";
    $year = "4th Year";
    $sem = "8th Semester";
    
    $photo = $_POST['image']; // Captured Photo
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Receipt | GIMT</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #f7941d;
            --secondary: #003366;
            --success: #10b981;
            --error: #ef4444;
            --footer-bg: #030b26;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('ok.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* ===== HEADER ===== */
        .header {
            background: rgba(255, 255, 255, 0.95); padding: 15px 20px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 5px solid var(--primary); position: relative; z-index: 1000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .left-logo img { width: 100px; }
        .center-text { flex: 1; margin: 0 20px; text-align: left; font-family: 'Roboto', sans-serif; }
        .center-text h1 { font-size: 24px; color: var(--primary); font-weight: 900; text-transform: uppercase; line-height: 1.2; }
        .center-text p { font-size: 11px; color: #000; font-weight: 700; text-transform: uppercase; line-height: 1.4; }
        .right-logos img { height: 60px; margin-left: 10px; }

        /* ===== MAIN CONTAINER ===== */
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }

        .loader-box {
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 50px 70px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }
        .spinner {
            width: 60px; height: 60px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* Result Card Animation Fix */
        .result-card {
            background: rgba(255, 255, 255, 0.92);
            width: 100%;
            max-width: 500px;
            border-radius: 30px;
            box-shadow: 0 30px 70px rgba(0,0,0,0.5);
            overflow: hidden;
            display: none;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            /* New 3D Animation when shown */
            animation: jackInTheBox 1.2s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .card-header { padding: 30px; text-align: center; color: white; }
        .bg-success { background: linear-gradient(135deg, #10b981, #059669); }
        .bg-fail { background: linear-gradient(135deg, #ef4444, #dc2626); }

        .status-icon {
            font-size: 50px; margin-bottom: 10px;
            background: rgba(255,255,255,0.2);
            width: 80px; height: 80px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 15px;
            animation: heartBeat 1.5s infinite;
        }

        .card-body { padding: 40px 30px 30px; position: relative; }

        .user-photo-wrapper {
            position: relative; width: 130px; height: 130px;
            margin: -95px auto 20px; border-radius: 50%;
            padding: 5px; background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: flipInY 2s;
        }
        .user-photo { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }

        .info-list { margin-top: 10px; }
        .info-row {
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px dashed #ddd; padding: 12px 0;
            animation: fadeInRight 0.8s both;
        }
        /* Staggered text animations */
        .info-row:nth-child(1) { animation-delay: 0.1s; }
        .info-row:nth-child(2) { animation-delay: 0.2s; }
        .info-row:nth-child(3) { animation-delay: 0.3s; }
        .info-row:nth-child(4) { animation-delay: 0.4s; }
        .info-row:nth-child(5) { animation-delay: 0.5s; }

        .label { font-size: 12px; color: #64748b; font-weight: 800; text-transform: uppercase; }
        .val { font-size: 15px; color: #1e293b; font-weight: 700; text-align: right; }

        .badge {
            background: #e0f2fe; color: #0284c7;
            padding: 5px 12px; border-radius: 50px; font-size: 11px; font-weight: 700;
        }

        .btn-group { margin-top: 30px; display: flex; gap: 15px; }
        .btn {
            flex: 1; padding: 14px; border-radius: 12px;
            font-weight: 700; cursor: pointer; transition: 0.3s; font-size: 13px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            text-decoration: none;
        }
        .btn-home { background: #f1f5f9; color: var(--secondary); }
        .btn-profile { background: var(--secondary); color: white; animation: pulse 2s infinite; }
        .btn-retry { background: #fee2e2; color: #b91c1c; }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }

        /* ===== FOOTER ===== */
        .footer { background: #030b26; color: white; padding: 60px 5% 30px; font-family: 'Roboto', sans-serif; overflow: hidden; }
        .footer-container { display: grid; grid-template-columns: 0.8fr 1.2fr 1.5fr; gap: 40px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 40px; }
        .ft-logo img { width: 140px; filter: drop-shadow(0 0 10px rgba(255,255,255,0.2)); }
        
        .ft-content h3 { font-size: 20px; color: #f7941d; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #f7941d; display: inline-block; padding-bottom: 5px; }
        .ft-content p { color: #e0e0e0; font-size: 14px; margin-bottom: 15px; display: flex; align-items: flex-start; gap: 12px; line-height: 1.6; }
        .phone-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        @media (max-width: 900px) {
            .header { flex-direction: column; text-align: center; }
            .footer-container { grid-template-columns: 1fr; text-align: center; }
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
            <p>AFFILIATED TO MAULANA ABUL KALAM AZAD UNIVERSITY OF TECHNOLOGY, W. B.</p>
        </div>
        <div class="right-logos"><img src="utech.png" alt="MAKAUT"><img src="aicte.png" alt="AICTE"></div>
    </header>

    <main class="main-container">
        <div class="loader-box" id="loader">
            <div class="spinner"></div>
            <h3 style="color: #333; font-weight: 800;">Verifying Identity...</h3>
            <p style="color: #666; font-size: 14px;">Matching biometrics with database</p>
        </div>

        <div class="result-card" id="resultCard">
            
            <?php if($success){ ?>
                <div class="card-header bg-success">
                    <div class="status-icon"><i class="fas fa-check"></i></div>
                    <h2>Access Granted</h2>
                    <p style="opacity: 0.9;">ATTENDANCE RECORDED</p>
                </div>

                <div class="card-body">
                    <div class="user-photo-wrapper">
                        <img src="<?php echo $photo; ?>" class="user-photo">
                    </div>

                    <div class="info-list">
                        <div class="info-row"><span class="label">Student Name</span><span class="val" style="color: var(--secondary);"><?php echo $name; ?></span></div>
                        <div class="info-row"><span class="label">Department</span><span class="val"><?php echo $dept; ?></span></div>
                        <div class="info-row"><span class="label">Year / Sem</span><span class="val"><?php echo $year; ?> / <?php echo $sem; ?></span></div>
                        <div class="info-row"><span class="label">Roll Number</span><span class="val"><?php echo $roll; ?></span></div>
                        <div class="info-row"><span class="label">Punch Time</span><span class="val" style="color: var(--success); font-weight: 800;"><i class="far fa-clock"></i> <?php echo $time; ?></span></div>
                    </div>

                    <div class="btn-group">
                        <a href="welcome.php" class="btn btn-home"><i class="fas fa-home"></i> Dashboard</a>
                        <a href="profile.php" class="btn btn-profile"><i class="fas fa-user-circle"></i> View Profile</a>
                    </div>
                </div>

            <?php } else { ?>
                <div class="card-header bg-fail">
                    <div class="status-icon"><i class="fas fa-times"></i></div>
                    <h2>Access Denied</h2>
                    <p style="opacity: 0.9;">IDENTITY VERIFICATION FAILED</p>
                </div>

                <div class="card-body">
                    <div style="text-align: center; padding: 20px 0;">
                        <img src="https://cdn-icons-png.flaticon.com/512/10009/10009623.png" style="width: 80px; opacity: 0.6; margin-bottom: 15px;">
                        <p style="color: #333; font-weight: 700;">Face Not Recognized</p>
                        <p style="color: #666; font-size: 13px; margin-top: 5px;">Lighting or angle issue. Please retry.</p>
                    </div>
                    <div class="btn-group">
                        <a href="index.php" class="btn btn-retry"><i class="fas fa-redo"></i> Retry</a>
                        <a href="welcome.php" class="btn btn-home"><i class="fas fa-home"></i> Home</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container" data-aos="fade-up">
            
            <div style="text-align: center;">
                <img src="gimt.png" alt="GIMT Logo" style="width: 140px; filter: drop-shadow(0 0 10px rgba(255,255,255,0.2));">
                <div style="margin-top: 15px; font-weight: 800; font-size: 14px; letter-spacing: 1px; color: #fff;"></div>
            </div>

            <div class="ft-content">
                <h3 style="font-size: 20px; color: #f7941d; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #f7941d; display: inline-block; padding-bottom: 5px;">Campus Location</h3>
                <p style="font-size: 14px; margin-bottom: 15px; display: flex; align-items: flex-start; gap: 12px; line-height: 1.6; opacity: 0.9;">
                    <i class="fas fa-map-marker-alt" style="color: #f7941d; margin-top: 5px;"></i> 
                    Palpara More, NH-12 (Formerly known as NH-34) Bhatjangla, Krishnagar West Bengal - 741102
                </p>
                <p style="font-size: 14px; margin-bottom: 10px; display: flex; align-items: center; gap: 12px; opacity: 0.9;">
                    <i class="fas fa-envelope" style="color: #f7941d;"></i> 
                    admission@gimt-india.com
                </p>
            </div>

            <div class="ft-content">
                <h3 style="font-size: 20px; color: #f7941d; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #f7941d; display: inline-block; padding-bottom: 5px;">Admission Query</h3>
                <div class="phone-grid">
                    <div>
                        <p><i class="fas fa-phone-alt" style="color: #f7941d;"></i> +91-7596056174</p>
                        <p><i class="fas fa-phone-alt" style="color: #f7941d;"></i> +91-9083640444</p>
                    </div>
                    <div>
                        <p><i class="fas fa-phone-alt" style="color: #f7941d;"></i> +91-7407095678</p>
                        <p><i class="fas fa-phone-alt" style="color: #f7941d;"></i> +91-8695649386</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright" style="text-align: center; margin-top: 30px; font-size: 13px; color: rgba(255,255,255,0.5);">
            Designed by <b>Rupam Hazra</b> | CSE 8th Sem | © 2026 GIMT
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
        window.onload = function() {
            setTimeout(() => {
                document.getElementById('loader').style.display = 'none';
                document.getElementById('resultCard').style.display = 'block';
                <?php if($success){ ?>
                    Swal.fire({ 
                        toast: true, 
                        position: 'top-end', 
                        showConfirmButton: false, 
                        timer: 3000, 
                        icon: 'success', 
                        title: 'Attendance Marked Successfully' 
                    });
                <?php } ?>
            }, 2000);
        };
    </script>
</body>
</html>