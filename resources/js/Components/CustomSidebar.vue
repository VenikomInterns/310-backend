<template>
    <div>
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <span class="fs-4 fw-bold">
                    Web Shop
                </span>
        </a>
        <hr/>
        <ul class="nav nav-pills flex-column mb-auto mt-3 ">
            <li class="nav-item">
                <Link :href="route('categories.index')" class="nav-link" :class="{'active' : getURL('categories')}">
                    Categories
                </Link>
            </li>
            <li class="nav-item my-2">
                <Link :href="route('products.index')" class="nav-link" :class="{'active' : getURL('products')}">
                    Products
                </Link>
            </li>
        </ul>
        <hr/>
    </div>
</template>

<script>
export default {
    name: "CustomSidebar",
    methods: {
        getURL(page) {
            let url = window.location.href;
            return url.includes(page);
        }
    }
}
</script>

<style scoped>

</style>
