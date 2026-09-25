<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MSA Automotriz')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-red: #E60000;
            --dark-bg: #111111;
            --sidebar-bg: #1A1A1A;
            --light-bg: #FAFAFA;
            --grid-color: #E5E5E5;
            --text-dark: #333333;
            --text-light: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #FFFFFF;
            color: var(--text-dark);
        }

        .auth-body {
            background: var(--dark-bg);
            background-image: radial-gradient(circle at center, #222 0%, #000 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .btn {
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-red {
            background-color: var(--primary-red);
            color: var(--text-light);
        }

        .btn-red:hover { background-color: #cc0000; }

        .btn-dark {
            background-color: var(--dark-bg);
            color: var(--text-light);
            border: 1px solid #444;
        }
        
        .btn-dark:hover { background-color: #333; }

        .btn-outline {
            background-color: transparent;
            color: var(--primary-red);
            border: 1px solid var(--primary-red);
        }
        
        .btn-outline:hover {
            background-color: var(--primary-red);
            color: var(--text-light);
        }

        .layout-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        .sidebar-logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #333;
            background-color: #000;
        }

        .sidebar-logo img {
            max-width: 150px;
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
        }

        .nav-item {
            padding: 15px 25px;
            color: #AAA;
            font-weight: 600;
            cursor: pointer;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            color: var(--text-light);
            background-color: #2a2a2a;
        }

        .nav-item.active {
            color: var(--text-light);
            border-left-color: var(--primary-red);
        }

        /* Main Content */
        .main-content-wrapper {
            margin-left: 250px;
            flex: 1;
            padding: 30px 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            background: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #eaeaea;
        }

        .topbar h1 {
            font-size: 24px;
            color: var(--text-dark);
        }

        .topbar .red-title {
            color: var(--primary-red);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            font-weight: 700;
        }
        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .layout-wrapper {
                flex-direction: column;
            }
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                z-index: 100;
            }
            .sidebar-logo {
                padding: 5px;
                border: none;
                background: transparent;
            }
            .sidebar-logo img {
                max-width: 100px;
            }
            .nav-menu {
                display: flex;
                padding: 0;
            }
            .nav-item {
                padding: 10px 15px;
                border-left: none;
                border-bottom: 3px solid transparent;
            }
            .nav-item.active {
                border-bottom-color: #FFF;
                border-left-color: transparent;
            }
            .main-content-wrapper {
                margin-left: 0;
                padding: 15px;
            }
            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 15px;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="@yield('body_class')">
    @yield('content')
    @stack('scripts')
</body>
</html>
