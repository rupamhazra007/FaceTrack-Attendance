<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Scan | GIMT Smart Attendance</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

    <style>
        :root {
            --primary: #f7941d;
            --secondary: #003366;
            --accent: #007bff;
            --success: #28a745;
            --bg-light: #f8f9fa;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }

        body {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* HEADER */
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

        /* SCANNER UI */
        .scan-container {
            flex: 1; display: flex; justify-content: center; align-items: center;
            padding: 40px 20px; position: relative;
        }

        .blob {
            position: absolute; width: 350px; height: 350px;
            background: linear-gradient(180deg, rgba(247, 148, 29, 0.1), rgba(0, 51, 102, 0.1));
            border-radius: 50%; z-index: 0; filter: blur(50px);
        }
        .b1 { top: 10%; left: 5%; }
        .b2 { bottom: 10%; right: 5%; }

        .scanner-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid white;
            width: 100%; max-width: 550px;
            padding: 40px 30px; border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            text-align: center; position: relative; z-index: 10;
        }

        .scanner-header h3 { color: var(--secondary); font-weight: 800; font-size: 24px; margin-bottom: 5px; }
        .scanner-header p { color: #666; font-size: 14px; margin-bottom: 25px; }

        .camera-frame {
            position: relative; width: 100%; height: 380px;
            background: #000; border-radius: 25px; overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            border: 4px solid white;
        }

        video { width: 100%; height: 100%; object-fit: cover; transform: scaleX(-1); }

        /* HUD OVERLAYS */
        .hud-grid {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 40px 40px; pointer-events: none; z-index: 2;
        }

        .focus-circle {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 220px; height: 280px;
            border-radius: 50%;
            border: 3px dashed rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.5); /* Dim surroundings */
            z-index: 5; transition: all 0.3s ease;
        }

        /* Logic States */
        .circle-searching { border-color: white; animation: pulse-white 1.5s infinite; }
        .circle-detecting { border-color: var(--accent); border-style: solid; box-shadow: 0 0 15px var(--accent), 0 0 0 9999px rgba(0,0,0,0.5); }
        .circle-locked { border-color: var(--success); border-style: solid; border-width: 5px; box-shadow: 0 0 30px var(--success), 0 0 0 9999px rgba(0,0,0,0.7); }

        @keyframes pulse-white { 0% { transform: translate(-50%, -50%) scale(1); opacity: 0.8; } 50% { transform: translate(-50%, -50%) scale(1.02); opacity: 1; } }

        /* Loader */
        #ai-loader {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            color: white; z-index: 20; display: flex; flex-direction: column; align-items: center;
        }
        .spinner { width: 30px; height: 30px; border: 3px solid rgba(255,255,255,0.3); border-top: 3px solid var(--primary); border-radius: 50%; animation: spin 1s infinite linear; margin-bottom: 10px; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Status Pill */
        .status-pill {
            margin-top: 20px; display: inline-flex; align-items: center; gap: 10px;
            background: #e3f2fd; color: var(--secondary);
            padding: 10px 25px; border-radius: 50px;
            font-size: 14px; font-weight: 700;
            border: 1px solid #d6e4ff; transition: 0.3s;
        }
        .live-dot {
            width: 10px; height: 10px; background: #ccc;
            border-radius: 50%;
        }

        #attendForm { display: none; }
        
        /* Manual Controls */
        .manual-controls {
            margin-top: 15px; display: none;
        }
        .manual-btn {
            background: none; border: none; color: #666; font-size: 13px; text-decoration: underline; cursor: pointer;
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
        <div class="right-logos"><img src="utech.png"><img src="aicte.png"></div>
    </header>

    <main class="scan-container">
        <div class="blob b1"></div>
        <div class="blob b2"></div>

        <div class="scanner-card animate__animated animate__zoomIn">
            
            <div class="scanner-header">
                <h3>Biometric Face Scan</h3>
                <p>Ensure your face is clearly visible inside the circle</p>
            </div>

            <div class="camera-frame">
                <div class="hud-grid"></div>
                
                <div id="ai-loader">
                    <div class="spinner"></div>
                    <span id="loaderText" style="font-size: 12px; font-weight: 600;">Starting Camera & AI...</span>
                </div>

                <div class="focus-circle circle-searching" id="focusCircle"></div>
                
                <video id="video" autoplay muted playsinline></video>
            </div>

            <div class="status-pill" id="statusPill">
                <div class="live-dot" id="dot"></div> 
                <span id="statusText">Initializing System...</span>
            </div>

            <div class="manual-controls" id="manualControls">
                <button class="manual-btn" onclick="forceCapture()">Takes too long? Click to Capture</button>
            </div>

            <form id="attendForm" method="POST" action="mark.php">
                <input type="hidden" name="image" id="image">
            </form>

        </div>
    </main>

<script>
    const video = document.getElementById("video");
    const focusCircle = document.getElementById("focusCircle");
    const statusText = document.getElementById("statusText");
    const statusPill = document.getElementById("statusPill");
    const dot = document.getElementById("dot");
    const loader = document.getElementById("ai-loader");
    const loaderText = document.getElementById("loaderText");
    const manualControls = document.getElementById("manualControls");
    const attendForm = document.getElementById("attendForm");

    let isFaceDetected = false;
    let lockTimer;
    let modelLoaded = false;

    // Faster CDN URL
    const modelUrl = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/';

    // 1. Load Models with Timeout Protection
    const loadModels = async () => {
        try {
            await faceapi.nets.tinyFaceDetector.loadFromUri(modelUrl);
            modelLoaded = true;
            startVideo();
        } catch (e) {
            console.error("AI Load Failed, switching to manual mode.");
            fallbackMode();
        }
    };

    // Fail-safe: If not loaded in 8 seconds, enable camera anyway
    setTimeout(() => {
        if (!modelLoaded) {
            loaderText.innerText = "AI Slow. Switching to Manual...";
            setTimeout(fallbackMode, 1000);
        }
    }, 8000);

    loadModels();

    // 2. Start Camera
    function startVideo() {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } })
        .then(stream => {
            video.srcObject = stream;
            loader.style.display = 'none'; // Hide loader
            manualControls.style.display = 'block'; // Show backup button
        })
        .catch(err => {
            Swal.fire({ icon: 'error', title: 'Camera Error', text: 'Please allow camera access.' });
        });
    }

    // 3. Fallback Mode (If AI Fails)
    function fallbackMode() {
        startVideo(); // Just start video
        statusText.innerText = "Manual Mode Active";
        loader.style.display = 'none';
        manualControls.style.display = 'block';
        // Mock detection loop won't run, user must click
    }

    // 4. AI Detection Loop
    video.addEventListener('play', () => {
        if (!modelLoaded) return; // Don't run AI if failed

        statusText.innerText = "Searching for face...";
        dot.style.background = "#ffcc00"; 
        dot.style.animation = "blink 1s infinite";

        setInterval(async () => {
            // Detect Face
            const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions());

            if (detections.length > 0) {
                if (!isFaceDetected) {
                    isFaceDetected = true;
                    onFaceFound();
                }
            } else {
                if (isFaceDetected) {
                    isFaceDetected = false;
                    onFaceLost();
                }
            }
        }, 300); 
    });

    // Logic Functions
    function onFaceFound() {
        focusCircle.className = "focus-circle circle-detecting"; // Blue
        statusText.innerText = "Face Detected. Hold Still...";
        statusText.style.color = "#007bff";
        
        lockTimer = setTimeout(onFaceLocked, 1500); 
    }

    function onFaceLost() {
        clearTimeout(lockTimer);
        focusCircle.className = "focus-circle circle-searching"; // White
        statusText.innerText = "Searching for face...";
        statusText.style.color = "#555";
    }

    function onFaceLocked() {
        focusCircle.className = "focus-circle circle-locked"; // Green
        statusText.innerText = "Identity Verified!";
        statusText.style.color = "#155724";
        statusPill.style.background = "#d4edda";
        
        if(navigator.vibrate) navigator.vibrate(100);

        setTimeout(captureAndSubmit, 800);
    }

    function captureAndSubmit() {
        const canvas = document.createElement("canvas");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext("2d").drawImage(video, 0, 0);
        document.getElementById("image").value = canvas.toDataURL("image/png");
        
        video.pause(); 
        attendForm.submit();
    }

    // Manual Trigger
    function forceCapture() {
        captureAndSubmit();
    }
</script>

</body>
</html>