import $ from 'jquery';

class HeroSlider {
  constructor() {
    this.els = $(".hero-slider");
    this.initSlider();
  }

  initSlider() {
    this.els.slick({
      autoplay: true,
      arrows: false,
      dots: true,
      speed: 1000,
      fade: true,
      autoplaySpeed : 5000,
      cssEase: 'linear'
    });
  }
}

export default HeroSlider;