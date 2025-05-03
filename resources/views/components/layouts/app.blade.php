<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>  
        <audio id="bg-music" autoplay loop muted>
            <source src="{{ asset('storage/backgroundmusic/music.mp3') }}" type="audio/mpeg">
        </audio>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const audio = document.getElementById('bg-music');
        
                // Unmute and start audio on first interaction
                function enableAudio() {
                    audio.muted = false;
                    audio.play().catch(err => console.log('Play blocked:', err));
                    window.removeEventListener('click', enableAudio);
                    window.removeEventListener('scroll', enableAudio);
                }
        
                // Allow play after any user gesture
                window.addEventListener('click', enableAudio);
                window.addEventListener('scroll', enableAudio);
        
                // Pause audio on double-click anywhere
                document.addEventListener('dblclick', () => {
                    if (!audio.paused) {
                        audio.pause();
                    } else {
                        audio.play().catch(err => console.log('Resume failed:', err));
                    }
                });
            });
        </script>      
        {{ $slot }}      
    </flux:main>
</x-layouts.app.sidebar>
