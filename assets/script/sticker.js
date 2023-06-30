/*
const sticker = document.getElementsByClassName('sticker');

// Check if the effect should be played
const shouldPlayEffect = localStorage.getItem('playStickerEffect') === 'true';

// Play the effect if necessary
if (shouldPlayEffect) {
    playStickerEffect();
}

window.addEventListener('load', () => {
    // Play the effect and set the flag in localStorage
    playStickerEffect();
    localStorage.setItem('playStickerEffect', 'true');
});

function playStickerEffect() {
    gsap.timeline()
        .set(sticker, { scale: 0.8, opacity: 1 })
        .to(sticker, { scale: 1.2, duration: 0.2 })
        .to(sticker, { scale: 1, duration: 0.2 });
}
*/
