<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Barcode Scanner with ZXing--</title>
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
        #video {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            display: block;
            border: 5px solid #333;
            border-radius: 8px;
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
    </style>
</head>
<body>
    <h1>Real-Time Barcode Scanner:</h1>
    <h2>Réalisé par Souidi Samir</h2>
    <p>deploy in azure 14-11-2024</p>
    <select id="camera-select"></select>
    <video id="video" autoplay></video>
    <div id="scanned-result">Scanned Barcode Number: <span id="result"></span></div>

    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
        const codeReader = new ZXing.BrowserMultiFormatReader();
        const videoElement = document.getElementById('video');
        const resultElement = document.getElementById('result');
        const cameraSelect = document.getElementById('camera-select');

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
            } else {
                alert('No video input devices found.');
            }
        }).catch(err => {
            console.error(err);
        });

        // Function to start scanning with the selected camera
        function startScanning(deviceId) {
            codeReader.decodeFromVideoDevice(deviceId, videoElement, (result, err) => {
                if (result) {
                    resultElement.textContent = result.text;
                    codeReader.reset();
                }
                if (err && !(err instanceof ZXing.NotFoundException)) {
                    console.error(err);
                }
            });
        }
    </script>
     <footer>
        Created by Souidi Samir (<?php echo date('Y'); ?>)
    </footer>
</body>
</html>
