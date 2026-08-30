<script>
// Dark mode toggle
document.addEventListener('DOMContentLoaded', function() {
    const lightSwitch = document.getElementById('light-switch');
    if (lightSwitch) {
        // Check for dark mode preference
        if (localStorage.getItem('dark-mode') === 'true' || !localStorage.getItem('dark-mode')) {
            document.documentElement.classList.add('dark');
            if (lightSwitch) lightSwitch.checked = true;
        }

        // Listen for toggle
        lightSwitch.addEventListener('change', function() {
            if (this.checked) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('dark-mode', 'true');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('dark-mode', 'false');
            }
        });
    }
});
</script>
