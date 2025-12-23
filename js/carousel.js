const images = document.querySelectorAll(".carousel-img");

let index = 0;

document.querySelector(".next").onclick = () => {
  images[index].classList.remove("active");
  index = (index + 1) % images.length;
  images[index].classList.add("active");
};

document.querySelector(".prev").onclick = () => {
  images[index].classList.remove("active");
  index = (index - 1 + images.length) % images.length;
  images[index].classList.add("active");
};