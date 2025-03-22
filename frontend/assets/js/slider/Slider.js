import ButtonSlider from "./ButtonSlider.js";
import SliderDesktop from "./SliderDesktop.js";
import SliderMobile from "./SliderMoblie.js";


export default class Slider {
    static instantiateSlider(data) {
        if (data.widthScreen <= 1024) {
            return new SliderMobile(
                data.elements,
                data.btns,
                0
            );
        }

        return new SliderDesktop(
            data.elements,
            data.btns,
            [0, 1, 2]
        );
    }

    constructor(elements, btns, current) {
        this.elements = elements;
        this.btns = btns;
        this.current = current;
        this.inAnimation = false;

        this.createButtonsForSlider(btns);
    }

    createButtonsForSlider(btns) {
        const nextBtn = new ButtonSlider(
            btns.nextBtn, 'next'
        );
        nextBtn.addEventListener(this);

        const prevBtn = new ButtonSlider(
            btns.prevBtn, 'prev'
        );
        prevBtn.addEventListener(this);


    }



}