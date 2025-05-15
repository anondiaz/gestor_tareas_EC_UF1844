<script>
  const btn = document.getElementById('hamburger-btn');
  const menu = document.getElementById('nav-menu');

  btn.addEventListener('click', () => {
    menu.classList.toggle('active');
    btn.classList.toggle('open'); // para animar icono si quieres
  });
</script>
