/* ---------------------------------------------------------
   CASAPAN - script.js - VERSIÓN FINAL COMPLETA
--------------------------------------------------------- */

/* ----------------------- PRODUCTS LIST (MENÚ COMPLETO) ----------------------- */
const PRODUCTS = [
  /* BRUNCH */
  { id: 'b1', name: 'Brunch De la Casa', price: 20.00, category: 'brunch', img: 'assets/brunch_casa.jpg', desc: 'Rodajas de pan artesanal, huevo revuelto, jamón ahumado, queso mozzarella y crema de queso.'},
  { id: 'b2', name: 'Brunch Americano', price: 25.00, category: 'brunch', img: 'assets/brunch_americano.jpg', desc: 'Pan artesanal, waffle tipo belga, huevo revuelto con espinacas, jamón ahumado y crema de queso.'},
  { id: 'b3', name: 'Brunch Tipo Integral', price: 22.00, category: 'brunch', img: 'assets/brunch_integral.jpg', desc: 'Empanada integral a elección, huevos revueltos con espinacas y jamón de pollo.'},

  /* SANDWICHES */
  { id: 's1', name: 'Especial de la Casa (Croissant)', price: 13.00, category: 'sandwiches', img: 'assets/croissant_especial.jpg', desc: 'Croissant relleno con jamón y queso.'},
  { id: 's2', name: 'Panini de jamón y queso', price: 20.00, category: 'sandwiches', img: 'assets/panini_jamon.webp', desc: 'Panini con jamón y queso mozzarella.'},
  { id: 's3', name: 'Pan ciabatta jamón y queso', price: 20.00, category: 'sandwiches', img: 'assets/ciabatta_jamon.avif', desc: 'Pan ciabatta con jamón, tomate y espinacas.'},
  { id: 's4', name: 'Pan ciabatta salame y queso', price: 20.00, category: 'sandwiches', img: 'assets/ciabatta_salame.avif', desc: 'Pan ciabatta con salame y queso mozzarella.'},
  { id: 's5', name: 'Bagel de jamón o salame', price: 20.00, category: 'sandwiches', img: 'assets/bagel.jpg', desc: 'Bagel artesanal relleno con jamón o salame.'},
  { id: 's6', name: 'Pan ciabatta integral de pollo', price: 20.00, category: 'sandwiches', img: 'assets/ciabatta_pollo.jpg', desc: 'Ciabatta integral con pollo y espinacas.'},

  /* PIZZAS ARTESANALES */
  { id: 'p_oreg_M', name: 'Pizza Orégano (M)', price: 30.00, category: 'pizzas-artesanales', img: 'assets/pizza_oregano_m.jpg', desc: 'Pizza artesanal de orégano.'},
  { id: 'p_oreg_F', name: 'Pizza Orégano (F)', price: 40.00, category: 'pizzas-artesanales', img: 'assets/pizza_oregano_f.jpg', desc: 'Pizza artesanal familiar de orégano.'},

  { id: 'p_napo_M', name: 'Pizza Napolitana (M)', price: 30.00, category: 'pizzas-artesanales', img: 'assets/pizza_napolitana_m.jpg', desc: 'Pizza napolitana mediana.'},
  { id: 'p_napo_F', name: 'Pizza Napolitana (F)', price: 45.00, category: 'pizzas-artesanales', img: 'assets/pizza_napolitana_f.jpg', desc: 'Pizza napolitana familiar.'},

  { id: 'p_marg_M', name: 'Pizza Margarita (M)', price: 30.00, category: 'pizzas-artesanales', img: 'assets/pizza_margarita_m.jpg', desc: 'Pizza margarita mediana.'},
  { id: 'p_marg_F', name: 'Pizza Margarita (F)', price: 45.00, category: 'pizzas-artesanales', img: 'assets/pizza_margarita_f.jpg', desc: 'Pizza margarita familiar.'},

  { id: 'p_champ_M', name: 'Pizza Champiñones y Aceitunas (M)', price: 35.00, category: 'pizzas-artesanales', img: 'assets/pizza_champi_m.jpg', desc: 'Pizza mediana de champiñones y aceitunas.'},
  { id: 'p_champ_F', name: 'Pizza Champiñones y Aceitunas (F)', price: 50.00, category: 'pizzas-artesanales', img: 'assets/pizza_champi_f.jpg', desc: 'Pizza familiar de champiñones y aceitunas.'},

  { id: 'p_jamon_M', name: 'Pizza Jamón y Queso (M)', price: 35.00, category: 'pizzas-artesanales', img: 'assets/pizza_jamon_m.jpg', desc: 'Pizza jamón y queso mediana.'},
  { id: 'p_jamon_F', name: 'Pizza Jamón y Queso (F)', price: 50.00, category: 'pizzas-artesanales', img: 'assets/pizza_jamon_f.jpg', desc: 'Pizza jamón y queso familiar.'},

  { id: 'p_salame_M', name: 'Pizza Salame (M)', price: 35.00, category: 'pizzas-artesanales', img: 'assets/pizza_salame_m.jpg', desc: 'Pizza de salame mediana.'},
  { id: 'p_salame_F', name: 'Pizza Salame (F)', price: 50.00, category: 'pizzas-artesanales', img: 'assets/pizza_salame_f.jpg', desc: 'Pizza de salame familiar.'},

  /* PIZZAS ESPECIALES */
  { id: 'p_hawa_M', name: 'Pizza Hawaiana (M)', price: 35.00, category: 'pizzas-especiales', img: 'assets/pizza_hawaiana_m.jpg', desc: 'Pizza hawaiana mediana.'},
  { id: 'p_hawa_F', name: 'Pizza Hawaiana (F)', price: 50.00, category: 'pizzas-especiales', img: 'assets/pizza_hawaiana_f.jpg', desc: 'Pizza hawaiana familiar.'},

  { id: 'p_calab_M', name: 'Pizza Calabresa (M)', price: 35.00, category: 'pizzas-especiales', img: 'assets/pizza_calabresa_m.jpg', desc: 'Pizza calabresa mediana.'},
  { id: 'p_calab_F', name: 'Pizza Calabresa (F)', price: 55.00, category: 'pizzas-especiales', img: 'assets/pizza_calabresa_f.jpg', desc: 'Pizza calabresa familiar.'},

  /* TORTAS */
  { id: 't1', name: 'Torta de chocolate (porción)', price: 12.00, category: 'tortas', img: 'assets/tortas_postres.jpg', desc: 'Porción individual de torta de chocolate.'},

  /* BEBIDAS CALIENTES */
  { id: 'c1', name: 'Americano', price: 10.00, category: 'bebidas-calientes', img: 'assets/cafe_americano.webp', desc: 'Café americano caliente.'},
  { id: 'c2', name: 'Latte', price: 12.00, category: 'bebidas-calientes', img: 'assets/latte.webp', desc: 'Café latte cremoso.'},
  { id: 'c3', name: 'Cappuccino', price: 12.00, category: 'bebidas-calientes', img: 'assets/cappuccino.webp', desc: 'Cappuccino espumoso.'},
  { id: 'c4', name: 'Té caliente con agua', price: 8.00, category: 'bebidas-calientes', img: 'assets/tea.webp', desc: 'Té caliente simple.'},
  { id: 'c5', name: 'Cocoa caliente con agua', price: 10.00, category: 'bebidas-calientes', img: 'assets/cocoa_agua.jpg', desc: 'Cocoa preparada con agua.'},
  { id: 'c6', name: 'Cocoa caliente con leche', price: 12.00, category: 'bebidas-calientes', img: 'assets/cocoa_leche.jpg', desc: 'Cocoa con leche.'},

  /* BEBIDAS FRÍAS */
  { id: 'f1', name: 'Doble Espresso frío con leche', price: 15.00, category: 'bebidas-frias', img: 'assets/doble_espreso.jpg', desc: 'Doble espresso frío con leche.'},
  { id: 'f2', name: 'Mocca frío con leche', price: 16.00, category: 'bebidas-frias', img: 'assets/mocca_frio.jpg', desc: 'Mocca frío con leche.'},
  { id: 'f3', name: 'Jugo de durazno (agua)', price: 13.00, category: 'bebidas-frias', img: 'assets/jugo_durazno.jpg', desc: 'Jugo de durazno con agua.'},
  { id: 'f4', name: 'Jugo de frutilla (agua)', price: 13.00, category: 'bebidas-frias', img: 'assets/jugo_frutilla.jpg', desc: 'Jugo de frutilla con agua.'},
  { id: 'f5', name: 'Jugo de maracuyá (agua)', price: 14.00, category: 'bebidas-frias', img: 'assets/maracuya_agua.jpg', desc: 'Jugo de maracuyá con agua.'},
  { id: 'f6', name: 'Jugo de durazno (leche)', price: 15.00, category: 'bebidas-frias', img: 'assets/durazno_leche.jpg', desc: 'Jugo de durazno con leche.'},
  { id: 'f7', name: 'Jugo de frutilla (leche)', price: 15.00, category: 'bebidas-frias', img: 'assets/frutilla_leche.jpg', desc: 'Jugo de frutilla con leche.'},
  { id: 'f8', name: 'Jugo de maracuyá (leche)', price: 16.00, category: 'bebidas-frias', img: 'assets/maracuya_leche.jpg', desc: 'Jugo de maracuyá con leche.'}
];

