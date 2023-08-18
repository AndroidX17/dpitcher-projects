<template> 
  <div>
    <div v-if="message">{{ message }}</div>

    <div class="shop-header">
      <p>Welcome to our online shop, we accept bitcoin<!--and ethereum-->.</p>
    </div>
  <div class="shop-descr">
      <!--  <p><img src="/coinicons/EXCLAMATION.png" alt="heads up" class="small-image"/>WARNING! Please only send ETH/Ethereum to the ETH address, no ERC-20 or anything else!! <b> we cannot receive them!</b></p>-->
   <!-- <p>After adding items to cart, you can check out at the very bottom.</p>
      <p><img src="/coinicons/EXCLAMATION.png" alt="heads up" class="small-image"/>Disclaimer! These are all test items on the shop. <b>  Please don't buy them yet.</b></p>-->
      <p>If you know your transaction hash, you can look up the status of your payment. </p><p>It can take up to an hour for a payment to be reflected on your account.</p>
    </div>



  <div class="transaction-status-check">
      <h2>Check Payment Status</h2>
<input type="text" v-model="bitcoinTxHash" class="txHash-input" placeholder="Enter your Bitcoin transaction hash">

      <button @click="checkBitcoinPaymentStatus">Check Payment Status</button>
      <div v-if="bitcoinPaymentStatusMessage" :class="{'payment-status-success': bitcoinPaymentStatus, 'payment-status-error': !bitcoinPaymentStatus}">
        {{ bitcoinPaymentStatusMessage }}
      </div>
<!--
      <input type="text" v-model="ethereumTxHash" class="txHash-input" placeholder="Enter your Ethereum transaction hash">
      <button @click="checkEthereumPaymentStatus">Check Ethereum Payment Status</button>
      <div v-if="ethereumPaymentStatusMessage" :class="{'payment-status-success': ethereumPaymentStatus, 'payment-status-error': !ethereumPaymentStatus}">
        {{ ethereumPaymentStatusMessage }}
      </div>-->
 
    </div>

    <div class="grid-container" v-if="!loading || !isLoggedIn">
      <div v-for="item in items" :key="item.id" class="item">
        <img :src="item.image_url" alt="Item image" class="item-image"/>
        <div class="item-content">
          <h2>{{ item.name }}</h2>
          <p>{{ item.description }}</p>
          <p>{{ item.price }} btc</p>
      
<p>Stock: {{ item.stock }}</p>

      <div v-if="itemInCart === item.id" class="cart-feedback">Added to cart!</div>

<div class="button-wrapper">
<button v-if="item.id !== '37' || (item.id === '37' && !hasUserPurchased('37'))" @click="addToCart(item)">Add to Cart</button>
<button v-else @click="downloadItem(item)">Download</button>

</div>

      <button v-if="userRole === 'admin'" @click="deleteItem(item)">Delete</button>
  
        </div>
      </div>
    </div>
    <div v-else>Loading Shop...</div>  

<div class="cart-container" v-if="cart.length > 0">
  
    <img src="/coinicons/cart.png" alt="Cart"/>
      <h2>Your Cart</h2>
      <div v-for="(cartItem, index) in cart" :key="cartItem.item.id">
        <p>{{ cartItem.item.name }} - {{ parseFloat(cartItem.item.price) }} btc x {{ cartItem.quantity }}</p>
        <button @click="removeFromCart(index)">Remove one</button>
      </div>
<p>Total: {{ totalCost }} btc</p>
<div v-if="checkoutMessage" class="checkout-feedback">{{ checkoutMessage }}</div>
<button @click="checkout">Checkout</button>
</div>

<button @click="toggleOrderHistory">{{ showOrderHistory ? 'Hide' : 'Show' }} Order History</button>

<div v-if="showOrderHistory">
  <h2>Your Order History</h2>

  <div v-if="orderHistory.length > 0">
    <div v-for="order in orderHistory" :key="order.id">
      <h3>Order ID: {{ order.id }}</h3>
      <p>Order Total: {{ order.order_total }}</p>
      <p>Order Date: {{ order.created_at }}</p>
      <p>Product Name: {{ order.product_name }}</p>
      <p>Quantity: {{ order.quantity }}</p>
      <p>Price: {{ order.price }}</p>
    </div>
  </div>

  <div v-else>
    <p>You have no orders yet.</p>
  </div>

