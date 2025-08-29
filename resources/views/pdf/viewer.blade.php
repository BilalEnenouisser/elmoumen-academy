<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pdf->title ?? 'PDF Viewer' }} - El Moumen Academy</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .header .actions {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #45a049;
        }
        
        .btn-secondary {
            background-color: #2196F3;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #1976D2;
        }
        
        .pdf-container {
            height: calc(100vh - 80px);
            width: 100%;
            background: white;
        }
        
        .pdf-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            font-size: 1.2rem;
            color: #666;
        }
        
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-right: 1rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .header .actions {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $pdf->title ?? 'PDF Document' }}</h1>
        <div class="actions">
            <a href="{{ $pdfUrl }}" download="{{ $pdf->title ?? 'document' }}.pdf" class="btn btn-primary">
                📥 Download PDF
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                ← Back
            </a>
        </div>
    </div>
    
    <div class="pdf-container">
        <iframe 
            src="{{ $pdfUrl }}#toolbar=1&navpanes=1&scrollbar=1" 
            class="pdf-iframe"
            onload="hideLoading()"
            onerror="showError()">
            <div class="loading">
                <div class="spinner"></div>
                Loading PDF...
            </div>
        </iframe>
    </div>
    
    <script>
        function hideLoading() {
            // PDF loaded successfully
            console.log('PDF loaded successfully');
        }
        
        function showError() {
            // Handle PDF loading error
            document.querySelector('.pdf-container').innerHTML = `
                <div class="loading">
                    <div>❌ Error loading PDF. <a href="{{ $pdfUrl }}" download>Click here to download</a></div>
                </div>
            `;
        }
        
        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                history.back();
            }
        });
    </script>
</body>
</html>
