

export default class ButtonSlider{
    constructor(element, name){
        this.element = element;
        this.name = name;
    }

    addEventListener(slider){

        if(this.name === 'next'){
            this.element.addEventListener('click', () => {
                this.passToNextElement(slider);
            });
            return;
        }
    
        if(this.name === 'prev'){
            this.element.addEventListener('click', () => {
                this.passToPrevElement(slider)
            });
            return
        }

        throw new Exception('Invalid button');
    }
    passToNextElement(slider){
        console.log(slider);
    }

    passToPrevElement(slider){
        console.log(slider)
    }


}