</div>

  </div>
</template>

<script>
import axios from 'axios';
import jwt_decode from 'jwt-decode';
import { watch } from 'vue';
import sharedState from '../sharedState.js';
export default {
  name: 'PancakeShop',
  computed: {
hasUserPurchased: function() {
    return (itemId) => {
        const hasPurchased = this.purchasedItems.some(item => {
          
           return item.product_id.toString() === itemId.toString();
        });         
   
        return hasPurchased;
    }
},
totalCost() {
  return this.cart.reduce((total, cartItem) => total + (parseFloat(cartItem.item.price) * cartItem.quantity), 0);
},
  },
  data() {
    return {
        loading: true,  
      isLoggedIn: false,  
      items: [],
      cart: [],
      purchasedItems: [],
      userRole: '', 
    itemInCart: null,
      feedbackTimer: null,
      username: '', 
      userId: '', 
    message: '',
    userBalance: 0,
    checkoutMessage: '',
            orderHistory: [],
    showOrderHistory: false,
      bitcoinTxHash: '',
      bitcoinPaymentStatus: null,
      bitcoinPaymentStatusMessage: '',  
      ethereumTxHash: '',
      ethereumPaymentStatus: null,
      ethereumPaymentStatusMessage: '',
    }
  },
  methods: {
getPurchasedItems() {
    const jwt = localStorage.getItem('token');
    if (jwt) {
        this.isLoggedIn = true;  

        const decoded = jwt_decode(jwt);
        const userId = decoded.sub;

   
        axios.get('https://www.mortalitycore.com/api/v1/getPurchasedItems.php', {
            params: {
                user_id: userId
            }
        })
        .then(response => {
            this.updatePurchasedItems(response.data.purchasedItems);
            const product37Purchased = this.purchasedItems.some(item => item.product_id === 37);
                this.loading = false; 
        })
        .catch(error => {
            console.log("API error:", error); 
            this.loading = false; 
        });
    } else {
        this.loading = false; 
    }
},

updatePurchasedItems(purchasedItems) {
    this.purchasedItems = purchasedItems.map(item => ({...item, product_id: parseInt(item.product_id)}));
},


 toggleOrderHistory() {
    this.showOrderHistory = !this.showOrderHistory;
    if (this.showOrderHistory) {
      this.fetchOrderHistory(); 
    }
  },
async downloadItem(item) {
  try {
    
    const response = await axios.get('https://www.mortalitycore.com/api/v1/getDownloadLink.php', {
      params: {
        product_id: item.id
      }
    });

    window.open(response.data.downloadLink, '_blank');
  } catch (error) {
    console.log("API error:", error); 
  }
},

    checkBitcoinPaymentStatus() {
      axios.get(`https://www.mortalitycore.com/api/v1/check_payment_status.php?txHash=${this.bitcoinTxHash}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
      .then(response => {
  if (response.data.status === 'success') {
    this.bitcoinPaymentStatusMessage = response.data.message;
    this.bitcoinPaymentStatus = response.data.message === 'Payment processed successfully';
  } else {
    this.bitcoinPaymentStatus = false;
    this.bitcoinPaymentStatusMessage = response.data.message;
  }
})
      .catch(error => {
        this.bitcoinPaymentStatus = false;
        this.bitcoinPaymentStatusMessage = 'There was an error checking the payment status.';
        console.log(error);
      });
    },
        fetchOrderHistory() {
            const jwt = localStorage.getItem('token');
            if (jwt) {
                const decoded = jwt_decode(jwt);
                const userId = decoded.sub;

                axios.get(`https://www.mortalitycore.com/api/v1/get_order_history.php?userId=${userId}`, {
                    headers: {
                        Authorization: `Bearer ${jwt}`,
                    },
                })
                .then(response => {
                    this.orderHistory = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
            }
        },
         checkEthereumPaymentStatus() {
      axios.get(`https://www.mortalitycore.com/api/v1/check_payment_status.php?txHash=${this.ethereumTxHash}&currency=ETH`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
      .then(response => {
        if (response.data.status === 'success') {
          this.ethereumPaymentStatusMessage = response.data.message;
          this.ethereumPaymentStatus = response.data.message === 'Payment processed successfully';
        } else {
          this.ethereumPaymentStatus = false;
          this.ethereumPaymentStatusMessage = response.data.message;
        }
      })
      .catch(error => {
        this.ethereumPaymentStatus = false;
        this.ethereumPaymentStatusMessage = 'There was an error checking the payment status.';
        console.log(error);
      });
    },
  fetchUserBalance() {
     
      const jwt = localStorage.getItem('token');
      if (jwt) {
        const decoded = jwt_decode(jwt);
        const userId = decoded.sub;
        
        // Bitcoin balance
        axios.get(`https://www.mortalitycore.com/api/v1/get_user_balance.php?userId=${userId}&currency=BTC`, {
          headers: {
            Authorization: `Bearer ${jwt}`,
          },
        })
        .then(response => {
          if (response.data.status === 'success') {
      
            sharedState.bitcoinBalance = response.data.balance;
          } else {
            console.log("Error getting Bitcoin balance: " + response.data.message);
          }
        })
        .catch(error => console.log(error));
        
        // Ethereum balance
axios.get(`https://www.mortalitycore.com/api/v1/get_user_eth_balance.php?userId=${userId}`, {
  headers: {
    Authorization: `Bearer ${jwt}`,
  },
})
        .then(response => {
          if (response.data.status === 'success') {
     
            sharedState.ethereumBalance = response.data.ethbalance;
          } else {
            console.log("Error getting Ethereum balance: " + response.data.message);
          }
        })
        .catch(error => console.log(error));
      }
    },
  logCartContents() {
/*
for debugging

    this.cart.forEach((cartItem, index) => {
      console.log(`Item ${index+1}:`);
      console.log(`ID: ${cartItem.item.id}`);
      console.log(`Name: ${cartItem.item.name}`);
      console.log(`Quantity: ${cartItem.quantity}`);
    });*/
  },

removeFromCart(index) {
  this.cart[index].item.stock++;
  
  if (this.cart[index].quantity > 1) {
    this.cart[index].quantity--;
  } else {
    this.cart.splice(index, 1);
  }
},


    resetUser() {
      this.userRole = '';
      this.username = '';
      this.userId = '';
    },
 checkUserName() {
      const jwt = localStorage.getItem('token');
      if (jwt) {
        const decoded = jwt_decode(jwt);
        this.username = decoded.username;
        this.userId = decoded.sub;
      } else {
        console.log("NO JWT");
      }
    },
 checkUserRole() {
      const jwt = localStorage.getItem('token');
      if (jwt) {
    
        const decoded = jwt_decode(jwt);
        this.userRole = decoded.role;
      } else {
        console.log("NO JWT");
      }
    },
    fetchItems() {
axios.get('https://www.mortalitycore.com/api/v1/get_products.php')
        .then(response => {
          if (response.data.status === 'success') {
            this.items = response.data.products;
          //  this.items.forEach(item => console.log(item.image_url)); 
          } else {
          
          }
        })
        .catch(error => {
          
          console.log(error);
        });
    },
    
addToCart(item) {
  if (item.stock < 1) {
    this.message = 'This item is out of stock';
    return;
  }
  
  let found = false;
  for (let i = 0; i < this.cart.length; i++) {
    if (this.cart[i].item.id === item.id) {
      this.cart[i].quantity++;
      item.stock--;
      found = true;
      break;
    }
  }

  if (!found) {
    this.cart.push({
      item: item,
      quantity: 1
    });
    item.stock--;
  }

      this.itemInCart = item.id;

      if (this.feedbackTimer) {
        clearTimeout(this.feedbackTimer);
      }

      this.feedbackTimer = setTimeout(() => {
        this.itemInCart = null;
        this.feedbackTimer = null;
      }, 2000); 
    },


    deleteItem(item) {

  axios({
    method: 'delete',
    url: 'https://mortalitycore.com/api/v1/delete_product.php',
    data: {
      id: item.id
    },
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })
  .then(response => {
    this.message = response.data.message;
    if (response.data.status === 'success') {
      const index = this.items.findIndex(i => i.id === item.id);
      if (index > -1) {
        this.items.splice(index, 1);
      }
    
    }
if (response.data.status === 'error') {
  console.log("Error:", response.data.message);
}

  })
  .catch(error => {
    this.message = error.message; 
    console.log(error);
  });
},
checkout() {

  if (!window.confirm("Are you sure you want to proceed with checkout?")) {
    return; 
  }


  const totalCost = this.cart.reduce((total, cartItem) => total + (parseFloat(cartItem.item.price) * cartItem.quantity), 0);

  const jwt = localStorage.getItem('token');
  if (jwt) {
    const decoded = jwt_decode(jwt);
    const userId2 = decoded.sub;

  axios.get(`https://www.mortalitycore.com/api/v1/get_user_balance.php?userId=${userId2}`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })
  .then(response => {

    if (response.data.balance) {
      if (response.data.balance < totalCost) {
        this.checkoutMessage  = 'Insufficient funds. Please recharge your balance.';

        this.cart.forEach((cartItem) => {
          cartItem.item.stock += cartItem.quantity;
        });
      } else {
        this.logCartContents();
        axios({
          method: 'post',
          url: 'https://mortalitycore.com/api/v1/checkout.php',
          data: this.cart.map(cartItem => ({ id: cartItem.item.id, quantity: cartItem.quantity })),
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        })
        .then(response => {
     
          window.scrollTo(0, 0);
          
          this.cart = [];
 
          this.checkoutMessage  = response.data.message || 'Thank you for your purchase!';
          this.message  = response.data.message || 'Thank you for your purchase!';
          
    this.fetchUserBalance(); 
    this.fetchOrderHistory(); 
    
    this.getPurchasedItems();
        })
        .catch(error => {
  
          this.checkoutMessage  = error.message;
          console.log(error);
        });
      }
    } else {
      this.checkoutMessage  = 'Insufficient funds. Please recharge your balance.';
      this.userBalance = 0;
    }
  })
  .catch(error => {
 
    this.checkoutMessage  = error.message;
    console.log(error);
  });
  }
},



  },
  created() {

    
    this.fetchItems();
    this.checkUserRole();
    this.checkUserName();

    this.getPurchasedItems();
    watch(() => sharedState.userBalance, () => {
      this.fetchUserBalance();
    });
   watch(() => sharedState.purchasedItems, () => {
      this.purchasedItems = sharedState.purchasedItems;
    }, { immediate: true });
    
  }
}
</script>
<style scoped>
body {
  color: #d3d3d3; 
  font-size: 18px; 
  font-weight: 500; 
}
a {
  color: #ffcc00; 
}

