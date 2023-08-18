<template>
    <div>
<h1>Example Shop</h1>

  <PaymentSystem :change-page="changePage"/>
    <AdminPanel/>
            <PancakeShop/>
    </div>
</template>

<script>
import PancakeShop from './PancakeShop.vue';
import PaymentSystem from './PaymentSystem.vue';
import AdminPanel from './AdminPanel.vue';


export default {
  
    props: ['changePage'],
      components: {
    PancakeShop,
    PaymentSystem,
    AdminPanel
  }
}
</script>