/* ----------------------- STATE ----------------------- */
let cart = JSON.parse(localStorage.getItem('casapan_cart') || '[]');

/* SHORTCUTS */
const qs = s => document.querySelector(s);
const qsa = s => Array.from(document.querySelectorAll(s));

/* CATEGORY NAMES */
const CATEGORY_NAMES = {
  'brunch': 'Brunch · Desayunos',
  'sandwiches': 'Sandwiches & Panes',
  'pizzas-artesanales': 'Pizzas Artesanales',
  'pizzas-especiales': 'Pizzas Especiales',
  'bebidas-calientes': 'Bebidas Calientes',
  'bebidas-frias': 'Bebidas Frías',
  'tortas': 'Tortas y Postres'
};

/* ----------------------- DOMContentLoaded ----------------------- */
document.addEventListener('DOMContentLoaded', () => {
  initNav();
  renderHomeFeatured();
  renderProductsCategories();
  setupCatalog();
  setupCartUI();
  setupForms();
  setupGallery();
  applyDarkModeFromStorage();
  renderCategoryIfNeeded();
});

/* ----------------------- NAV ----------------------- */
function initNav() {
  qsa('.burger').forEach(b => 
    b.addEventListener('click', () => {
      const nav = b.parentElement.querySelector('.nav-links');
      nav.classList.toggle('open');
    })
  );

  document.addEventListener('click', e => {
    if (e.target.closest('.open-cart')) {
      openCartModal();
    }
  });

  document.addEventListener('click', e => {
    if (e.target.matches('#dark-mode-toggle, #dark-mode-toggle-2, #dark-mode-toggle-3, #dark-mode-toggle-4')) {
      toggleDarkMode();
    }
  });
}

