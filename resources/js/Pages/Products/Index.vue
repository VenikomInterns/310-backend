<template>
    <div class="row container">
        <div class="col-3 p-3 bg-light">
            <custom-sidebar/>
        </div>
        <div class="col-9 pt-5">
            <h1 class="fs-2 fw-bold bg-light p-4">
                Add new product
                <span>
                        <Link :href="route('products.create')"
                              class="btn bg-primary text-white ms-3 fw-bold">
                            Add
                        </Link>
                    </span>
            </h1>
            <div class="row py-2 bg-light m-3" v-for="product in products">
                <div class="col-12 col-xl-6">
                    <p class="fs-4 text-secondary">
                        {{ product.name }} / <span class="text-primary">{{ getCategoryName(product) }}</span>
                    </p>
                    <p>
                        {{ product.description }}
                    </p>
                </div>
                <div class="col-3 col-xl-2 d-flex align-items-center">
                    <div class="text-primary fw-bold">
                        {{ product.price }} &euro;
                    </div>
                </div>
                <div class="col-9 col-xl-4 d-flex align-items-center justify-content-end">
                    <div class="">
                        <Link :href="route('products.edit', product.id)"
                              class="btn bg-primary text-white me-3">
                            Edit
                        </Link>
                        <Link :href="route('products.destroy', product.id)" method="DELETE"
                              class="btn bg-secondary text-white">
                            Delete
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CustomSidebar from "../../Components/CustomSidebar.vue";

export default {
    name: "Index",
    components: {
        CustomSidebar
    },
    props: {
        products: Array,
        categories: Array,
    },
    data() {
        return {}
    },
    methods: {
        getCategoryName(category) {
            for (let i = 0; i <= this.categories.length; i++) {
                if (category.category_id === this.categories[i].id)
                    return this.categories[i].name;
            }
        }
    }
}
</script>

<style scoped>

</style>
