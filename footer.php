<footer id="main-footer" class="bg-light text-center text-lg-start mt-1 fixed-bottom" style="transition: bottom 0.3s;">
    <div class="text-center p-1 text-muted" style="background-color: #f8f9fa;">
        ©
        <?php echo date("Y"); ?> - Kairos - Todos os direitos reservados.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

let lastScroll = window.scrollY;
let footer = document.getElementById('main-footer');
let ticking = false;

window.addEventListener('scroll', function() {
    if (!ticking) {
        window.requestAnimationFrame(function() {
            let currentScroll = window.scrollY;
            if (currentScroll > lastScroll && currentScroll > 50) {
                // Scroll para baixo
                footer.style.bottom = "0";
            } else {
                // Scroll para cima
                footer.style.bottom = "-60px";
            }
            lastScroll = currentScroll;
            ticking = false;
        });
        ticking = true;
    }
});

// Esconde o footer 
footer.style.bottom = "-60px";
</script>
</body>
</html>