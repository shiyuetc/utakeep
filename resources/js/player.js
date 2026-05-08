const circumference = 298.1371428256714;

const playerTemplate = (size) => `
    <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size}" data-play class="not-started playable">
        <g class="shape">
            <circle class="progress-track" cx="50" cy="50" r="47.45" stroke="#ffffff" stroke-opacity="0.5" stroke-linecap="round" fill="none" stroke-width="5"/>
            <circle class="precache-bar" cx="50" cy="50" r="47.45" stroke="#ffffff" stroke-opacity="0.35" stroke-linecap="round" fill="none" stroke-width="5" transform="rotate(-90 50 50)"/>
            <circle class="progress-bar" cx="50" cy="50" r="47.45" stroke="#534AB7" stroke-opacity="1" stroke-linecap="round" fill="none" stroke-width="5" transform="rotate(-90 50 50)"/>
        </g>
        <circle class="controls" cx="50" cy="50" r="45" stroke="none" fill="#000000" opacity="0" pointer-events="all"/>
        <g class="control pause">
            <line x1="40" y1="35" x2="40" y2="65" stroke="#ffffff" fill="none" stroke-width="8" stroke-linecap="round"/>
            <line x1="60" y1="35" x2="60" y2="65" stroke="#ffffff" fill="none" stroke-width="8" stroke-linecap="round"/>
        </g>
        <g class="control play">
            <polygon points="43,34 67,50 43,66" fill="#ffffff" stroke-width="0"></polygon>
        </g>
    </svg>
`;

const setCircleValue = (circle, value, duration) => {
    if (!circle || !duration) {
        return;
    }

    const offset = circumference - ((value / duration) * circumference);
    circle.style.strokeDashoffset = offset;
};

const stopOtherPlayers = (currentAudio) => {
    document.querySelectorAll('.mediPlayer audio').forEach((audio) => {
        if (audio !== currentAudio) {
            audio.pause();
            audio.currentTime = 0;

            const player = audio.closest('.mediPlayer');
            player?.querySelector('[data-play]')?.setAttribute('class', 'not-started playable');
            setCircleValue(player?.querySelector('.progress-bar'), 0, 1);
        }
    });
};

const initPlayer = (player) => {
    if (player.dataset.playerReady === 'true') {
        return;
    }

    const audio = player.querySelector('audio');
    if (!audio) {
        return;
    }

    player.dataset.playerReady = 'true';
    audio.volume = Number(player.dataset.volume ?? 0.15);
    audio.preload = 'metadata';

    const size = audio.dataset.size || player.dataset.size || 34;
    player.insertAdjacentHTML('beforeend', playerTemplate(size));

    const svg = player.querySelector('[data-play]');
    const controls = player.querySelector('.controls');
    const progress = player.querySelector('.progress-bar');
    const precache = player.querySelector('.precache-bar');

    controls?.addEventListener('click', () => {
        if (audio.paused) {
            stopOtherPlayers(audio);

            audio.play()
                .then(() => {
                    svg?.setAttribute('class', 'playable playing');
                })
                .catch(() => {
                    svg?.setAttribute('class', 'not-started playable');
                });

            return;
        }

        audio.pause();
        audio.currentTime = 0;
        svg?.setAttribute('class', 'not-started playable');
        setCircleValue(progress, 0, 1);
    });

    audio.addEventListener('timeupdate', () => {
        setCircleValue(progress, audio.currentTime, audio.duration);
    });

    audio.addEventListener('progress', () => {
        if (audio.buffered.length === 0) {
            return;
        }

        setCircleValue(precache, audio.buffered.end(audio.buffered.length - 1), audio.duration);
    });

    audio.addEventListener('ended', () => {
        svg?.setAttribute('class', 'ended playable');
        setCircleValue(progress, 0, 1);
    });
};

const initPlayers = (root = document) => {
    root.querySelectorAll?.('.mediPlayer').forEach(initPlayer);
};

document.addEventListener('DOMContentLoaded', () => initPlayers());
document.addEventListener('livewire:navigated', () => initPlayers());

new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
            if (node.nodeType !== Node.ELEMENT_NODE) {
                return;
            }

            if (node.matches?.('.mediPlayer')) {
                initPlayer(node);
                return;
            }

            initPlayers(node);
        });
    });
}).observe(document.documentElement, {
    childList: true,
    subtree: true,
});
