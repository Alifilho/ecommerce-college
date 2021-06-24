export default function P(value, type, customClass) {
  const text = document.createElement('p');

  text.appendChild(document.createTextNode(value));

  if (customClass.length > 0) text.className = customClass;

  text.classList.add(type);

  return text;
}
