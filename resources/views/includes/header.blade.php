    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyperCare</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #6FB3E0;
            --secondary-color: #A8D5F2;
            --accent-color: #4A90B8;
            --light-bg: #F8FBFF;
            --text-dark: #2C3E50;
            --soft-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
        }

        .sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            min-height: 100vh;
            box-shadow: var(--soft-shadow);
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(5px);
        }

        .main-content {
            background-color: white;
            min-height: 100vh;
        }

        .header {
            background: white;
            box-shadow: var(--soft-shadow);
            padding: 1rem 2rem;
            border-bottom: 2px solid var(--secondary-color);
        }

        .stat-card {
            background: linear-gradient(135deg, white, #f8f9fa);
            border: none;
            border-radius: 15px;
            box-shadow: var(--soft-shadow);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .chart-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--soft-shadow);
            border: none;
        }

        .recent-activity {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            border-left: 3px solid var(--primary-color);
            padding-left: 15px;
            margin-bottom: 15px;
        }
    </style>