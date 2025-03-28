import "./bootstrap";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";

window.Alpine = Alpine;



// core version + navigation, pagination modules:
import Swiper from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
// import Swiper and modules styles
import "swiper/css";
// import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/autoplay";

// init Swiper:

window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;
window.Autoplay = Autoplay;

Alpine.plugin(focus);
Alpine.start();
