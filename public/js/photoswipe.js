import PhotoSwipeLightbox from 'https://unpkg.com/photoswipe/dist/photoswipe-lightbox.esm.js';

let images = document.querySelectorAll('#photoswipe-gallery > a');

images.forEach(image => {
    image.setAttribute("data-pswp-width", image.querySelector('img').naturalWidth);
    image.setAttribute("data-pswp-height", image.querySelector('img').naturalHeight);
});

const lightbox = new PhotoSwipeLightbox({
  gallery: '#photoswipe-gallery',
  children: 'a',
  pswpModule: () => import('https://unpkg.com/photoswipe'),
});

lightbox.init();


