export default function Container(classes) {
  const div = document.createElement('div');

  if (classes) div.className = classes;

  div.classList.add('d-flex');

  return div;
}