function toggleDarkMode() {
  const html = document.documentElement;
  const light = html.classList.toggle('light-mode');
  if (light) {
    document.documentElement.style.setProperty('--bg','#f5f5f5');
    document.documentElement.style.setProperty('--card','#ffffff');
    document.documentElement.style.setProperty('--text','#0b0b0b');
    document.documentElement.style.setProperty('--muted','#666');
  } else {
    document.documentElement.style.setProperty('--bg','#0f1115');
    document.documentElement.style.setProperty('--card','#141518');
    document.documentElement.style.setProperty('--text','#f4f4f6');
    document.documentElement.style.setProperty('--muted','#9aa0a6');
  }
  localStorage.setItem('casapan_dark', light ? 'light' : 'dark');
}

function applyDarkModeFromStorage() {
  const saved = localStorage.getItem('casapan_dark');
  if (saved === 'light') toggleDarkMode();
}

/* ----------------------- HOME FEATURED ----------------------- */
function renderHomeFeatured() {
  const container = qs('#featured-products');
  if (!container) return;

  const featured = PRODUCTS.slice(0, 4);
  container.innerHTML = '';

  featured.forEach(p => {
    const el = document.createElement('div');
    el.className = 'card';
    el.innerHTML = `
      <img src="${p.img}" alt="${p.name}">
      <h3>${p.name}</h3>
      <p>${p.desc}</p>
      <div class="card-actions">
        <strong>Bs. ${p.price.toFixed(2)}</strong>
        <div>
          <button class="btn" data-info="${p.id}">Ver</button>
          <button class="btn btn-primary" data-add="${p.id}">Agregar</button>
        </div>
      </div>`;
    container.appendChild(el);
  });
}

