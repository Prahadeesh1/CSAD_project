<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realistic Glass Shatter</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: #000;
        }

        canvas {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .glass-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .glass-texture {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/white-diamond.png') repeat;
            opacity: 0.2;
        }

        .scratches {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/scratches.png') repeat;
            opacity: 0.1;
        }

        .glass-shine {
            position: absolute;
            width: 200%;
            height: 100%;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0) 100%);
            transform: translateX(-100%);
            animation: shine 2s linear forwards;
        }

        @keyframes shine {
            to {
                transform: translateX(100%);
            }
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="glass-overlay" id="glass-overlay">
        <div class="glass-texture"></div>
        <div class="scratches"></div>
        <div class="glass-shine"></div>
    </div>
    <canvas id="shatter-canvas"></canvas>

    <script>
        const canvas = document.getElementById('shatter-canvas');
        const ctx = canvas.getContext('2d');
        const overlay = document.getElementById('glass-overlay');
        let pieces = [];
        const pieceCount = 50;

        // Set up canvas size
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        // Create glass pieces
        function createPieces() {
            for (let i = 0; i < pieceCount; i++) {
                const piece = {
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 30 + 10,
                    dx: (Math.random() - 0.5) * 10,
                    dy: (Math.random() - 0.5) * 10,
                    rotation: Math.random() * 360,
                    rotationSpeed: (Math.random() - 0.5) * 5,
                    zoomTarget: Math.random() > 0.98 // Randomly select one fragment for POV
                };
                pieces.push(piece);
            }
        }

        // Draw and animate glass pieces
        function animatePieces() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            let targetPiece = null;

            pieces.forEach((piece, index) => {
                ctx.save();
                ctx.translate(piece.x, piece.y);
                ctx.rotate((piece.rotation * Math.PI) / 180);
                ctx.fillStyle = `rgba(255, 255, 255, 0.6)`;
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.lineTo(piece.size, piece.size / 2);
                ctx.lineTo(piece.size / 2, piece.size);
                ctx.closePath();
                ctx.fill();
                ctx.restore();

                // Update piece position
                piece.x += piece.dx;
                piece.y += piece.dy;
                piece.rotation += piece.rotationSpeed;
                piece.dy += 0.2; // Gravity

                if (piece.zoomTarget) {
                    targetPiece = piece;
                }
            });

            if (pieces.length > 0) {
                requestAnimationFrame(animatePieces);
            } else if (targetPiece) {
                zoomIntoPiece(targetPiece);
            }
        }

        // Simulate POV zoom into a glass fragment
        function zoomIntoPiece(target) {
            let scale = 1;
            const zoomInterval = setInterval(() => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.save();
                ctx.translate(canvas.width / 2, canvas.height / 2);
                ctx.scale(scale, scale);
                ctx.translate(-target.x, -target.y);
                pieces.forEach((piece) => {
                    ctx.save();
                    ctx.translate(piece.x, piece.y);
                    ctx.rotate((piece.rotation * Math.PI) / 180);
                    ctx.fillStyle = `rgba(255, 255, 255, 0.6)`;
                    ctx.beginPath();
                    ctx.moveTo(0, 0);
                    ctx.lineTo(piece.size, piece.size / 2);
                    ctx.lineTo(piece.size / 2, piece.size);
                    ctx.closePath();
                    ctx.fill();
                    ctx.restore();
                });
                ctx.restore();

                scale += 0.1; // Zoom speed
                if (scale > 10) {
                    clearInterval(zoomInterval);
                    redirectToMainPage();
                }
            }, 30);
        }

        // Start animation
        function startAnimation() {
            setTimeout(() => {
                overlay.style.opacity = '0';
                overlay.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => {
                    overlay.classList.add('hidden');
                    createPieces();
                    animatePieces();
                }, 500);
            }, 2000); // Delay for 2 seconds before shattering
        }

        // Redirect to main page
        function redirectToMainPage() {
            window.location.href = 'main_page.php';
        }

        // Trigger the animation
        window.onload = startAnimation;
    </script>
</body>
</html>
