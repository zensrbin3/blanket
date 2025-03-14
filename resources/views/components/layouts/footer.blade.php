<footer class="py-3 mt-auto w-100 custom-footer">
    <div class="container d-flex justify-content-between align-items-center">
        <h5 class="app-name" style="font-family: 'Arial', sans-serif; font-size: 24px;">
            {{ __(config('app.name')) }}
        </h5>
        <span class="year text-muted">© 2025</span>
    </div>
</footer>

<style>
    .custom-footer {
        position: relative;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
    }
    .custom-footer::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset("img/test.jfif") }}') no-repeat center center;
        background-size: cover;
        opacity: 0.3;
        z-index: -1;
    }
</style>
