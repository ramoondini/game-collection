<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }} kolekcija</title>

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
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .collection-title {
            background: #16202d;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .collection-title h2 {
            margin: 0 0 8px;
            color: white;
        }

        .search-box {
            background: #0e1b26;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .search-box input {
            width: 75%;
            padding: 12px;
            border: none;
            border-radius: 4px;
        }

        .search-box button {
            padding: 12px 20px;
            background: #66c0f4;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-button {
            display: inline-block;
            background: #5c7e10;
            color: white;
            padding: 12px 18px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 20px;
        }

        .game-card {
            background: #16202d;
            border-radius: 8px;
            overflow: hidden;
            transition: 0.2s;
        }

        .game-card:hover {
            transform: scale(1.03);
            background: #22364a;
        }

        .game-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            background: #000;
        }

        .no-image {
            width: 100%;
            height: 300px;
            background: #0e1b26;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #66c0f4;
            font-weight: bold;
        }

        .game-info {
            padding: 15px;
        }

        .game-info h2 {
            margin: 0 0 10px;
            color: white;
            font-size: 20px;
        }

        .actions {
            margin-top: 12px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .actions a,
        .actions button {
            background: #2a475e;
            color: white;
            border: none;
            padding: 7px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .delete-btn {
            background: #8b1e1e !important;
        }

        .success {
            background: #5c7e10;
            color: white;
            padding: 10px;
            border-radius: 4px;
        }

        .error {
            background: #8b1e1e;
            color: white;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<header>
    <h1>{{ $user->name }} kolekcija</h1>

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

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <div class="collection-title">
        <h2>📁 {{ $user->name }} kolekcija</h2>
        <p>Šeit redzamas tikai šī lietotāja pievienotās spēles.</p>
    </div>

    @auth
        @if(auth()->id() === $user->id)
            <a class="add-button" href="{{ route('games.create') }}">+ Pievienot spēli savai kolekcijai</a>
        @endif
    @endauth

    <div class="search-box">
        <form method="GET" action="{{ route('collections.show', $user) }}">
            <input type="text" name="search" placeholder="Meklēt šajā kolekcijā..." value="{{ request('search') }}">
            <button type="submit">Meklēt</button>
            <a href="{{ route('collections.show', $user) }}">Notīrīt</a>
        </form>
    </div>

    <div class="games-grid">
        @forelse($games as $game)
            <div class="game-card">
                @if($game->image)
                    <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}">
                @else
                    <div class="no-image">Nav attēla</div>
                @endif

                <div class="game-info">
                    <h2>{{ $game->title }}</h2>

                    <p><strong>Žanrs:</strong> {{ $game->genre->name ?? 'Nav norādīts' }}</p>
                    <p><strong>Gads:</strong> {{ $game->year ?? 'Nav norādīts' }}</p>

                    <div class="actions">
                        <a href="{{ route('games.show', $game) }}">Skatīt</a>

                        @auth
                            @if(auth()->user()->role === 'admin' || $game->user_id === auth()->id())
                                <a href="{{ route('games.edit', $game) }}">Rediģēt</a>

                                <form method="POST" action="{{ route('games.destroy', $game) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn" type="submit" onclick="return confirm('Tiešām dzēst?')">
                                        Dzēst
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p>Šajā kolekcijā vēl nav spēļu.</p>
        @endforelse
    </div>
</div>

</body>
</html>