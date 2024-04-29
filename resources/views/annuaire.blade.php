<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LyonPalme</title>
    
    <!-- Lien fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body>
<section id="container">
    <header>
        <div class="header-container">
            <div class="logo-menu">
                <div class="logo1">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo1">
                </div>
                <hr>
                <nav class="menu-navigation">
                    <ul>
                        <li><a href="{{ route('welcome') }}">Accueil</a></li>
                        <li><a href="#">Activités</a></li>
                        <li><a href="#">Agenda du club</a></li>
                        <li><a href="#">Les Stages</a></li>
                        <li><a href="#">Nous contacter</a></li>
                        @if(auth()->check())
                        <li><a href="{{ route('list') }}">Liste des Adhérents</a></li>
                        <li><a href="{{ route('annuaire') }}">Annuaire</a></li>
                        <li><a href="{{ route('trombinoscope') }}">Trombinoscope</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="auth">
                
            

                @if(auth()->check())
                    <a href="{{ route('profile.edit') }}">{{ decrypt(Auth::user()->name) }} {{ decrypt(Auth::user()->first_name) }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 

                @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Déconnexion  
                </a>
                
                @else
                    <a href="{{ route('login') }}">Connexion</a>
                @endif
            </div>
        </div>
    </header>
    
    <section class="list-container" id="list-container">
    <div class="list">
        <h1 style="margin-top: 10vh; text-align: center; font-size: 35px; color: #483285;">Annuaire</h1>
        <form id="searchForm"> 
            <input type="search" name="terme" id="searchInput">
            <input type="submit" name="s" value="Rechercher">
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->acceptpartagedonnees)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</section>

<script>
    document.getElementById("searchForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var searchTerm = document.getElementById("searchInput").value;
        var searchElement = document.querySelector('input[name="s"]');
        searchElement.scrollIntoView({ behavior: 'smooth' });
        // You can add additional logic here to handle the search functionality
    });
</script>

</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Copyright © LyonPalme, créé par Nolan, Matteo, Rania, Elyes & Sonny</p>
            </div>
        </div>
    </div>
</footer>


</body>
</html>