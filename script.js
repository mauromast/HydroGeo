document.addEventListener('DOMContentLoaded', function() {
    // Funzionalità per il menu mobile
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });
    }

    // --- Funzionalità per il caricamento dinamico di HTML (Footer) ---
    // Funzione per caricare dinamicamente un file HTML in un elemento
    function loadHTML(filePath, elementId) {
        fetch(filePath)
            .then(response => {
                // Controlla se la risposta HTTP è stata un successo
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text(); // Estrai il testo HTML dalla risposta
            })
            .then(htmlContent => {
                // Inserisci il contenuto HTML nell'elemento specificato
                document.getElementById(elementId).innerHTML = htmlContent;
            })
            .catch(error => {
                // Gestisci eventuali errori durante il caricamento
                console.error(`Could not load ${filePath}:`, error);
                // Puoi anche mostrare un messaggio di errore all'utente se lo desideri
                // document.getElementById(elementId).innerHTML = '<p>Errore nel caricamento dei contenuti.</p>';
            });
    }

    // Carica il footer quando il DOM è completamente caricato
    // Assicurati che il tuo file footer.html si trovi nella stessa directory di index.html
    // o aggiorna il percorso 'footer.html' di conseguenza (es. 'includes/footer.html')
    loadHTML('footer.html', 'footer-placeholder');

    // Se in futuro avessi un header dinamico, potresti caricarlo qui:
    // loadHTML('header.html', 'header-placeholder');

});