<template>
	<section>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive my-4 mx-4">
					<table class="table table-bordered" id="product_table">
						<thead>
							<tr>
								<th>Imagen</th>
								<th>Titulo</th>
								<th>Categoria</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(product, index) in products" :key="index">
								<td><img :src="product.file.route" class="w10 h10" style="width:30px; height:30px;" ></td>
								<td>{{ product.title }}</td>
								<td>{{ product.category }}</td>
								<td>{{product.price}}</td>
								<td>{{ product.stock }}</td>
								<td>

								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		props: ['products'],

		data() {
			return {
				product: {}
			}
		},

		created() {
			console.log(this.products) // Imprime los datos de los productos en la consola del navegador
		}
	}
</script>
