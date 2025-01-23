@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')

<main class="flex-center">
    <section class="structure">
        <h1 class="page-title">Bonjour, {{ Auth::guard('admin')->user()->name }}</h1>
      
        <div class="scraping-controls results">
            <h2>Votre collection actuelle dans l'application : <span id="total-bottles">{{ $totalBottles }}</span> bouteilles</h2>
            <p>Commencez à importer les bouteilles depuis <a class="link" href="https://www.saq.com/fr/produits/vin" target="_blank">
            SAQ</a></p>
            <div class="btn-container">
                <button id="start-scraping" class="btn btn-icon ">Start Scraping <i class="fa-solid fa-circle-play"></i></button>
                <button id="stop-scraping" class="btn btn-icon ">Stop Scraping <i class="fa-regular fa-circle-pause"></i></button>
            </div>
            <div class="scraping-process">
                <span class="loader_start hide"></span>
                <span class="loader_stop hide"></span>
                <p id="scraping-status" style="margin-top: 10px;"></p>
            </div>
        </div>
    </section>
</main>


<script>
    function updateTotalBottles() {
        fetch('{{ route('bottle.total_bottles') }}')
            .then(response => response.json())
            .then(data => {
                // Update the total bottles count in the UI
                document.getElementById('total-bottles').textContent = data.totalBottles;
            })
            .catch(error => console.error('Error fetching total bottles:', error));
    }

    // Call the function every 10 seconds
    setInterval(updateTotalBottles, 10000);

    // Call it once on page load to initialize
    updateTotalBottles();
</script>



<!--Scraping--->
<script>
        document.getElementById('start-scraping').addEventListener('click', function () {
        const statusText = document.getElementById('scraping-status');
        const loaderStart = document.querySelector('.loader_start');
        const loaderStop = document.querySelector('.loader_stop');

        // Show the starting loader and hide the stopping loader
        loaderStart.classList.remove('hide');
        loaderStop.classList.add('hide');

        statusText.textContent = 'Scraping en cours...';
        
        

        fetch('/scrape-bouteilles')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusText.textContent = data.message;
                } else {
                    statusText.textContent = 'Scraping échoué.';
                }
            })
            .catch(err => {
                console.error('Error during scraping:', err);
                statusText.textContent = "Une erreur s'est produite. Veuillez réessayer.";
            })
            .finally(() => {
                // Hide the loader once scraping starts successfully
                loaderStart.classList.add('hide');
            });
    });


    document.getElementById('stop-scraping').addEventListener('click', function () {
        const statusText = document.getElementById('scraping-status');

        statusText.textContent = 'Arrêter le scraping...';

        fetch('/scraping/stop')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusText.textContent = data.message;
                    // Refresh the page after a short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000); // 1 second delay before refreshing
                } else {
                    statusText.textContent = "Impossible d'arrêter.";
                }
            })
            .catch(err => {
                console.error('Error during stop:', err);
                statusText.textContent = "Une erreur s'est produite lors de l'arrêt du scraping.";
            })
            .finally(() => {
                // Hide the loader once scraping stops successfully
                loaderStop.classList.add('hide');
            });
    });

    </script>

@endsection