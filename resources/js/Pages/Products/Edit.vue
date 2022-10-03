<template>
    <div class="container row">
        <div class="col-3 p-3 bg-light">
            <custom-sidebar/>
        </div>
        <div class="col-9 d-flex flex-column justify-content-center align-items-center bg-light pt-5">
            <div>
                <p class="fs-3 fw-bold text-primary">
                    Edit the details for the product
                </p>
            </div>
            <form @submit.prevent="submit">
                <label for="selectCategory" class="fw-bold fst-italic">
                    Select category:
                </label>
                <select class="form-control" id="selectCategory" v-model="form.category_id">
                    <option v-for="category in categories" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
                <label for="name" class="fw-bold fst-italic">
                    Name
                </label><br/>
                <input type="text" name="name" id="name" v-model="form.name"><br/>
                <label for="price" class="fw-bold fst-italic">
                    Price
                </label><br/>
                <input type="number" name="price" id="price" v-model="form.price"><br/>
                <label for="name" class="fw-bold fst-italic">
                    Description
                </label><br/>
                <textarea name="description" id="description" rows="7" cols="50"
                          v-model="form.description">
                </textarea><br/>
                <div class="mt-3">
                    <button type="submit" class="btn bg-primary text-white rounded-3 ms-3">
                        Submit
                    </button>
                    <a onclick="history.back();return false;" class="btn btn-secondary text-white rounded-3 ms-3">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import CustomSidebar from "../../Components/CustomSidebar.vue";

export default {
    name: "Edit",
    components: {
        CustomSidebar
    },
    props: {
        product: Object,
        categories: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.product.name,
                price: this.product.price,
                description: this.product.description,
                category_id: this.product.category_id,
            })
        }
    },
    methods: {
        submit() {
            this.$inertia.put(route('products.update', this.product), this.form);
        }
    }
}
</script>

<style scoped>

</style>
