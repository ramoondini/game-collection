<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>{{ $game->title }}</title>

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
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .success {
            background: #5c7e10;
            color: white;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error {
            background: #8b1e1e;
            color: white;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .game-hero {
            background: #16202d;
            border-radius: 10px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 330px 1fr;
            gap: 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .game-cover {
            width: 100%;
            height: 470px;
            object-fit: cover;
            background: #000;
        }

        .no-image {
            width: 100%;
            height: 470px;
            background: #0e1b26;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #66c0f4;
            font-weight: bold;
            font-size: 20px;
        }

        .game-details {
            padding: 30px;
        }

        .game-details h2 {
            color: white;
            font-size: 34px;
            margin: 0 0 15px;
        }

        .meta {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .badge {
            background: #2a475e;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
        }

        .description {
            line-height: 1.6;
            color: #d6e2ea;
            margin-bottom: 25px;
        }

        .rating-box {
            background: #0e1b26;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .rating-value {
            font-size: 26px;
            color: #66c0f4;
            font-weight: bold;
        }

        select,
        textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #0e1b26;
            color: #c7d5e0;
            margin-bottom: 12px;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        button {
            background: #5c7e10;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #6fa514;
        }

        .danger-button {
            background: #8b1e1e;
        }

        .danger-button:hover {
            background: #a82727;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .action-link {
            background: #2a475e;
            color: white;
            padding: 10px 16px;
            border-radius: 5px;
        }

        .section {
            background: #16202d;
            margin-top: 25px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.18);
        }

        .section h3 {
            margin-top: 0;
            color: white;
        }

        .comment {
            background: #0e1b26;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .comment-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 8px;
            color: #66c0f4;
            font-size: 14px;
        }

        .comment p {
            margin: 0 0 10px;
            line-height: 1.5;
        }

        .guest-notice {
            background: #0e1b26;
            padding: 14px;
            border-radius: 6px;
        }

        @media (max-width: 800px) {
            .game-hero {
                grid-template-columns: 1fr;
            }

            .game-cover,
            .no-image {
                height: 360px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Spēļu kolekcija</h1>

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

    <div class="game-hero">
        <div>
            @if($game->image)
                <img class="game-cover" src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}">
            @else
                <div class="no-image">Nav attēla</div>
            @endif
        </div>

        <div class="game-details">
            <h2>{{ $game->title }}</h2>

            <div class="meta">
                <span class="badge">Žanrs: {{ $game->genre->name ?? 'Nav norādīts' }}</span>
                <span class="badge">Gads: {{ $game->year ?? 'Nav norādīts' }}</span>

                <span class="badge">
                    Statuss:
                    @switch($game->status)
                        @case('velos_spelet')
                            Vēlos spēlēt
                            @break

                        @case('iesakta')
                            Iesākta
                            @break

                        @case('pabeigta')
                            Pabeigta
                            @break

                        @case('atcelta')
                            Atcelta
                            @break

                        @default
                            Nav norādīts
                    @endswitch
                </span>

                <span class="badge">Pievienoja: {{ $game->user->name ?? 'Nezināms' }}</span>
            </div>

            <p class="description">
                {{ $game->description ?: 'Apraksts nav pievienots.' }}
            </p>

            <div class="rating-box">
                <div>Vidējais vērtējums</div>

                <div class="rating-value">
                    @if($game->averageRating())
                        {{ $game->averageRating() }} / 5
                    @else
                        Nav vērtējumu
                    @endif
                </div>
            </div>

            @auth
                <form method="POST" action="{{ route('ratings.store', $game) }}">
                    @csrf

                    <label>Novērtē spēli</label>
                    <select name="rating">
                        <option value="">-- Izvēlies vērtējumu --</option>
                        <option value="1">1 / 5</option>
                        <option value="2">2 / 5</option>
                        <option value="3">3 / 5</option>
                        <option value="4">4 / 5</option>
                        <option value="5">5 / 5</option>
                    </select>

                    <button type="submit">Saglabāt vērtējumu</button>
                </form>
            @else
                <p class="guest-notice">
                    Lai vērtētu spēli, <a href="{{ route('login') }}">pieslēdzies</a>.
                </p>
            @endauth

            <div class="actions">
                <a class="action-link" href="{{ route('games.index') }}">Atpakaļ</a>

                @auth
                    @if(auth()->user()->role === 'admin' || $game->user_id === auth()->id())
                        <a class="action-link" href="{{ route('games.edit', $game) }}">Rediģēt</a>

                        <form method="POST" action="{{ route('games.destroy', $game) }}">
                            @csrf
                            @method('DELETE')
                            <button class="danger-button" type="submit" onclick="return confirm('Tiešām dzēst spēli?')">
                                Dzēst spēli
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Komentāri</h3>

        @forelse($game->comments as $comment)
            <div class="comment">
                <div class="comment-top">
                    <span>{{ $comment->user->name ?? 'Nezināms lietotājs' }}</span>
                    <span>{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                </div>

                <p>{{ $comment->content }}</p>

                @auth
                    @if(auth()->user()->role === 'admin' || $comment->user_id === auth()->id())
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <button class="danger-button" type="submit" onclick="return confirm('Dzēst komentāru?')">
                                Dzēst komentāru
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        @empty
            <p>Komentāru vēl nav.</p>
        @endforelse
    </div>

    <div class="section">
        <h3>Pievienot komentāru</h3>

        @auth
            @if($errors->any())
                <div class="error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('comments.store', $game) }}">
                @csrf

                <textarea name="content" placeholder="Raksti savu komentāru...">{{ old('content') }}</textarea>

                <button type="submit">Pievienot komentāru</button>
            </form>
        @else
            <p class="guest-notice">
                Lai pievienotu komentāru, <a href="{{ route('login') }}">pieslēdzies</a> vai
                <a href="{{ route('register') }}">reģistrējies</a>.
            </p>
        @endauth
    </div>
</div>

</body>
</html>