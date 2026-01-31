<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: DejaVu Sans;
            text-align: center;
            padding: 40px;
        }
        .container {
            border: 8px solid #6b21a8;
            padding: 40px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 22px;
            margin-bottom: 30px;
        }
        .name {
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
        }
        .course {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .code {
            margin-top: 40px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>SERTIFIKAT</h1>
    <h2>Diberikan kepada</h2>

    <div class="name">
        {{ $certificate->user->name }}
    </div>

    <p>Atas keberhasilannya menyelesaikan kursus</p>

    <div class="course">
        <strong>{{ $certificate->course->title }}</strong>
    </div>

    <p>
        Diselesaikan pada {{ $certificate->created_at->format('d F Y') }}
    </p>

    <div class="code">
        Kode Sertifikat: {{ $certificate->certificate_code }}
    </div>
</div>

</body>
</html>
