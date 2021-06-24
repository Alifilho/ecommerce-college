export const style = (styles, element) => {
  Object.entries(styles).forEach((style) => {
    const [key, value] = style;

    element.style[key] = value;
  });

  return element;
};
