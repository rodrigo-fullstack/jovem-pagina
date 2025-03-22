import Slider from "./Slider.js";
import ButtonSliderMobile from "./ButtonSliderMobile.js";


export default class SliderMobile extends Slider{
    constructor(elements, btns, current){
        super(elements, btns, current);
    }

    createButtonsForSlider(btns){
        const nextBtn = new ButtonSliderMobile(
            btns.nextBtn, 'next'
        );
        nextBtn.addEventListener(this);
        
        const prevBtn = new ButtonSliderMobile(
            btns.prevBtn, 'prev'
        );
        prevBtn.addEventListener(this);


    }


    
}