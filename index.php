<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Barcode Scanner with ZXing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        h1 {
            margin-top: 20px;
            color: #333;
            text-align: center;
        }
        h2 {
            font-size: 20px;
            color: #333;
            text-align: center;
        }
        p {
            font-size: 16px;
            color: #333;
            text-align: center;
        }
        #video {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            display: block;
            border: 5px solid #333;
            border-radius: 8px;
            background-color: #000;
        }
        #scanned-result {
            font-size: 24px;
            margin-top: 20px;
            color: #28a745;
            text-align: center;
        }
        #camera-select {
            margin-top: 20px;
            padding: 8px;
            font-size: 16px;
        }
        #loading-spinner {
            margin-top: 20px;
            display: none;
        }
        #restart-scanner {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #restart-scanner:hover {
            background-color: #0056b3;
        }
        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        footer a {
            color: #007bff;
            text-decoration: none;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            #video {
                width: 100%;
            }
            h1, h2, p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <h1>Real-Time Barcode Scanner</h1>
    <h2>Réalisé par Souidi Samir</h2>
    <p>Deploy in Azure 14-11-2024</p>

    <!-- Camera selection dropdown -->
    <select id="camera-select"></select>

    <!-- Video element to display camera feed -->
    <video id="video" autoplay></video>

    <!-- Scanned barcode result -->
    <div id="scanned-result">Scanned Barcode Number: <span id="result"></span></div>

    <!-- Loading spinner -->
    <div id="loading-spinner">Loading camera...</div>

    <!-- Restart scanner button -->
    <button id="restart-scanner">Restart Scanner</button>

    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
        const codeReader = new ZXing.BrowserMultiFormatReader();
        const videoElement = document.getElementById('video');
        const resultElement = document.getElementById('result');
        const cameraSelect = document.getElementById('camera-select');
        const loadingSpinner = document.getElementById('loading-spinner');
        const restartButton = document.getElementById('restart-scanner');

        // Function to show the loading spinner
        function showLoadingSpinner() {
            loadingSpinner.style.display = 'block';
        }

        // Function to hide the loading spinner
        function hideLoadingSpinner() {
            loadingSpinner.style.display = 'none';
        }

        // Populate the camera selection dropdown
        codeReader.getVideoInputDevices().then(videoInputDevices => {
            if (videoInputDevices.length > 0) {
                videoInputDevices.forEach((device, index) => {
                    const option = document.createElement('option');
                    option.value = device.deviceId;
                    option.textContent = device.label || `Camera ${index + 1}`;
                    cameraSelect.appendChild(option);
                });

                // Automatically start with the first camera
                startScanning(videoInputDevices[0].deviceId);

                // Change camera on selection
                cameraSelect.onchange = () => {
                    codeReader.reset();
                    startScanning(cameraSelect.value);
                };

                hideLoadingSpinner();
            } else {
                alert('No video input devices found.');
                hideLoadingSpinner();
            }
        }).catch(err => {
            console.error(err);
            alert('Error: Unable to access video input devices.');
            hideLoadingSpinner();
        });

        // Function to start scanning with the selected camera
        function startScanning(deviceId) {
            showLoadingSpinner();
            codeReader.decodeFromVideoDevice(deviceId, videoElement, (result, err) => {
                hideLoadingSpinner();
                if (result) {
                    resultElement.textContent = result.text;
                    codeReader.reset(); // Reset after successful scan
                }
                if (err && !(err instanceof ZXing.NotFoundException)) {
                    console.error(err);
                }
            });
        }

        // Restart the scanner when the button is clicked
        restartButton.addEventListener('click', () => {
            codeReader.reset();
            startScanning(cameraSelect.value);
        });
    </script>

    <footer>
        Created by Souidi Samir (<?php echo date('Y'); ?>)
    </footer>
</body>
</html>
