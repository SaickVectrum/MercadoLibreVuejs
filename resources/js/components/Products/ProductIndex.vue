<template>
	<div class="container">
		<div v-for="(categoryProducts, nameCategory) in groupedProducts" :key="nameCategory" class="mb-4">
			<div class="d-inline my-5">
				<h2 class="d-inline">{{ nameCategory }}</h2>
				<a :href="getCategoryLink(nameCategory)" class="d-inline text-decoration-none text-primary font-weight-bold">
					<p class="d-inline mx-4 font-weight-bold">Ver más</p>
				</a>
			</div>
			<div class="row">
				<div v-for="product in categoryProducts.slice(0, 4)" :key="product.id" class="col-lg-3 col-md-4 col-sm-6 mb-4">
					<div class="card h-100">
						<a :href="getProductLink(product.id)" class="m-2"><img :src="product.file.route" class="card-img-top rounded" alt="Portada producto"></a>
						<div class="card-body">
							<h5 class="card-title">{{ product.title }}</h5>
							<p class="card-text">{{ formatCurrency(product.price) }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			products: {
				type: Array,
				default: () => []
			}
		},
		methods: {
			getCategoryLink(nameCategory) {
				return `/products/${nameCategory}`
			},
			getProductLink(productId) {
				return `/products/product/${productId}`
			}
		},
		computed: {
			//explicar
			groupedProducts() {
				return this.products.reduce((acc, product) => {
					const nameCategory = product.category.name
					if (!acc[nameCategory]) {
						acc[nameCategory] = []
					}
					acc[nameCategory].push(product)
					return acc
				}, {})
			},
			//formatea los numeros a tipo moneda
			formatCurrency() {
				return value => {
					if (typeof value !== 'number') {
						return value
					}
					return '$' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
				}
			}
		}
	}
</script>
