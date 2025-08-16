<?php
echo '<footer>
    &copy; ' . date("Y") . ' Dashboard Toko
</footer>
<script>
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const content = document.querySelector(".main-content");
    sidebar.classList.toggle("collapsed");
    content.classList.toggle("expanded");
}
</script>';
