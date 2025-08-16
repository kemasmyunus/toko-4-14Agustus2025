<style>
/* Reset dasar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body & layout */
body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
    background-color: #f8f9fa; /* putih-abu */
}

/* Header */
header {
    background-color: #343a40;
    color: white;
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: flex-start; /* tombol di kiri */
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
}

header h1 {
    font-size: 1.5rem;
}

/* Sidebar */
.sidebar {
    position: fixed;
    top: 60px; /* tinggi header */
    left: 0;
    width: 220px;
    height: calc(100% - 60px);
    background-color: #f1f1f1;
    padding-top: 1rem;
    transition: transform 0.3s ease;
    overflow-y: auto;
}

.sidebar a {
    display: block;
    padding: 0.75rem 1rem;
    color: #333;
    text-decoration: none;
}

.sidebar a:hover {
    background-color: #ddd;
}

/* Konten utama */
.main-content {
    margin-top: 60px;
    margin-left: 220px;
    padding: 1rem;
    transition: margin-left 0.3s ease;
}

/* Sidebar toggle */
.sidebar.collapsed {
    transform: translateX(-220px);
}

.main-content.expanded {
    margin-left: 0;
}

/* Footer */
footer {
    background-color: #343a40;
    color: white;
    text-align: center;
    padding: 1rem;
    position: relative;
    margin-top: auto;
}
</style>
