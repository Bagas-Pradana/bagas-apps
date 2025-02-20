
<script src="{{ asset('js/script.js') }}"></script>
<script>
    const dropdownButton = document.getElementById('dropdownDefaultButton');
    const dropdown = document.getElementById('dropdown');

    dropdownButton.addEventListener('click', function() {
        dropdown.classList.toggle('hidden');
    });
</script>
</body>
</html>
