export default function Button(title, handleClick) {
  const button = document.createElement('button');

  button.innerText = title;

  button.onclick = handleClick;

  button.className = 'btn btn-primary';

  return button;
}
