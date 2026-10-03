<style>
    :root {
        --neon: #39FF14;
        --ink:  #8FBF8A;
    }
    body        { background: #0A0B0A; color: var(--ink); }
    .neon       { color: var(--neon); }
    .neon-border{ border-color: #16401A; }
    .neon-btn   { background: var(--neon); color: #0A0B0A; }
    .neon-btn:hover { background: #5BFF40; }
    .nav-link       { color: var(--ink); }
    .nav-link:hover { color: var(--neon); }
    .nav-link.active{ color: var(--neon); }

    details.menu > summary {
        list-style: none;
        cursor: pointer;
    }
    details.menu > summary::-webkit-details-marker { display: none; }
    details.menu > summary::after { content: " ▾"; }

    .menu-panel {
        position: absolute;
        right: 0;
        margin-top: .6rem;
        min-width: 11rem;
        background: #0F120F;
        border: 1px solid #16401A;
        border-radius: .375rem;
        padding: .25rem;
        z-index: 50;
    }
    .menu-item {
        display: block;
        width: 100%;
        text-align: left;
        padding: .5rem .75rem;
        border-radius: .25rem;
        color: var(--ink);
    }
    .menu-item:hover { color: var(--neon); background: #16401A; }
    a.link       { color: var(--ink); }
    a.link:hover { color: var(--neon); }
</style>