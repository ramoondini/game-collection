<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Lietotāju kolekcijas</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #1b2838;
            color: #c7d5e0;
        }

        header {
            background: #171a21;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            color: white;
        }

        nav {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        a {
            color: #66c0f4;
            text-decoration: none;
        }

        .logout-button {
            background: none;
            border: none;
            color: #66c0f4;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .top-actions {
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .button {
            display: inline-block;
            background: #2a475e;
            color: white;
            padding: 10px 14px;
            border-radius: 5px;
        }

        .button-green {
            background: #5c7e10;
        }

        .page-title {
            text-align: left;
            margin-bottom: 25px;
        }

        .folders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .folder-card {
            background: #16202d;
            border-radius: 10px;
            padding: 25px;
            transition: 0.2s;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .folder-card:hover {
            transform: translateY(-4px);
            background: #22364a;
        }

        .folder-icon {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .folder-card h2 {
            margin: 0 0 10px;
            color: white;
        }

        .folder-card p {
            margin: 0;
            color: #c7d5e0;
        }
    </style>
</head>
<body>

<header>
    <h1>Lietotāju kolekcijas</h1>

    <nav>
        <a href="{{ route('collections.index') }}">Kolekcijas</a>
        <a href="{{ route('games.index') }}">Visas spēles</a>

        @guest
            <a href="{{ route('login') }}">Pieslēgties</a>
            <a href="{{ route('register') }}">Reģistrēties</a>
        @endguest

        @auth
            <span>{{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-button" type="submit">Iziet</button>
            </form>
        @endauth
    </nav>
</header>

<div class="container">

    @auth
        <div class="top-actions">
            <a class="button button-green" href="{{ route('games.create') }}">
                + Pievienot spēli savai kolekcijai
            </a>
        </div>
    @endauth

    <h2 class="page-title">Izvēlies kolekciju</h2>

    <div class="folders-grid">
        @forelse($users as $user)
            <a href="{{ route('collections.show', $user) }}">
                <div class="folder-card">
                    <div class="folder-icon">📁</div>
                    <h2>{{ $user->name }} kolekcija</h2>
                    <p>{{ $user->games_count }} spēles</p>
                </div>
            </a>
        @empty
            <p>Vēl nav nevienas kolekcijas.</p>
        @endforelse
    </div>

</div>

</body>
</html>