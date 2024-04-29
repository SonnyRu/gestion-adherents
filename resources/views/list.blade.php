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
                        <li><a href="#">Liste des Adhérents</a></li>
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
            <h1 style="margin-top: 10vh; text-align: center; font-size: 35px; color: #483285;">Liste des utilisateurs</h1>
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
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <a href="{{ route('editad', $user) }}" class="btn btn-primary">Modifier</a>
                            <!-- Ajout du bouton "Archiver" plus tard -->

                    
                        <form action="{{ route('user.archive', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if(Auth::user()->id !== $user->id)
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir archiver cet utilisateur?')">Archiver</button>
                            @else
                            <p> </p>
                            @endif
                        </form>
                        
                        
                            
                            

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <script>
    function confirmArchive(userId) {
        if (confirm("Êtes-vous sûr de vouloir archiver cet utilisateur ?")) {
            //----
            
        }
    }

    function LastArchive(userId) {
        if (LastArchive("")) {
            //----
            
        }
    }
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