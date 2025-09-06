// import './bootstrap';

import { createApp } from 'vue';

// Impor komponen Vue Anda di sini
import ExampleComponent from './components/ExampleComponent.vue';

// 1. Cari elemen yang akan menjadi "wadah" Vue
const vueContainer = document.getElementById('vue-container');

// const app = createApp({});

// // Daftarkan komponen Anda di sini
// app.component('example-component', ExampleComponent);

// // "Mount" aplikasi Vue ke elemen dengan id="app" di file Blade Anda
// app.mount('#app');

// 2. HANYA jalankan Vue jika wadah tersebut ditemukan di halaman saat ini
if (vueContainer) {
    const app = createApp({});

    // Daftarkan komponen Vue Anda di sini
    app.component('example-component', ExampleComponent);

    // Pasang aplikasi Vue HANYA ke wadah tersebut
    app.mount('#vue-container');
}