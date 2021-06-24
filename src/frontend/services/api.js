export const get = async (route) =>
  await (
    await fetch(
      `http://127.0.0.1/Facul/ecommerce-macedo/src/api/controllers/${route}Controller.php`
    )
  ).json();
