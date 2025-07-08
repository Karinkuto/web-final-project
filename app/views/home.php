<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        header {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        .container {
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($title) ?></h1>
        <nav>
            <a href="/">Home</a> | 
            <a href="/about">About</a> | 
            <a href="/contact">Contact</a>
        </nav>
    </header>
    
    <div class="container">
        <p><?= htmlspecialchars($content) ?></p>
    </div>
</body>
</html>