/* ----------------------- PRODUCTOS.HTML (categorías) ----------------------- */
function renderProductsCategories() {
  // Static categories in HTML – nothing required
}

/* ----------------------- CATÁLOGO ----------------------- */
function setupCatalog() {
  const list = qs('#catalog-list');
  if (!list) return;

  const search = qs('#search');

  function render(items) {
    list.innerHTML = '';

    if (items.length === 0) {
      list.innerHTML = `<p style="color:var(--muted)">No se encontraron productos.</p>`;
      return;
    }

    items.forEach(p => {
      const card = document.createElement('div');
      card.className = 'card';
      card.innerHTML = `
        <img src="${p.img}" alt="${p.name}">
        <h3>${p.name}</h3>
        <p>${p.desc}</p>
        <div class="card-actions">
          <strong>Bs. ${p.price.toFixed(2)}</strong>
          <div>
            <button class="btn" data-info="${p.id}">Ver</button>
            <button class="btn btn-primary" data-add="${p.id}">Agregar</button>
          </div>
        </div>`;
      list.appendChild(card);
    });
  }

  render(PRODUCTS);

  search?.addEventListener('input', () => {
    const q = search.value.toLowerCase();
    const results = PRODUCTS.filter(
      p => p.name.toLowerCase().includes(q) || p.desc.toLowerCase().includes(q)
    );
    render(results);
  });
}

/* ----------------------- PRODUCTOS-LISTA.HTML ----------------------- */
function renderCategoryIfNeeded() {
  const container = qs('#category-products');
  if (!container) return;

  const params = new URLSearchParams(window.location.search);
  const cat = params.get('cat') || 'brunch';
  const title = CATEGORY_NAMES[cat] || cat;

  qs('#category-title').innerText = title;
  qs('#category-desc').innerText = `Listado de productos · ${title}.`;

  const items = PRODUCTS.filter(p => p.category === cat);

  if (items.length === 0) {
    container.innerHTML = `<p>No hay productos en esta categoría.</p>`;
    return;
  }

  container.innerHTML = '';

  items.forEach(p => {
    const row = document.createElement('div');
    row.className = 'products-list-row';
    row.innerHTML = `
      <div>
        <h4>${p.name}</h4>
        <div style="color:var(--muted)">${p.desc}</div>
      </div>
      <div class="price">Bs. ${p.price.toFixed(2)}</div>`;
    container.appendChild(row);
  });
}

/* ----------------------- CART ----------------------- */
function setupCartUI() {
  updateCartCount();

  qs('#close-cart')?.addEventListener('click', () => {
    qs('#cart-modal').classList.add('hidden');
  });

  document.addEventListener('click', e => {
    const add = e.target.closest('[data-add]');
    if (add) addToCart(add.dataset.add);

    const info = e.target.closest('[data-info]');
    if (info) showProductModal(info.dataset.info);

    const dec = e.target.closest('[data-cart-dec]');
    if (dec) changeQty(dec.dataset.cartDec, -1);

    const inc = e.target.closest('[data-cart-inc]');
    if (inc) changeQty(inc.dataset.cartInc, +1);

    const rem = e.target.closest('[data-cart-rem]');
    if (rem) removeFromCart(rem.dataset.cartRem);
  });

  qs('#checkout-btn')?.addEventListener('click', handleCheckout);
}

function openCartModal() {
  qs('#cart-modal').classList.remove('hidden');
  renderCartItems();
}

function addToCart(id, qty = 1) {
  const item = cart.find(p => p.id === id);
  if (item) {
    item.qty += qty;
  } else {
    cart.push({ id, qty });
  }

  cart.forEach(i => i.qty = Math.max(1, Math.floor(i.qty)));
  localStorage.setItem('casapan_cart', JSON.stringify(cart));
  updateCartCount();
}

function updateCartCount() {
  const total = cart.reduce((s, p) => s + p.qty, 0);
  qsa('#cart-count').forEach(c => c.innerText = total);
}

