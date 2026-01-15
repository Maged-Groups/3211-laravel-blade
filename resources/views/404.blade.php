<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - 404 Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .error-container {
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #667eea;
            line-height: 1;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .error-message {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #666;
            line-height: 1.6;
        }

        .home-button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .home-button:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .search-box {
            margin: 2rem 0;
        }

        .search-input {
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            width: 100%;
            max-width: 300px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .links {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .link {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .link:hover {
            color: #764ba2;
        }

        @media (max-width: 768px) {
            .error-container {
                padding: 2rem;
            }

            .error-code {
                font-size: 6rem;
            }

            .error-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">Page Not Found</h1>

        <p class="error-message">
            The page you are looking for might have been removed, had its name changed,
            or is temporarily unavailable.
        </p>

        <div class="search-box">
            <input type="text" class="search-input" placeholder="Search our website...">
        </div>

        <a href="{{ url('/') }}" class="home-button">
            Go Back Home
        </a>

        <div class="links">
            <a href="{{ url('/') }}" class="link">Home</a>
            <a href="{{ url('/about') }}" class="link">About</a>
            <a href="{{ url('/contact') }}" class="link">Contact</a>
            <a href="javascript:history.back()" class="link">Go Back</a>
        </div>
    </div>

    <script>
        // Add search functionality
        document.querySelector('.search-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query) {
                    window.location.href = '{{ url("/search") }}?q=' + encodeURIComponent(query);
                }
            }
        });

        // Add some interactive elements
        document.addEventListener('DOMContentLoaded', function () {
            const errorCode = document.querySelector('.error-code');
            errorCode.style.transform = 'scale(0.8)';
            setTimeout(() => {
                errorCode.style.transition = 'transform 0.5s ease';
                errorCode.style.transform = 'scale(1)';
            }, 100);
        });
    </script>
</body>

</html>