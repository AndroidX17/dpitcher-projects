<template> <!-- ShopNavbar.vue -->
    <nav>
        <ul>
            <li>
                <a @click="changePage('ShopPage')">
                    <img src="/coinicons/Bitcoin.png" alt="Shop Image"/>Shop
                </a>
            </li>
            <li>
                <a @click="changePage('SignupPage')">
                    <img src="/coinicons/Bitcoin.png" alt="Settings Image"/>Sign up
                </a>
            </li>
            <li>
                <a @click="changePage('AboutPage')">
                    <img src="/coinicons/Bitcoin.png" alt="About Image"/>About
                </a>
            </li>
            <li>
                <a @click="changePage('ContactPage')">
                    <img src="/coinicons/Bitcoin.png" alt="Contact Image"/>Contact
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    methods: {
       changePage(page) {
      this.$emit('change-page', page);
    }
    }
}
</script>


<style scoped>
nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    color: white;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: space-around;
}

nav ul li {
    display: inline-block;
}

nav ul li a {
    color: white;
    text-decoration: none;
    padding: 15px;
    display: inline-block;
}

nav ul li a img {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

nav ul li a:hover {
    background-color: #555;
}
</style>
