import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductList from './components/Products/TheProductList.vue'
import TheCategoryList from './components/Category/TheCategoryList.vue'
import BackendError from './components/Components/BackendError.vue'
import ProductIndex from './components/Products/ProductIndex.vue'
import ProductCategory from './components/Products/ProductCategory.vue'
import ProductOnly from './components/Products/ProductOnly.vue'
import CartShop from './components/Cart/CartShop.vue'

const app = createApp({
	components: {
		TheProductList,
		TheCategoryList,
		ProductIndex,
		ProductCategory,
		ProductOnly,
		CartShop
	}
})

app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app')