function renderCartItems() {
  const c = qs('#cart-items');
  if (!c) return;

  c.innerHTML = '';

  if (cart.length === 0) {
    c.innerHTML = `<p>Tu carrito está vacío.</p>`;
    qs('#cart-total').innerText = 'Bs. 0.00';
    return;
  }

  cart.forEach(i => {
    const p = PRODUCTS.find(x => x.id === i.id);

    const row = document.createElement('div');
    row.className = 'cart-row';
    row.innerHTML = `
      <div style="display:flex;gap:10px;align-items:center">
        <img src="${p.img}" alt="${p.name}" style="width:60px;height:80px;object-fit:cover;border-radius:8px">
        <div>
          <strong>${p.name}</strong>
          <div style="color:var(--muted)">Bs. ${p.price} x ${i.qty}</div>
        </div>
      </div>
      <div style="display:flex;gap:8px">
        <button class="btn" data-cart-dec="${p.id}">-</button>
        <button class="btn" data-cart-inc="${p.id}">+</button>
        <button class="btn" data-cart-rem="${p.id}">Eliminar</button>
      </div>`;
    c.appendChild(row);
  });

  const total = cart.reduce((s, i) => {
    const p = PRODUCTS.find(x => x.id === i.id);
    return s + p.price * i.qty;
  }, 0);

  qs('#cart-total').innerText = `Bs. ${total.toFixed(2)}`;
}

function changeQty(id, delta) {
  const item = cart.find(i => i.id === id);
  if (!item) return;

  item.qty += delta;

  if (item.qty <= 0) {
    cart = cart.filter(i => i.id !== id);
  }

  localStorage.setItem('casapan_cart', JSON.stringify(cart));
  renderCartItems();
  updateCartCount();
}

function removeFromCart(id) {
  cart = cart.filter(i => i.id !== id);
  localStorage.setItem('casapan_cart', JSON.stringify(cart));
  renderCartItems();
  updateCartCount();
}

/* ----------------------- CHECKOUT ----------------------- */
function handleCheckout() {
  if (cart.length === 0) return alert('Carrito vacío');

  alert('Pedido enviado. Gracias.');
  cart = [];
  localStorage.removeItem('casapan_cart');
  renderCartItems();
  updateCartCount();
}

/* ----------------------- FORMS ----------------------- */
function setupForms() {
  const f = qs('#order-form');
  if (!f) return;

  f.addEventListener('submit', e => {
    e.preventDefault();
    alert('Formulario enviado.');
    f.reset();
  });
}

/* ----------------------- GALLERY (NO FLECHAS) ----------------------- */
function setupGallery() {
  const imgs = qsa('.gallery-grid img');
  if (imgs.length === 0) return;

  imgs.forEach(img => {
    img.addEventListener('click', () => {
      openGalleryModal(img.src, img.alt);
    });
  });
}

function openGalleryModal(src, alt) {
  const modal = qs('#gallery-modal');
  const inner = modal.querySelector('.gallery-modal-inner');

  inner.innerHTML = `
    <button class="close" id="close-gallery">✕</button>
    <img src="${src}" alt="${alt}">`;

  modal.classList.remove('hidden');

  qs('#close-gallery').addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  modal.addEventListener('click', e => {
    if (e.target === modal) modal.classList.add('hidden');
  });
}

/* ----------------------- PRODUCT MODAL ----------------------- */
function showProductModal(id) {
  const p = PRODUCTS.find(x => x.id === id);
  const modal = qs('#product-modal');
  const inner = qs('#product-modal-inner');

  inner.innerHTML = `
    <img src="${p.img}" alt="${p.name}">
    <h3>${p.name}</h3>
    <p>${p.desc}</p>
    <p style="margin-top:10px;font-weight:bold">Bs. ${p.price.toFixed(2)}</p>
    <button class="btn btn-primary" data-add="${p.id}">Agregar al carrito</button>
  `;

  modal.classList.remove('hidden');

  qs('#close-product-modal').onclick = () => modal.classList.add('hidden');

  modal.addEventListener('click', e => {
    if (e.target === modal) modal.classList.add('hidden');
  });
}

