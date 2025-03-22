import Slider from './slider/Slider.js';

console.log('largura da tela: ' + window.innerWidth);
console.log('altura da tela: ' + window.innerHeight);
const sliders = document.querySelectorAll('.slider');

console.log(sliders);

sliders.forEach(slider => {
    const sliderObject = Slider.instantiateSlider(
        {
            elements: slider.children[0].children,
            btns: {
                'nextBtn': slider.children[2],
                'prevBtn': slider.children[1]    
            },
            widthScreen: window.innerWidth
        }
    );

    console.log(slider.children[0].children);
    
    
    
})

// const slider = new Slider(

// );