<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Rediģēt spēli</title>

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
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background: #16202d;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .form-card h2 {
            margin-top: 0;
            color: white;
        }

        .current-image {
            width: 220px;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            background: #000;
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: white;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: none;
            border-radius: 5px;
            margin-bottom: 18px;
            background: #0e1b26;
            color: #c7d5e0;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        button {
            background: #5c7e10;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #6fa514;
        }

        .actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 10px;
        }

        .back-link {
            background: #2a475e;
            color: white;
            padding: 12px 18px;
            border-radius: 5px;
        }

        .error-box {
            background: #8b1e1e;
            color: white;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Spēļu kolekcija</h1>

    <nav>
        <a href="{{ route('games.index') }}">Sākums</a>

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
    <div class="form-card">
        <h2>Rediģēt spēli</h2>

        @if($errors->any())
            <div class="error-box">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if($game->image)
            <label>Pašreizējais attēls</label>
            <img class="current-image" src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}">
        @endif

        <form method="POST" action="{{ route('games.update', $game) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Nosaukums</label>
            <input type="text" name="title" value="{{ old('title', $game->title) }}">

            <label>Apraksts</label>
            <textarea name="description">{{ old('description', $game->description) }}</textarea>

            <label>Gads</label>
            <input type="number" name="year" value="{{ old('year', $game->year) }}">

            <label>Žanrs</label>
            <select name="genre_id">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" @selected(old('genre_id', $game->genre_id) == $genre->id)>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>

            <label>Statuss</label>
            <select name="status">
                <option value="velos_spelet" @selected(old('status', $game->status) == 'velos_spelet')>
                    Vēlos spēlēt
                </option>
                <option value="iesakta" @selected(old('status', $game->status) == 'iesakta')>
                    Iesākta
                </option>
                <option value="pabeigta" @selected(old('status', $game->status) == 'pabeigta')>
                    Pabeigta
                </option>
                <option value="atcelta" @selected(old('status', $game->status) == 'atcelta')>
                    Atcelta
                </option>
            </select>

            <label>Mainīt attēlu</label>
            <input type="file" name="image" accept="image/*">

            <div class="actions">
                <button type="submit">Saglabāt izmaiņas</button>
                <a class="back-link" href="{{ route('games.index') }}">Atpakaļ</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>