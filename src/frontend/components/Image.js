export default function Image(srcImage, classes) {
  const image = document.createElement('img');

  image.setAttribute('src', srcImage);

  image.className = classes;
  image.classList.add('img-fluid');

  return image;
}
