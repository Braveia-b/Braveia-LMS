        </main>

        <footer class="admin-site-footer">
            <span>&copy; <?= date('Y') ?> Brave International Academy</span>
            <span class="float-end d-none d-sm-inline">Panel Admin v1.0</span>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('adminSidebarOverlay');
    var toggle = document.getElementById('adminSidebarToggle');

    function openSidebar() {
        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');
        document.body.style.overflow = '';
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            sidebar.classList.contains('is-open') ? closeSidebar() : openSidebar();
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) closeSidebar();
    });
})();
</script>
</body>
</html>
