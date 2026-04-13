<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Generator</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                padding: 20px;
            }

            .container { max-width: 1200px; margin: 0 auto; }

            header {
                text-align: center;
                color: white;
                margin-bottom: 40px;
                animation: slideDown 0.6s ease-out;
            }

            header h1 {
                font-size: 2.5rem;
                margin-bottom: 10px;
                font-weight: 700;
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            header p {
                font-size: 1.1rem;
                opacity: 0.9;
            }

            .content-wrapper {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 30px;
                margin-bottom: 40px;
            }

            @media (max-width: 768px) {
                .content-wrapper { grid-template-columns: 1fr; }
                header h1 { font-size: 1.8rem; }
            }

            
            .form-card {
                background: white;
                border-radius: 15px;
                padding: 30px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
                animation: slideUp 0.6s ease-out;
            }

            .form-card h2 {
                color: #667eea;
                margin-bottom: 25px;
                font-size: 1.5rem;
                font-weight: 700;
            }

            .form-group {
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 8px;
                color: #333;
                font-weight: 600;
                font-size: 0.95rem;
            }

            input[type="text"],
            input[type="email"],
            input[type="number"],
            select,
            textarea {
                width: 100%;
                padding: 12px;
                border: 2px solid #e0e0e0;
                border-radius: 8px;
                font-family: inherit;
                font-size: 1rem;
                transition: all 0.3s ease;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="number"]:focus,
            select:focus,
            textarea:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                transform: translateY(-2px);
            }

            textarea {
                resize: vertical;
                min-height: 100px;
            }

            .hobbies-container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .hobby-input {
                display: flex;
                gap: 8px;
            }

            .hobby-input input {
                margin: 0;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            @media (max-width: 768px) {
                .form-row { grid-template-columns: 1fr; }
            }

            button {
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                width: 100%;
                margin-top: 10px;
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            }

            .btn-primary:active { transform: translateY(-1px); }

            .btn-danger {
                background: #ff4757;
                color: white;
            }

            .btn-danger:hover {
                background: #ff3838;
                transform: scale(1.05);
            }

            
            .profiles-section {
                grid-column: 2;
            }

            @media (max-width: 768px) {
                .profiles-section { grid-column: 1; }
            }

            .profiles-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
            }

            .profiles-header h2 {
                color: white;
                font-size: 1.5rem;
                font-weight: 700;
            }

            .btn-delete-all {
                background: #ff4757;
                color: white;
                padding: 10px 20px;
                font-size: 0.9rem;
            }

            .btn-delete-all:hover {
                background: #ff3838;
                transform: scale(1.05);
            }

            .profiles-grid {
                display: grid;
                gap: 15px;
                max-height: 600px;
                overflow-y: auto;
                padding-right: 10px;
            }

            .profiles-grid::-webkit-scrollbar {
                width: 6px;
            }

            .profiles-grid::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
            }

            .profiles-grid::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.3);
                border-radius: 10px;
            }

            .profiles-grid::-webkit-scrollbar-thumb:hover {
                background: rgba(255, 255, 255, 0.5);
            }

            .profile-card {
                background: white;
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                animation: fadeInScale 0.5s ease-out;
            }

            .profile-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
                border-left: 4px solid #667eea;
            }

            .profile-card-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 12px;
            }

            .profile-card h3 {
                color: #667eea;
                font-size: 1.2rem;
                margin-bottom: 8px;
            }

            .profile-card-delete {
                background: #ff4757;
                color: white;
                border: none;
                padding: 6px 12px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 0.85rem;
                transition: all 0.2s ease;
            }

            .profile-card-delete:hover {
                background: #ff3838;
                transform: scale(1.1);
            }

            .profile-info {
                display: grid;
                gap: 10px;
                font-size: 0.95rem;
                color: #555;
            }

            .profile-info-row {
                display: flex;
                justify-content: space-between;
                padding-bottom: 8px;
                border-bottom: 1px solid #f0f0f0;
            }

            .profile-info-label {
                font-weight: 600;
                color: #333;
            }

            .profile-hobbies {
                margin-top: 12px;
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }

            .hobby-tag {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 0.85rem;
                animation: fadeIn 0.4s ease-out;
            }

            .profile-bio {
                margin-top: 12px;
                padding: 12px;
                background: #f7f7f7;
                border-left: 3px solid #667eea;
                border-radius: 5px;
                font-size: 0.9rem;
                color: #555;
                font-style: italic;
            }

            .empty-state {
                background: white;
                border-radius: 12px;
                padding: 40px 20px;
                text-align: center;
                grid-column: 1 / -1;
                animation: fadeIn 0.5s ease-out;
            }

            .empty-state h3 {
                color: #999;
                font-size: 1.2rem;
                margin-bottom: 10px;
            }

            .empty-state p {
                color: #bbb;
            }

            .alert {
                padding: 15px 20px;
                border-radius: 8px;
                margin-bottom: 20px;
                animation: slideDown 0.4s ease-out;
            }

            .alert-success {
                background: #d4edda;
                color: #155724;
                border-left: 4px solid #28a745;
            }

            .alert-error {
                background: #f8d7da;
                color: #721c24;
                border-left: 4px solid #f5c6cb;
            }

            
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes fadeInScale {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            
            @media (max-width: 768px) {
                .form-card { padding: 20px; }
                .profiles-header { flex-direction: column; gap: 10px; }
                .btn-delete-all { width: 100%; }
                .hobbies-container { grid-template-columns: 1fr; }
            }
        </style>
    @endif
</head>
<body>
    <div class="container">
        <header>
            <h1>👤 Profile Generator</h1>
            <p>Create, view, and manage your profiles easily</p>
        </header>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Please fix the following errors:</strong>
                <ul style="margin-top: 8px;">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="content-wrapper">
            
            <div class="form-card">
                <h2>Add New Profile</h2>
                
                <form action="{{ route('profile.store') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" placeholder="e.g., John Doe" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="age">Age *</label>
                            <input type="number" id="age" name="age" placeholder="e.g., 25" value="{{ old('age') }}" min="1" max="150" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="e.g., john@example.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="program">Program/Course *</label>
                        <input type="text" id="program" name="program" placeholder="e.g., Computer Science" value="{{ old('program') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender *</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Hobbies * (At least 5)</label>
                        <div class="hobbies-container">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="hobby-input">
                                    <input type="text" name="hobbies[]" placeholder="Hobby {{ $i }}" value="{{ old('hobbies.' . ($i - 1)) }}">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="biography">Short Biography *</label>
                        <textarea id="biography" name="biography" placeholder="Tell us about yourself..." required>{{ old('biography') }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary">Add Profile</button>
                </form>
            </div>

            
            <div class="profiles-section">
                <div class="profiles-header">
                    <h2>📋 Your Profiles ({{ count($profiles) }})</h2>
                    @if (count($profiles) > 0)
                        <form action="{{ route('profile.destroyAll') }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure? This will delete ALL profiles!');">
                            @csrf
                            <button type="submit" class="btn-delete-all">Delete All</button>
                        </form>
                    @endif
                </div>

                @if (count($profiles) > 0)
                    <div class="profiles-grid">
                        @foreach ($profiles as $profile)
                            <div class="profile-card">
                                <div class="profile-card-header">
                                    <h3>{{ $profile['name'] }}</h3>
                                    <form action="{{ route('profile.destroy', $profile['id']) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Delete this profile?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="profile-card-delete">Delete</button>
                                    </form>
                                </div>

                                <div class="profile-info">
                                    <div class="profile-info-row">
                                        <span class="profile-info-label">Age:</span>
                                        <span>{{ $profile['age'] }} years</span>
                                    </div>
                                    <div class="profile-info-row">
                                        <span class="profile-info-label">Email:</span>
                                        <span>{{ $profile['email'] }}</span>
                                    </div>
                                    <div class="profile-info-row">
                                        <span class="profile-info-label">Program:</span>
                                        <span>{{ $profile['program'] }}</span>
                                    </div>
                                    <div class="profile-info-row">
                                        <span class="profile-info-label">Gender:</span>
                                        <span style="text-transform: capitalize;">{{ $profile['gender'] }}</span>
                                    </div>
                                </div>

                                <div class="profile-hobbies">
                                    @foreach ($profile['hobbies'] as $hobby)
                                        <span class="hobby-tag">🎯 {{ $hobby }}</span>
                                    @endforeach
                                </div>

                                <div class="profile-bio">
                                    <strong>Bio:</strong> {{ $profile['biography'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <h3>No Profiles Yet</h3>
                        <p>Create your first profile using the form on the left! 🚀</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
