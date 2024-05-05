<template>
	<section>
		<div class="d-flex justify-content-center my-4">
			<h1></h1>
		</div>

		<div class="card mb-3 p-5" style="max-width: 1000px;">
			<div class="row g-0">
				<div class="col-md-4">
					<div class="m-2 h-100 w-100">
						<a><img :src="product.file.route" class="img-fluid rounded-start rounded" alt="Portada producto"></a>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h3 class="card-title">{{ product.title }}</h3>
						<p>{{ product.description }}</p>
						<p class="card-text"><b>Precio:</b> {{formatCurrency(product.price) }}</p>
						<p><b>Stock:</b> {{ product.stock }} Unidad(es)</p>
						<form @submit.prevent="addToCart">
							<input type="hidden" name="id" :value="product.id">
							<input type="submit" name="btn" class="btn btn-primary w-50" value="Añadir al carrito">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

</template>
<script>
	export default {
		props: ['product'],

		methods: {
			async addToCart() {
				const productId = this.product.id
				console.log(productId)
				const response = await axios.post(`/cart/add/${productId}`)
				console.log(response)
			}
		},
		computed: {
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

