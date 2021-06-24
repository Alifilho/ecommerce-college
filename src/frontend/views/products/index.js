import Button from '../../components/Button.js';
import Text from '../../components/Text.js';
import Container from '../../components/Container.js';
import Image from '../../components/Image.js';

import { style } from '../../utils/style.js';
import { formatCurrency } from '../../utils/format.js';

import { get } from '../../services/api.js';

const setUpProducts = (products) => {
  const productsDiv = style(
    { maxWidth: '70%' },
    Container('justify-content-center mt-5')
  );

  products.forEach((product) => {
    const card = style({ maxWidth: '15%' }, Container('card mx-2'));

    card.appendChild(
      Image(
        'https://cf.shopee.com.br/file/70e261bea12cb0e99c886bbb627651db',
        'card-img-top'
      )
    ); // Create product image

    const cardBody = Container('card-body flex-column justify-content-between');

    const texts = Container('flex-column');
    texts.appendChild(
      style({ fontSize: '1rem' }, Text(product.name, 'h5', 'card-title'))
    ); // Create title product
    texts.appendChild(
      style(
        { fontSize: '0.9rem' },
        Text(
          formatCurrency(Number(product.amount)),
          'p',
          'card-subtitle text-muted'
        )
      )
    ); // Create subtitle product
    cardBody.appendChild(texts);

    cardBody.appendChild(
      Button('Buy', () => {
        console.log(product);
      })
    ); // Create button buy

    card.appendChild(cardBody);

    productsDiv.appendChild(card);
  });

  return productsDiv;
};

const main = async () => {
  const products = await get('Products');
  const div = setUpProducts(products);

  const main = document.querySelector('#main');
  main.appendChild(div);
};

main();
