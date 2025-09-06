<template>
  <div class="card">
    <div class="card-header">Contoh Komponen Vue</div>
    <div class="card-body">
      Saya adalah sebuah komponen Vue.js!
      <p>Pesan saya adalah: {{ message }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: 'Halo dari Vue!'
    };
  }
}
</script>

<style scoped>
.card {
  border: 1px solid blue;
  margin-top: 20px;
}
</style>