.feedback {
  color: green;
  transition: all 2s ease-out;
}


.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
  padding: 10px;
  transition: transform .2s;
  background-color: #1a1a1a;
  border-radius: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5); 
}

.item {
  border: 1px solid #4a4a4a; 
  padding: 5px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  background-color: #555555; 
  border-radius: 10px;
  transition: transform .2s;
}

.cart-feedback {
  position: absolute; 
  top: 70%; 
  left: 50%; 
  transform: translateX(-50%); 
  width: 100%; 
  text-align: center; 
  color: green; 
  transition: opacity 0.2s;
  opacity: 1; 
  padding: 5px; 
  background-color: rgba(0, 0, 0, 0.5); 
  border-radius: 10px; 
}

.item:not(:hover) .cart-feedback {
  opacity: 0; 
}
.item:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
  border-color: #888;
}

.item-image {
  width: 100%;
  max-width: 200px;
  height: auto;
  border-radius: 10px;
}

.small-image {
  width: 25px;
  height: auto;
  border-radius: 3px;
}

.button-wrapper {
  position: relative;
}
.item-content {
  flex: 1; 
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  color: white;
  position: relative;
}
button {
  background-color: #ffcc00;
  color: #1a1a1a; 
  border: none;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
.shop-header {
  text-align: center;
  color: #382600;
  padding: 10px;
  margin-bottom: 10px;
}
.shop-desc {
  text-align: center;
  color: #382600;
  padding: 4px;
  margin-bottom: 10px;
  font-size: 10px;
}

.shop-header h1 {
  font-size: 36px;
  margin-bottom: 10px;
}

.shop-header p {
  font-size: 24px;
}

button:hover {
  background-color: #1a1a1a;
  color: white; 
}

.txHash-input {
  width: 250px;
}

.payment-status-success {
  color: darkgreen;
}

.payment-status-error {
  color: darkred;
}
.cart-container {
  position: fixed;
  top: 60px; 
  right: 20px;
  width: 300px;
  background: #fff; 
  padding: 20px; 
  border-radius: 8px; 
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
}

</style>